<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Surfsidemedia\Shoppingcart\Facades\Cart; // Update namespace if needed

class CartController extends Controller
{
    // Display the cart items
    public function index()
    {
        $items = Cart::instance('cart')->content();
        return view('cart', compact('items'));
    }

    // Add an item to the cart
    public function add_to_cart(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'id' => 'required|exists:products,id',
            'name' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        // Add the product to the cart
        Cart::instance('cart')->add(
            $request->id,
            $request->name,
            $request->quantity,
            $request->price
        )->associate('App\Models\Product'); // Ensure the correct namespace

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function increase_cart_quantity($rowId)
    {
        // Check if the item exists in the cart
        $cartItem = Cart::instance('cart')->get($rowId);

        if ($cartItem) {
            // Increment the quantity by 1
            $qty = $cartItem->qty + 1;

            // Update the cart item quantity
            Cart::instance('cart')->update($rowId, $qty);

            // Redirect back with a success message
            return redirect()->back()->with('success', 'Cart item quantity increased successfully!');
        }

        // If item not found, redirect back with an error message
        return redirect()->back()->with('error', 'Cart item not found!');
    }

    public function decrease_cart_quantity($rowId)
    {
        // Check if the item exists in the cart
        $cartItem = Cart::instance('cart')->get($rowId);

        if ($cartItem) {
            // Decrease the quantity by 1
            $qty = $cartItem->qty - 1;

            // Remove item if quantity is 0 or less, otherwise update the cart
            if ($qty <= 0) {
                Cart::instance('cart')->remove($rowId);
                return redirect()->back()->with('success', 'Cart item removed successfully!');
            } else {
                Cart::instance('cart')->update($rowId, $qty);
                return redirect()->back()->with('success', 'Cart item quantity decreased successfully!');
            }
        }

        // If item not found, redirect back with an error message
        return redirect()->back()->with('error', 'Cart item not found!');
    }

    public function remove_cart_item($rowId)
    {
        Cart::instance('cart')->remove($rowId);
        return redirect()->back()->with('success', 'Cart item removed successfully!');
    }

    public function empty_cart()
    {
        Cart::instance('cart')->destroy();
        return redirect()->back()->with('success', 'Cart item cleared successfully!');
    }


    public function apply_coupon_code(Request $request)
    {
        $request->validate(['coupon_code' => 'required|string|max:50']);

        $coupon = Coupon::where('code', $request->coupon_code)
            ->where('expiry_date', '>=', Carbon::now())
            ->first();

        if (!$coupon) {
            return redirect()->back()->with('error', 'Invalid or expired coupon code');
        }

        // Convert cart subtotal to proper float
        $cartSubtotal = (float)str_replace(',', '', Cart::instance('cart')->subtotal());

        if ($coupon->cart_value > $cartSubtotal) {
            return redirect()->back()->with('error',
                'Minimum cart value of ' . format_currency($coupon->cart_value) . ' required'
            );
        }

        Session::put('coupon', [
            'id' => $coupon->id,
            'code' => $coupon->code,
            'type' => $coupon->type,
            'value' => (float)$coupon->value,
            'cart_value' => (float)$coupon->cart_value
        ]);

        $this->calculateDiscount();

        return redirect()->back()->with('success', 'Coupon applied successfully!');
    }

    protected function calculateDiscount()
    {
        $cart = Cart::instance('cart');
        $subtotal = (float)str_replace(',', '', $cart->subtotal());
        $taxRate = config('cart.tax', 0);

        if (!Session::has('coupon')) {
            Session::forget('discounts');
            return;
        }

        $coupon = Session::get('coupon');

        // Calculate discount amount
        $discount = $coupon['type'] === 'fixed'
            ? min($coupon['value'], $subtotal)
            : ($subtotal * $coupon['value']) / 100;

        // Calculate new values
        $subTotalAfterDiscount = $subtotal - $discount;
        $taxAmount = ($subTotalAfterDiscount * $taxRate) / 100;
        $total = $subTotalAfterDiscount + $taxAmount;

        Session::put('discounts', [
            'discount' => $discount,
            'subtotal' => $subTotalAfterDiscount,
            'tax' => $taxAmount,
            'total' => $total,
        ]);
    }
    public function remove_coupon(Request $request)
    {
        Session::forget('coupon');
        $this->calculateDiscount(); // This will clear discounts automatically

        return redirect()->back()->with('success', 'Coupon removed successfully!');
    }

    public function checkout()
    {
        // Get authenticated user
        $user = auth()->user();

        // Redirect unauthenticated users
        if (!$user) {
            return redirect()->route('login');
        }

        $address = Address::where('user_id', Auth::user()->id)->where('is_default', 1)->first();
        return view('checkout', compact('address'));
    }

    public function place_and_order(Request $request)
    {
        $user = Auth::user();

        // Find default address or create one if missing
        $address = Address::where('user_id', $user->id)->where('is_default', 1)->first();

        if (!$address) {
            $validatedData = $request->validate([
               'name' => 'required|string|max:100',
               'phone' => 'required|digits:11',
               'postal_code' => 'required|digits_between:4,10',
               'state' => 'required|string|max:100',
               'city' => 'required|string|max:100',
               'address' => 'required|string|max:255',
               'locality' => 'nullable|string|max:100',
               'landmark' => 'nullable|string|max:100'
           ]);

            $address = new Address();
            $address->fill($validatedData);

            $address->country_code = 'BD';
            $address->user_id = $user->id;
            $address->is_default = true;
            $address->save();

        }
        // Set checkout amounts
        $checkoutData = $this->setAmountForCheckout();

        if (!$checkoutData) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }
        $order = new Order();
        $order->order_number = 'ORD-' . strtoupper(uniqid());
        $order->user_id = $user->id;
        $order->subtotal = $checkoutData['subtotal'];
        $order->discount = $checkoutData['discount'];
        $order->tax = $checkoutData['tax'];
        $order->shipping_cost = $checkoutData['shipping_cost'] ?? 0;
        $order->total = $checkoutData['total'];
        $order->currency_code = 'BDT';
        $order->billing_address = json_encode($address);
        $order->shipping_address = json_encode($address);
        $order->is_shipping_different = false;
        $order->payment_method = 'Cash on Delivery';
        $order->payment_status = 'unpaid';
        $order->status = 'pending';
        $order->notes = $request->input('notes'); // ✅ Now saving customer notes
        $order->save();

        foreach ( Cart::instance('cart')->content() as $item)
        {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $item->id;
            $orderItem->product_name = $item->name;
            $orderItem->sku = $item->options->sku ?? 'N/A';
            $orderItem->price = $item->price;
            $orderItem->original_price = $item->options->original_price ?? null;
            $orderItem->quantity = $item->qty;
            $orderItem->attributes = json_encode($item->options);
            $orderItem->save();
        }
        if ($request->gateway == "bank")
        {
        //
        }
        elseif ($request->gateway == "card")
        {
        //
        }
        elseif ($request->gateway == "cash")
        {
            $transaction = new Transaction();
            $transaction->user_id = $user->id;
            $transaction->order_id = $order->id;
            $transaction->gateway  = $request->gateway;
            $transaction->transaction_id = uniqid('TXN-'); // Generate a unique transaction ID
            $transaction->status = "pending";
            $transaction->amount = $checkoutData['total']; // ✅ Save transaction amount
            $transaction->currency_code = 'BDT';
            $transaction->save();
        }

        Cart::instance('cart')->destroy();
        Session::forget('checkout');
        Session::forget('coupon');
        Session::forget('discounts');
        Session::put('order_id', $order->id );

        return redirect()->route('cart.order.confirmation')
                        ->with('success', 'Order has been confirmed successfully!');
    }

    public function setAmountForCheckout()
    {
        $cart = Cart::instance('cart');

        if ($cart->count() == 0) {
            Session::forget('checkout');
            return null; // Ensure it returns null when cart is empty
        }

        if (Session::has('coupon')) {
            $discounts = Session::get('discounts', []);
            $checkoutData = [
                'discount' => $discounts['discount'] ?? 0,
                'subtotal' => $discounts['subtotal'] ?? 0,
                'tax' => $discounts['tax'] ?? 0,
                'total' => $discounts['total'] ?? 0,
            ];
        } else {
            $checkoutData = [
                'discount' => 0,
                'subtotal' => $cart->subtotal(),
                'tax' => $cart->tax(),
                'total' => $cart->total(),
            ];
        }

        Session::put('checkout', $checkoutData);
        return $checkoutData; // Ensure it returns the array
    }


    public function order_confirmation()
    {
        $user = auth()->user();

        // Redirect unauthenticated users
        if (!$user) {
            return redirect()->route('login');
        }

        $address = Address::where('user_id', $user->id)->where('is_default', 1)->first();

        if (Session::has('order_id')) {
            $order = Order::find(Session::get('order_id'));
            Session::forget('order_id'); // Optional: Remove after retrieving

            if (!$order) {
                return redirect()->route('cart.index')->with('error', 'Order not found.');
            }

            return view('order-confirmation', compact('order', 'address'));
        }

        return redirect()->route('cart.index')->with('error', 'No order found.');
    }

}

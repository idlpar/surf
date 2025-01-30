<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
            // Increment the quantity by 1
            $qty = $cartItem->qty - 1;

            // Update the cart item quantity
            Cart::instance('cart')->update($rowId, $qty);

            // Redirect back with a success message
            return redirect()->back()->with('success', 'Cart item quantity decreased successfully!');
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
        $request->validate(['coupon_code' => 'required|string']);

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
}

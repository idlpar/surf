<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
}

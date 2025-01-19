<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
//        $products = Product::orderBy('created_at', 'desc')->paginate(12);
        $products = Product::latest()->paginate(12);
        return view('shop', compact('products'));
    }

    public function product_details(string $product_slug)
    {
        // Fetch the requested product
        $product = Product::where('slug', $product_slug)->first();

        // Handle the case where the product does not exist
        if (!$product) {
            abort(404, 'Product not found');
        }

        // Fetch related products (excluding the current one)
        $relatedProducts = Product::where('slug', '!=', $product_slug)
            ->inRandomOrder()
            ->limit(12)
            ->get();

        // Return the product details view
        return view('product-details', [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
        ]);
    }

}

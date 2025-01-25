<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $size = $request->query('size', 12);
        $order = $request->query('order', -1);
        $filtered_brands = $request->query('brands', ''); // Get brands as a comma-separated string

        // Convert `$filtered_brands` to an array
        $brand_ids = $filtered_brands ? explode(',', $filtered_brands) : [];

        $o_column = 'created_at';
        $o_order = 'desc';

        switch ($order) {
            case 1:
                $o_column = 'is_featured';
                $o_order = 'desc';
                break;
            case 2:
                $o_column = 'quantity';
                $o_order = 'desc';
                break;
            case 3:
                $o_column = 'name';
                $o_order = 'asc';
                break;
            case 4:
                $o_column = 'name';
                $o_order = 'desc';
                break;
            case 5:
                $o_column = 'sale_price';
                $o_order = 'asc';
                break;
            case 6:
                $o_column = 'sale_price';
                $o_order = 'desc';
                break;
            case 7:
                $o_column = 'created_at';
                $o_order = 'asc';
                break;
            case 8:
                $o_column = 'created_at';
                $o_order = 'desc';
                break;
        }

        $products = Product::when($brand_ids, function ($query) use ($brand_ids) {
            $query->whereIn('brand_id', $brand_ids);
        })->orderBy($o_column, $o_order)->paginate($size);

        $brands = Brand::orderBy('name', 'asc')->get();

        // Pass `$brand_ids` (array) instead of `$filtered_brands` (string) to the Blade
        return view('shop', compact('products', 'size', 'order', 'brands', 'brand_ids'));
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

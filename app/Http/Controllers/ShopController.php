<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        // Default query parameters
        $size = $request->query('size', 12);
        $order = $request->query('order', -1);

        $filtered_brands = $request->query('brands', ''); // Comma-separated string
        $filtered_categories = $request->query('categories', ''); // Comma-separated string

        // Fetch the maximum price dynamically from the database
        $max_price_in_db = Product::max('sale_price') ?? Product::max('regular_price') ?? 1000; // Default to 1000 if no product exists

        // Check if 'max_price' is provided in the request, else use $max_price_in_db
        $min_price = $request->query('min_price', 20);
        $max_price = $request->query('max_price') !== null
            ? (int)$request->query('max_price')
            : $max_price_in_db;


        // Convert comma-separated strings to arrays
        $brand_ids = $filtered_brands ? array_filter(explode(',', $filtered_brands)) : [];
        $category_ids = $filtered_categories ? array_filter(explode(',', $filtered_categories)) : [];

        // Determine sort column and order
        $sortOptions = [
            1 => ['is_featured', 'desc'],
            2 => ['quantity', 'desc'],
            3 => ['name', 'asc'],
            4 => ['name', 'desc'],
            5 => ['sale_price', 'asc'],
            6 => ['sale_price', 'desc'],
            7 => ['created_at', 'asc'],
            8 => ['created_at', 'desc'],
        ];

        [$o_column, $o_order] = $sortOptions[$order] ?? ['sale_price', 'asc'];

        // Fetch products with filters and sorting
        $products = Product::when($brand_ids, function ($query) use ($brand_ids) {
            $query->whereIn('brand_id', $brand_ids);
        })
            ->when($category_ids, function ($query) use ($category_ids) {
                $query->whereIn('category_id', $category_ids);
            })
            ->where(function ($query) use ($min_price, $max_price) {
                $query->whereBetween('regular_price', [$min_price, $max_price])
                    ->orWhereBetween('sale_price', [$min_price, $max_price]);
            })
            ->orderBy($o_column, $o_order)
            ->paginate($size);


        // Fetch categories and brands for filtering
        $categories = Category::orderBy('name', 'asc')->get();
        $brands = Brand::orderBy('name', 'asc')->get();

        // Return view with data
        return view('shop', compact(
            'products',
            'size',
            'min_price',
            'max_price',
            'order',
            'brands',
            'categories',
            'brand_ids',
            'category_ids',
            'filtered_categories',
            'max_price_in_db'
        ));
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

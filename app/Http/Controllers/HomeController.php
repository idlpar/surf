<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Slide;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        // Get active slides (latest first, limited to 4)
        $slides = Slide::select('id', 'title', 'image', 'status')
            ->where('status', 1)
            ->latest()
            ->take(4)
            ->get();

        // Get random sale products (limited to 12)
        $saleProducts = Product::select('id', 'name', 'regular_price', 'sale_price', 'images', 'image', 'slug')
            ->whereNotNull('sale_price')
            ->inRandomOrder()
            ->take(12)
            ->get();

        // Get featured products (limited to 12)
        $featuredProducts = Product::select('id', 'name', 'regular_price', 'sale_price', 'images', 'image', 'slug')
            ->where('is_featured', 1)
            ->inRandomOrder()
            ->take(12)
            ->get();

        // Get categories (alphabetically ordered, limited to 12)
        $categories = Category::select('id', 'name', 'slug', 'image')
            ->orderBy('name')
            ->take(12)
            ->get();
        return view('home', compact('slides', 'saleProducts', 'featuredProducts', 'categories'));
    }
    public function contact()
    {
        return view('contact');
    }

    public function send_contact(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'required|string|min:7|max:15',
            'email'   => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Contact::create($request->all());

        return redirect()->back()->with('success', 'Your message has been sent successfully.');
    }

    public function search(Request $request)
    {
        $query = trim($request->get('query'));

        if (!$query) {
            return response()->json(['error' => 'Please enter a search term.'], 400);
        }

        $products = Product::where('name', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
//            ->orWhere('category', 'LIKE', "%{$query}%") // If category is a string
            ->orderBy('created_at', 'desc')
            ->limit(10) // Fetch only 10 results for AJAX
            ->get();

        if ($products->isEmpty()) {
            return response()->json([], 200); // Return empty array instead of redirect
        }

//        dd(response()->json($products));
        return response()->json($products);
    }


}

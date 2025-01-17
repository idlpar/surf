<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;




class AdminController extends Controller
{
    // Brands
    public function index()
    {
        return view('admin.index');
    }
    public function brands()
    {
        $brands = Brand::orderBy('id', 'desc')->paginate(10);
        return view('admin.brands', compact('brands'));
    }
    public function brand_add()
    {
        return view('admin.brand-add');
    }
    public function brand_store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'slug' => 'nullable|string|max:255|unique:brands,slug',
        ]);

        try {
            // Generate a unique slug
            $slug = $request->slug ?? Str::slug($request->name);
            if (Brand::where('slug', $slug)->exists()) {
                return back()->withErrors([
                    'slug' => 'The generated slug is already in use. Please choose a different name.'
                ])->withInput();
            }

            // Create new brand instance
            $brand = new Brand();
            $brand->name = $request->name;
            $brand->description = $request->description;
            $brand->slug = $slug;

            // Handle image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');

                // Generate a base file name (slugified and URL-safe)
                $baseName = Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME));
                $extension = $image->getClientOriginalExtension();
                $fileName = $baseName . '.' . $extension;

                // Define the destination path
                $destinationPath = public_path('uploads/brands');

                // Ensure the directory exists
                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0775, true);
                }

                // Ensure the file name is unique by appending a number if needed
                $counter = 1;
                while (file_exists($destinationPath . DIRECTORY_SEPARATOR . $fileName)) {
                    $fileName = $baseName . '_' . $counter++ . '.' . $extension;
                }

                // Generate and save the thumbnail
                if (!$this->generateBrandThumbnails($image, $fileName)) {
                    return back()->withErrors([
                        'image' => 'Failed to process the image. Please try again.'
                    ])->withInput();
                }

                // Save the unique file name in the database
                $brand->image = $fileName;
            }

            // Save the brand
            $brand->save();

            return redirect()->route('admin.brands')->with('success', 'Brand has been added successfully.');
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Brand creation failed: ' . $e->getMessage(), [
                'request_data' => $request->all(),
            ]);

            return back()->withErrors([
                'general' => 'An unexpected error occurred. Please try again.'
            ])->withInput();
        }
    }
    public function brand_edit($id)
    {
        $brand = Brand::find($id);
        return view('admin.brand-edit', compact('brand'));
    }
    public function brand_update(Request $request)
    {
        // Validate the request input
        $request->validate([
            'id' => 'required|exists:brands,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'slug' => 'nullable|string|max:255',
        ]);

        try {
            // Find the brand by its ID
            $brand = Brand::findOrFail($request->id);

            // Update basic fields
            $brand->name = $request->name;
            $brand->description = $request->description;

            // Generate and update slug
            $slug = $request->slug ?? Str::slug($request->name);
            if ($slug !== $brand->slug) {
                if (Brand::where('slug', $slug)->where('id', '!=', $brand->id)->exists()) {
                    return back()->withErrors(['slug' => 'The slug must be unique.'])->withInput();
                }
                $brand->slug = $slug;
            }

            // Handle image upload if provided
            if ($request->hasFile('image')) {
                $image = $request->file('image');

                // Generate a unique file name
                $baseName = Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME));
                $extension = $image->getClientOriginalExtension();
                $fileName = $baseName . '.' . $extension;

                // Define upload directory
                $destinationPath = public_path('uploads/brands');

                // Ensure the directory exists
                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0775, true);
                }

                // Ensure unique file name
                $counter = 1;
                while (file_exists($destinationPath . DIRECTORY_SEPARATOR . $fileName)) {
                    $fileName = $baseName . '_' . $counter++ . '.' . $extension;
                }

                // Generate thumbnails
                if (!$this->generateBrandThumbnails($image, $fileName)) {
                    return back()->withErrors(['image' => 'Failed to process the image. Please try again.'])->withInput();
                }

                // Delete old image if it exists
                if ($brand->image && file_exists($destinationPath . DIRECTORY_SEPARATOR . $brand->image)) {
                    unlink($destinationPath . DIRECTORY_SEPARATOR . $brand->image);
                }

                // Update the brand's image
                $brand->image = $fileName;
            }

            // Save the updated brand
            $brand->save();

            return redirect()->route('admin.brands')->with('success', 'Brand has been updated successfully.');
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Brand update failed: ' . $e->getMessage(), [
                'request_data' => $request->all(),
            ]);

            return back()->withErrors([
                'general' => 'An unexpected error occurred. Please try again.',
            ])->withInput();
        }
    }
    public function generateBrandThumbnails($image, string $fileName): bool
    {
        try {
            // Validate the uploaded image
            if (!$image->isValid()) {
                throw new \Exception('Invalid image file.');
            }

            // Define the upload path
            $destinationPath = public_path('uploads/brands');

            // Ensure the directory exists
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0775, true);
            }

            // Process the image using Intervention Image
            $processedImage = Image::read($image->getRealPath())
                ->resize(124, 124, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize(); // Prevent upsizing
                });

            // Save the processed thumbnail
            $processedImage->save($destinationPath . DIRECTORY_SEPARATOR . $fileName);

            return true;
        } catch (\Exception $e) {
            // Log the error
            Log::error('Thumbnail generation failed: ' . $e->getMessage(), [
                'file_name' => $fileName,
                'image' => $image,
            ]);
            return false;
        }
    }
    public function brand_delete($id)
    {
        $brand = Brand::findOrFail($id);

        $images = [
            public_path('uploads/brands/' . $brand->image),
        ];

        foreach ($images as $image) {
            if (File::exists($image)) {
                File::delete($image);
            }
        }

        $brand->delete();

        return redirect()->route('admin.brands')->with('success', 'Brand has been deleted successfully.');
    }

    // Category

    public function categories()
    {
        $categories = Category::orderBy('id', 'desc')->paginate(10);
        return view('admin.categories', compact('categories'));
    }
    public function category_add()
    {
        return view('admin.category-add');
    }
    public function category_store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'slug' => 'nullable|string|max:255|unique:categories,slug',
        ]);

        try {
            // Generate a unique slug
            $slug = $request->slug ?? Str::slug($request->name);
            if (Category::where('slug', $slug)->exists()) {
                return back()->withErrors([
                    'slug' => 'The generated slug is already in use. Please choose a different name.'
                ])->withInput();
            }

            // Create new category instance
            $category = new Category();
            $category->name = $request->name;
            $category->description = $request->description;
            $category->slug = $slug;

            // Handle image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');

                // Generate a base file name (slugified and URL-safe)
                $baseName = Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME));
                $extension = $image->getClientOriginalExtension();
                $fileName = $baseName . '.' . $extension;

                // Define the destination path
                $destinationPath = public_path('uploads/categories');

                // Ensure the directory exists
                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0775, true);
                }

                // Ensure the file name is unique by appending a number if needed
                $counter = 1;
                while (file_exists($destinationPath . DIRECTORY_SEPARATOR . $fileName)) {
                    $fileName = $baseName . '_' . $counter++ . '.' . $extension;
                }

                // Generate and save the thumbnail
                if (!$this->generateCategoryThumbnails($image, $fileName)) {
                    return back()->withErrors([
                        'image' => 'Failed to process the image. Please try again.'
                    ])->withInput();
                }

                // Save the unique file name in the database
                $category->image = $fileName;
            }

            // Save the category
            $category->save();

            return redirect()->route('admin.categories')->with('success', 'Category has been added successfully.');
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Category creation failed: ' . $e->getMessage(), [
                'request_data' => $request->all(),
            ]);

            return back()->withErrors([
                'general' => 'An unexpected error occurred. Please try again.'
            ])->withInput();
        }
    }
    public function category_edit($id)
    {
        $category = Category::find($id);
        return view('admin.category-edit', compact('category'));
    }
    public function category_update(Request $request)
    {
        // Validate the request input
        $request->validate([
            'id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'slug' => 'nullable|string|max:255',
        ]);

        try {
            // Find the category by its ID
            $category = Category::findOrFail($request->id);

            // Update basic fields
            $category->name = $request->name;
            $category->description = $request->description;

            // Generate and update slug
            $slug = $request->slug ?? Str::slug($request->name);
            if ($slug !== $category->slug) {
                if (Category::where('slug', $slug)->where('id', '!=', $category->id)->exists()) {
                    return back()->withErrors(['slug' => 'The slug must be unique.'])->withInput();
                }
                $category->slug = $slug;
            }

            // Handle image upload if provided
            if ($request->hasFile('image')) {
                $image = $request->file('image');

                // Generate a unique file name
                $baseName = Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME));
                $extension = $image->getClientOriginalExtension();
                $fileName = $baseName . '.' . $extension;

                // Define upload directory
                $destinationPath = public_path('uploads/categories');

                // Ensure the directory exists
                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0775, true);
                }

                // Ensure unique file name
                $counter = 1;
                while (file_exists($destinationPath . DIRECTORY_SEPARATOR . $fileName)) {
                    $fileName = $baseName . '_' . $counter++ . '.' . $extension;
                }

                // Generate thumbnails
                if (!$this->generateCategoryThumbnails($image, $fileName)) {
                    return back()->withErrors(['image' => 'Failed to process the image. Please try again.'])->withInput();
                }

                // Delete old image if it exists
                if ($category->image && file_exists($destinationPath . DIRECTORY_SEPARATOR . $category->image)) {
                    unlink($destinationPath . DIRECTORY_SEPARATOR . $category->image);
                }

                // Update the category's image
                $category->image = $fileName;
            }

            // Save the updated category
            $category->save();

            return redirect()->route('admin.categories')->with('success', 'Category has been updated successfully.');
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Category update failed: ' . $e->getMessage(), [
                'request_data' => $request->all(),
            ]);

            return back()->withErrors([
                'general' => 'An unexpected error occurred. Please try again.',
            ])->withInput();
        }
    }
    public function generateCategoryThumbnails($image, string $fileName): bool
    {
        try {
            // Validate the uploaded image
            if (!$image->isValid()) {
                throw new \Exception('Invalid image file.');
            }

            // Define the upload path
            $destinationPath = public_path('uploads/categories');

            // Ensure the directory exists
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0775, true);
            }

            // Process the image using Intervention Image
            $processedImage = Image::read($image->getRealPath())
                ->resize(124, 124, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize(); // Prevent upsizing
                });

            // Save the processed thumbnail
            $processedImage->save($destinationPath . DIRECTORY_SEPARATOR . $fileName);

            return true;
        } catch (\Exception $e) {
            // Log the error
            Log::error('Thumbnail generation failed: ' . $e->getMessage(), [
                'file_name' => $fileName,
                'image' => $image,
            ]);
            return false;
        }
    }
    public function category_delete($id)
    {
        $category = Category::findOrFail($id);

        // Delete associated image files if they exist
        $images = [
            public_path('uploads/categories/' . $category->image),
        ];

        foreach ($images as $image) {
            if (File::exists($image)) {
                File::delete($image);
            }
        }

        // Delete the category itself
        $category->delete();

        return redirect()->route('admin.categories')->with('success', 'Category has been deleted successfully.');
    }

    // Products

    public function products()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(30);
        return view('admin.products', compact('products'));
    }

    public function product_add()
    {
        $categories = Category::select('id', 'name')->orderBy('name', 'asc')->get();
        $brands  = Brand::select('id', 'name')->orderBy('name', 'asc')->get();
        return view('admin.product-add', compact('categories', 'brands'));

    }
    public function product_store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:100',
            'slug' => 'nullable|string|max:100|unique:products,slug',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'short_description' => 'required|string|max:1000',
            'description' => 'required|string|max:10000',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'regular_price' => 'required|numeric',
            'sale_price' => 'required|numeric|lte:regular_price',
            'SKU' => 'required|string|max:255|unique:products,SKU',
            'quantity' => 'required|integer',
            'stock_status' => 'required|in:instock,outofstock',
            'is_featured' => 'required|boolean',
        ]);

        try {
            // Generate a unique slug
            $slug = Str::slug($request->slug) ?? Str::slug($request->name);
            if (Product::where('slug', $slug)->exists()) {
                return back()->withErrors([
                    'slug' => 'The generated slug is already in use. Please choose a different name.'
                ])->withInput();
            }

            // Create new product instance
            $product = new Product();
            $product->name = $request->name;
            $product->slug = $slug;
            $product->category_id = $request->category_id;
            $product->brand_id = $request->brand_id;
            $product->short_description = $request->short_description;
            $product->description = $request->description;
            $product->regular_price = $request->regular_price;
            $product->sale_price = $request->sale_price;
            $product->SKU = $request->SKU;
            $product->quantity = $request->quantity;
            $product->stock_status = $request->stock_status;
            $product->is_featured = $request->is_featured;

            // Handle main image upload with resizing
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $product->image = $this->processAndSaveImage($image, 'products', 300, 300); // Resize to 300x300
            }

            // Handle gallery images with resizing
            if ($request->hasFile('images')) {
                $galleryImages = [];
                foreach ($request->file('images') as $image) {
                    $galleryImages[] = $this->processAndSaveImage($image, 'products/gallery', 300, 300); // Resize to 300x300
                }
                $product->images = json_encode($galleryImages);
            }

            // Save the product
            $product->save();

            return redirect()->route('admin.products')->with('success', 'Product has been added successfully.');
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Product creation failed: ' . $e->getMessage(), [
                'request_data' => $request->all(),
            ]);

            return back()->withErrors([
                'general' => 'An unexpected error occurred. Please try again.'
            ])->withInput();
        }
    }

    /**
     * Process and save an image with resizing.
     *
     * @param \Illuminate\Http\UploadedFile $image
     * @param string $folder
     * @param int $width
     * @param int $height
     * @return string
     */
    private function processAndSaveImage($image, $folder, $width, $height)
    {
        $baseName = Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME));
        $extension = $image->getClientOriginalExtension();
        $fileName = $baseName . '.' . $extension;

        $destinationPath = public_path('uploads/' . $folder);

        // Ensure the directory exists
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0775, true);
        }

        // Ensure the file name is unique
        $counter = 1;
        while (file_exists($destinationPath . DIRECTORY_SEPARATOR . $fileName)) {
            $fileName = $baseName . '_' . $counter++ . '.' . $extension;
        }

        // Resize the image and save it
        $resizedImage = Image::read($image->getRealPath())
            ->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize(); // Prevent upsizing
            });
        $resizedImage->save($destinationPath . DIRECTORY_SEPARATOR . $fileName);

        return $fileName;
    }

    public function product_edit($id)
    {
        $product = Product::find($id);
        $categories = Category::select('id', 'name')->orderBy('name', 'asc')->get();
        $brands  = Brand::select('id', 'name')->orderBy('name', 'asc')->get();
        return view('admin.product-edit', compact('product', 'brands', 'categories'));

    }
    public function product_update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:100',
            'slug' => 'nullable|string|max:100|unique:products,slug,' . $id,
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'short_description' => 'required|string|max:1000',
            'description' => 'required|string|max:10000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'regular_price' => 'required|numeric',
            'sale_price' => 'required|numeric|lte:regular_price',
            'SKU' => 'required|string|max:255|unique:products,SKU,' . $id,
            'quantity' => 'required|integer',
            'stock_status' => 'required|in:instock,outofstock',
            'is_featured' => 'required|boolean',
        ]);

        try {
            // Find existing product
            $product = Product::findOrFail($id);

            // Update product fields
            $product->name = $request->name;
            $product->slug = $request->slug ?? Str::slug($request->name);
            $product->category_id = $request->category_id;
            $product->brand_id = $request->brand_id;
            $product->short_description = $request->short_description;
            $product->description = $request->description;
            $product->regular_price = $request->regular_price;
            $product->sale_price = $request->sale_price;
            $product->SKU = $request->SKU;
            $product->quantity = $request->quantity;
            $product->stock_status = $request->stock_status;
            $product->is_featured = $request->is_featured;

            // Handle main image update
            if ($request->hasFile('image')) {
                // Delete old image
                if ($product->image) {
                    $oldImagePath = public_path('uploads/products/' . $product->image);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
                // Upload new image
                $image = $request->file('image');
                $product->image = $this->processAndSaveImage($image, 'products', 300, 300);
            }

            // Handle gallery images update
            if ($request->hasFile('images')) {
                $galleryImages = [];

                // Delete old gallery images
                if ($product->images) {
                    foreach (json_decode($product->images, true) as $oldGalleryImage) {
                        $oldGalleryPath = public_path('uploads/products/gallery/' . $oldGalleryImage);
                        if (file_exists($oldGalleryPath)) {
                            unlink($oldGalleryPath);
                        }
                    }
                }

                // Upload new gallery images
                foreach ($request->file('images') as $image) {
                    $galleryImages[] = $this->processAndSaveImage($image, 'products/gallery', 300, 300);
                }
                $product->images = json_encode($galleryImages);
            }

            // Save the updated product
            $product->save();

            return redirect()->route('admin.products')->with('success', 'Product has been updated successfully.');
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Product update failed: ' . $e->getMessage(), [
                'request_data' => $request->all(),
            ]);

            return back()->withErrors([
                'general' => 'An unexpected error occurred. Please try again.'
            ])->withInput();
        }
    }

    public function product_delete($id)
    {
        try {
            // Find the product or throw a 404 error if not found
            $product = Product::findOrFail($id);

            // Delete the main image if it exists
            if ($product->image) {
                $mainImagePath = public_path('uploads/products/' . $product->image);
                if (File::exists($mainImagePath)) {
                    File::delete($mainImagePath);
                }
            }

            // Delete gallery images if they exist
            if ($product->images) {
                $galleryImages = json_decode($product->images, true);
                if (is_array($galleryImages)) {
                    foreach ($galleryImages as $galleryImage) {
                        $galleryImagePath = public_path('uploads/products/gallery/' . $galleryImage);
                        if (File::exists($galleryImagePath)) {
                            File::delete($galleryImagePath);
                        }
                    }

                    // Delete the gallery folder if empty
                    $galleryFolderPath = public_path('uploads/products/gallery/');
                    if (File::isDirectory($galleryFolderPath) && count(File::files($galleryFolderPath)) === 0) {
                        File::deleteDirectory($galleryFolderPath);
                    }
                }
            }

            // Delete the product record from the database
            $product->delete();

            // Redirect to the product list with a success message
            return redirect()->route('admin.products')->with('success', 'Product has been deleted successfully.');

        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Product deletion failed: ' . $e->getMessage(), ['product_id' => $id]);

            // Redirect back with an error message
            return redirect()->route('admin.products')->withErrors('Failed to delete product. Please try again.');
        }
    }

}


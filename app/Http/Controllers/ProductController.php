<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();


        // Handle image uploads
        $uploadedImages = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('\uploads\product_images'); // Store in the 'storage/app/public/product_images' directory
                $uploadedImages[] = $path;
            }
        }
        // dd($uploadedImages);


        if ($request->hasFile('image_url')) {
            $file = $request->file('image_url');
            $fileExtention = $file->getClientOriginalExtension();
            $path = $file->storeAs('\uploads\product/' . uniqid() . '_Product.' . $fileExtention);
            data_set($data, 'image_url', $path);
        }

        // Create a new product and associate uploaded images
        $product = new Product($data);
        $product->save();

        foreach ($uploadedImages as $path) {
            $product->images()->create([
                'image_url' => $path,
                'position' => 0,
            ]);
        }

        // $product = new Product;
        // $product->fill($data);
        // $product->save();

        session()->flash('message', 'Product added Successfully');
        return view('admin.product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $product_id)
    {
        $categories = Category::all();
        $product = Product::with('images')->findOrfail($product_id);
        return view('admin.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreProductRequest $request,  $id)
    {
        $product = Product::findOrFail($id);

        // Validate the request data using the form request
        $validatedData = $request->validated();
        dd($request->file('remove_images'));
        if ($request->hasFile('images')) {
            dd($request->file('images'));
        }
        // Handle image upload and deletion
        if ($request->hasFile('image_url')) {
            // Delete the old image if it exists
            if ($product->image_url) {
                $oldImagePath = storage_path('app/' . $product->image_url);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }
            // Store the new image
            $file = $request->file('image_url');
            $fileExtention = $file->getClientOriginalExtension();
            $path = $file->storeAs('\uploads\product/' . uniqid() . '_Product.' . $fileExtention);
            data_set($validatedData, 'image_url', $path);
        }

        // Update the product with the validated data
        $product->update($validatedData);




        Session::flash('message', 'Product updated Successfully!');
        return redirect(route('Product.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}

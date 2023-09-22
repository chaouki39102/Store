<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $categories = Category::paginate(10);
        return view('admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {

        $data = $request->validated();
        if (isset($request->status)) {
            data_set($data, 'status', 1);
        } else {
            data_set($data, 'status', 0);
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileExtention = $file->getClientOriginalExtension();
            $fileName = $file->getClientOriginalName();
            $path = $file->storeAs('/uploads/category/' . uniqid() . '_Category.' . $fileExtention);
            data_set($data, 'image', $path);
        }
        $category = new Category;
        $category->fill($data);
        $category->save();
        session()->flash('message', 'Category added Successfully');
        
        return view('admin.category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($category)
    {
        $category = Category::findOrfail($category);
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, $category)
    {
        $data = $request->validated();
        $category = Category::findOrfail($category);
        $category->name = $data['name'];
        $category->description = $data['description'];
        // dd ($data);

        if ($request->hasFile('image')) {
            if ($category->image) {
                $oldImagePath = storage_path('app/' . $category->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }
            // dd($path);
            $file = $request->file('image');
            $fileExtention = $file->getClientOriginalExtension();
            $path = $file->storeAs('/uploads/category/' . uniqid() . '_Category.' . $fileExtention);
            data_set($data, 'image', $path);
        }

        if (isset($request->status)) {
            data_set($data, 'status', 1);
        } else {
            data_set($data, 'status', 0);
        }

        $category->update($data);
        // $this->alert('success', 'Success is approaching!');
        Alert::success('Success', 'Category updated Successfully');
        Session::flash('message', 'Category updated Successfully!');
        return redirect(route('Category.index'));// view('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        dd($id);
        // $id= $request->id;
        dd($id);
        $category = Category::find($id);
        $category->delete();
        session()->flash('message','Category deleted!');
    }
}

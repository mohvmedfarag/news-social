<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::withCount('posts')->get();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name"=> "required|string|unique:categories,name",
            "slug"=> "required|string|unique:categories,slug",
            "small_desc" => "required|string",
            "status" => "nullable|in:1,0"
        ]);

        $category = Category::create($request->except('_token'));

        return redirect()->back()->with('success','Category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'sometimes|string',
            'slug' => 'sometimes|string',
            'small_desc' => 'sometimes|string',
            'status' => 'nullable|in:1,0'
        ]);

        $category->update($request->only([
            'name',
            'slug',
            'small_desc',
            'status'
        ]));

        return redirect()->back()->with('success','Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success','category deleted successfully');
    }

    public function changeStatus(Category $category){

        if($category->status == true){
            $category->status = false;
            $category->save();
            return redirect()->back()->with('success','status changed successfully');
        }

        $category->status = true;
        $category->save();
        return redirect()->back()->with('success','status changed successfully');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $data['page'] = 'Categories';
        $data['categories'] = Category::with('subCategories')->latest()->paginate(10);
        // Logic to list categories
        return view('admin.categories.index')->with($data);
    }
    public function create()
    {
        $data['page'] = 'Create Category';
        // Logic to show create form
        return view('admin.categories.add')->with($data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:categories,slug',
        ]);

        Category::create($request->only('title', 'slug'));

        return redirect()->route('category.all')->with('success', 'Category created successfully.');
    }
    public function edit($id)
    {
        $data['page'] = 'Edit Category';
        $data['category'] = Category::findOrFail($id);
        // Logic to show edit form
        return view('admin.categories.edit')->with($data);
    }
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'title' => 'required|unique:categories,title,' . $category->id,
            'slug' => 'required|unique:categories,slug,' . $category->id,
        ]);

        $category->update($request->only('title', 'slug'));

        return redirect()->route('category.all')->with('success', 'Category updated successfully.');
    }
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $subCategories = $category->subCategories;
        $category->delete();


        return redirect()->route('category.all')->with('success', 'Category deleted successfully.');
    }

}

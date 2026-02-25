<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubCategory;

class SubCategoryController extends Controller
{
     public function index($id)
    {
        $data['page'] = 'Sub Categories';
        $data['subCategories'] = SubCategory::where('category_id', $id)->latest()->paginate(10);
        // Logic to list sub categories
        $data['category_id'] = $id;
        return view('admin.subcategories.index')->with($data);
    }
    public function create($id)
    {
        $data['page'] = 'Create Sub Category';
        $data['category_id'] = $id;
        // Logic to show create form
        return view('admin.subcategories.add')->with($data);
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:sub_categories,title',
            'slug' => 'required|unique:sub_categories,slug',
        ]);

        SubCategory::create($request->only('title', 'slug', 'category_id'));

        return redirect()->route('subcategory.all',$request->category_id)->with('success', 'Sub Category created successfully.');
    }
    public function edit($id)
    {
        $data['page'] = 'Edit Sub Category';
        $data['subcategory'] = SubCategory::findOrFail($id);
        // Logic to show edit form
        return view('admin.subcategories.edit')->with($data);
    }
    public function update(Request $request, $id)
    {
        $subcategory = SubCategory::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:sub_categories,name,' . $subcategory->id,
            'slug' => 'required|unique:sub_categories,slug,' . $subcategory->id,
        ]);

        $subcategory->update($request->only('name', 'slug'));

        return redirect()->route('subcategory.all', $subcategory->category_id)->with('success', 'Sub Category updated successfully.');
    }
    public function destroy($id)
    {
        $subcategory = SubCategory::findOrFail($id);
        $subcategory->delete();


        return redirect()->route('subcategory.all', $subcategory->category_id)->with('success', 'Sub Category deleted successfully.');
    }
   public function getCategory($id){
        $subcategories = SubCategory::where('category_id', $id)->get();
        return response()->json($subcategories);
   }

}

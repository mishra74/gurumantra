<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Blog;

class BlogController extends Controller
{
        public function index()
        {
            $data['page'] = 'Blogs';
            $data['blogs'] = Blog::with('category', 'subcategory')->latest()->paginate(10);
            // Logic to list blogs
            return view('admin.blogs.index')->with($data);
        }
        public function create()
        {
            $data['page'] = 'Create Blog';
            $data['categories'] = Category::all();
            $data['subcategories'] = SubCategory::all();
            // Logic to show create form
            return view('admin.blogs.add')->with($data);
        }
        public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required',
        'slug' => 'required|unique:blogs,slug',
        'category_id' => 'required',
        'sub_category_id' => 'required',
        'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png',
        'contents' => 'nullable',
        'meta_key' => 'nullable',
    ]);

    // Upload Thumbnail
    if ($request->hasFile('thumbnail')) {
    $file = $request->file('thumbnail');

    $filename = time().'.'.$file->getClientOriginalExtension();

    $file->move(public_path('uploads/blogs'), $filename);

    $validated['thumbnail'] = 'uploads/blogs/'.$filename;
}

    Blog::create($validated);

    return redirect()->route('blog.all')
        ->with('success', 'Blog created successfully.');
}
        public function edit($id)
        {
            $data['page'] = 'Edit Blog';
            $data['blog'] = Blog::findOrFail($id);
            $data['categories'] = Category::all();
            $data['subcategories'] = SubCategory::all();
            // Logic to show edit form
            return view('admin.blogs.edit')->with($data);
        }
       public function update(Request $request, $id)
{
    $blog = Blog::findOrFail($id);

    $validated = $request->validate([
        'title' => 'required',
        'slug' => 'required|unique:blogs,slug,' . $id,
        'category_id' => 'required',
        'sub_category_id' => 'required',
    ]);

    if ($request->hasFile('thumbnail')) {
    $file = $request->file('thumbnail');

    $filename = time().'.'.$file->getClientOriginalExtension();

    $file->move(public_path('uploads/blogs'), $filename);

    $validated['thumbnail'] = 'uploads/blogs/'.$filename;
}
    $blog->update($validated);

    return redirect()->route('blog.all')
        ->with('success', 'Blog updated successfully.');
}
        public function destroy($id)
        {
            $blog = Blog::findOrFail($id);
            $blog->delete();

            return redirect()->route('blog.all')->with('success', 'Blog deleted successfully.');
        }
}

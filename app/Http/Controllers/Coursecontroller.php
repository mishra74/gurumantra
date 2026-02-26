<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class Coursecontroller extends Controller
{
    // Show all courses
    public function index()
    {
        $data['page'] = 'All Courses';
        $data['courses'] = Course::withTrashed()->latest()->paginate(10); 
       
       return view('admin.courses.index')->with($data);
    }

    public function add()
    {
        $data['page'] = 'Add Courses';
       return view('admin.courses.add')->with($data);
    }

    public function edit($id)
    {
        $data['page'] = 'Edit Courses';
        $data['edit'] = Course::where('id',$id)->first();
       return view('admin.courses.edit')->with($data);
    }

    // Store new course
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
            'meta_key' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ]);
  // Upload Thumbnail
    if ($request->hasFile('thumbnail')) {
    $file = $request->file('thumbnail');

    $filename = time().'.'.$file->getClientOriginalExtension();

    $file->move('frontend/uploads/course', $filename);

    $validated['thumbnail'] = 'frontend/uploads/course/'.$filename;
}
        $data = $request->all();
        $data['thumbnail'] = $validated['thumbnail'] ?? null;
        $course = Course::create($data);
        return redirect('admin/courses/all')->with('success','Courses add successfully');
    }

    // Show single course
    public function show($id)
    {
        $course = Course::withTrashed()->findOrFail($id);
         return redirect('admin/courses/all')->with('success','Courses add successfully');
    }

    // Update course
    public function update(Request $request, $id)
    {
        $course = Course::withTrashed()->findOrFail($id);
        $data = $request->all();
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $file->move('frontend/uploads/course', $filename);
            $data['thumbnail'] = 'frontend/uploads/course/'.$filename;
        }
        $course->update($data);
         return redirect('admin/courses/all')->with('success','Courses update successfully');
    }

    // Soft delete
    public function destroy($id)
    {
       

        $course = Course::withTrashed()->findOrFail($id);

        if ($course->trashed()) {
            return redirect('admin/courses/all')->with('error','Course deleted successfully');

        }
        $course->delete();
        return redirect('admin/courses/all')->with('error','Course deleted successfully');
    }
     

public function destroy_permanent($id)
{
    DB::transaction(function () use ($id) {
        $course = Course::withTrashed()->findOrFail($id);

        // Permanently delete related batches
        $course->batches()->forceDelete();

        // Permanently delete course
        $course->forceDelete();
    });

    return redirect()->back()->with('success', 'Course deleted permanently');
}


    

    // Restore
    public function restore($id)
    {
        $course = Course::withTrashed()->findOrFail($id);
        $course->restore();
        return redirect('admin/courses/all')->with('success','Courses restore successfully');
    }

    // Activate / Deactivate
    public function toggleActive($id)
    {
        $course = Course::withTrashed()->findOrFail($id);
        $course->is_active = !$course->is_active;
        $course->save();

        return redirect('admin/courses/all')->with('success','Courses status updated successfully');
    }
}

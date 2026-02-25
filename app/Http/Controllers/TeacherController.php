<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function index($id)
    {
        $data['page'] = 'All Teachers';
        $data['teacher'] = Teacher::where('class_id',$id)->withTrashed()->paginate(10);
        session(['class_id' => $id]);
        return view('admin.teacher.index')->with($data);
    }

    public function add()
    {
        $data['page'] = 'Add Teachers';
        return view('admin.teacher.add')->with($data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:teachers',
            'phone'    => 'nullable|string|max:20',
            'password' => 'required|string|min:6',
            'is_active'=> 'boolean',
        ]);

        Teacher::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'password' => Hash::make($request->password),
            'class_id' =>  session('class_id'),
            'is_active'=> $request->is_active ?? 0,
        ]);

        return redirect('admin/teacher/all/'.session('class_id'))->with('success', 'Teacher created successfully.');
    }

    public function edit(Teacher $teacher)
    {
        return view('admin.teacher.edit', compact('teacher'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:teachers,email,' . $teacher->id,
            'phone'    => 'nullable|string|max:20',
            'password' => 'nullable|string|min:6',
            'is_active'=> 'boolean',
        ]);

        $teacher->update([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'class_id' =>  session(['class_id' => $id]),
            'password' => $request->password ? Hash::make($request->password) : $teacher->password,
            'is_active'=> $request->is_active ?? 0,
        ]);

        return redirect('admin/teacher/all/'.session('class_id'))->with('success', 'Teacher updated successfully.');
    }

    public function destroy($id)
    {
       
        $batch = Teacher::withTrashed()->findOrFail($id);

        if ($batch->trashed()) {
            return redirect('admin/teacher/all/'.session('class_id'))->with('error', 'Teacher deleted successfully.');

        }
    
        $batch->delete();

        return redirect('admin/teacher/all/'.session('class_id'))->with('error', 'Teacher deleted successfully.');
    }

   
    public function restore($id)
    {
        $teacher = Teacher::withTrashed()->findOrFail($id);
        $teacher->restore();
        return redirect('admin/teacher/all/'.session('class_id'))->with('success', 'Teacher restored successfully.');
    }

   
    // public function forceDelete($id)
    // {
    //     $teacher = Teacher::withTrashed()->findOrFail($id);
    //     $teacher->forceDelete();
    //     return redirect()->route('teacher.all')->with('success', 'Teacher permanently deleted.');
    // }

    // Toggle Active/Inactive
    public function toggleActive($id)
    {
        $batch = Teacher::withTrashed()->findOrFail($id);
        $batch->is_active = !$batch->is_active;
        $batch->save();

        return redirect('admin/teacher/all/'.session('class_id'))->with('success','Teacher update deleted');
    }
}

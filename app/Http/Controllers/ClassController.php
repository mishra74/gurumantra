<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\User;
use App\Models\Batch;

use Illuminate\Http\Request;

class ClassController extends Controller
{
    // Show all classes
    public function index()
    {
        
        $data['page'] = 'All Classes';
        $data['classes'] = ClassModel::with(['teacher','batches'])->withTrashed()->latest()->paginate(10);
        return view('admin.classes.index')->with($data);
    }

    // Add new class view
    public function add()
    {
        $data['page'] = 'Add Class';
        //$data['teachers'] = User::where('role','teacher')->get();
        $data['batches'] = Batch::whereNull('deleted_at')
        ->where('is_active', 1)
        ->get();
        return view('admin.classes.add')->with($data);
    }

    // Edit class view
    public function edit($id)
{
    $data['page'] = 'Edit Class';

    $data['class'] = ClassModel::where('id', $id)->first();

    if ($data['class'] == null) {
        return redirect()->back()->with('error', 'Class not found');
    }

    $data['batches'] = Batch::all();

    return view('admin.classes.edit')->with($data);
}


    // Store new class
    public function store(Request $request)
    {
       
        $request->validate([
            'title' => 'required|string|max:255',
            'time' => 'nullable|string|max:255',
            'start_date' => 'nullable|date',
            'description' => 'nullable|string',
            'meta_key' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
             'is_active' => 'boolean',
        ]);

        $data = $request->all();
        $data['batches'] = json_encode($request->batches);
        $batch = ClassModel::create($data);
        return redirect('admin/class/all')->with('success','Class added successfully');
    }

    // Show single class
    public function show($id)
    {
        $class = ClassModel::withTrashed()->findOrFail($id);
        return view('admin.classes.show', compact('class'));
    }

    // Update class
    public function update(Request $request, $id)
    {
        $class = ClassModel::withTrashed()->findOrFail($id);
        $class->update($request->only([
            'title','time','teacher_id','start_date',
            'description','meta_key','meta_description','is_active'
        ]));

        if($request->batches){
            $class->batches()->sync($request->batches);
        }

        return redirect('admin/class/all')->with('success','Class updated successfully');
    }
    
// Soft delete
    public function destroy_permanent($id)
    {
        


        $class = ClassModel::withTrashed()->findOrFail($id)->forceDelete();;

       
        return redirect()->back()->with('error','Class deleted successfully');
    }
    // Soft delete
    public function destroy($id)
    {
        


        $class = ClassModel::withTrashed()->findOrFail($id);

        if ($class->trashed()) {
            return redirect('admin/class/all')->with('error','Class deleted successfully');

        }
       
        $class->delete();
        return redirect('admin/class/all')->with('error','Class deleted successfully');
    }

    // Restore
    public function restore($id)
    {
        $class = ClassModel::withTrashed()->findOrFail($id);
        $class->restore();
        return redirect('admin/class/all')->with('success','Class restored successfully');
    }

    // Activate / Deactivate
    public function toggleActive($id)
    {
        $class = ClassModel::withTrashed()->findOrFail($id);
        $class->is_active = !$class->is_active;
        $class->save();

        return redirect('admin/class/all')->with('success','Class status updated successfully');
    }
}

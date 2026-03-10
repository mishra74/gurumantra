<?php

namespace App\Http\Controllers;
use App\Models\ClassModel;
use App\Models\User;
use App\Models\Batch;
use App\Models\ClassList;

use Illuminate\Http\Request;

class ClassListController extends Controller
{
    // Show all classes
    public function index()
    {
        
        $data['page'] = 'All Class Rooms';
        $data['classes'] = ClassList::latest()->paginate(10);
        $data['class_room_id'] = request()->route('id');
        return view('admin.classlist.index')->with($data);
    }

    // Add new class view
    public function add($id)
    {
        $data['page'] = 'Add Class';
        //$data['teachers'] = User::where('role','teacher')->get();
        $data['class_room_id']=$id;
        $data['batches'] = Batch::whereNull('deleted_at')
        ->where('is_active', 1)
        ->get();
        return view('admin.classlist.add')->with($data);
    }

    // Edit class view
    public function edit($id)
{
    $data['page'] = 'Edit Class';

    $data['class'] = ClassList::where('id', $id)->first();

    if ($data['class'] == null) {
        return redirect()->back()->with('error', 'Class not found');
    }

    $data['batches'] = Batch::all();

    return view('admin.classlist.edit')->with($data);
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
        $batch = ClassList::create($data);
        return redirect('admin/class/all')->with('success','Class added successfully');
    }

    // Show single class
    public function show($id)
    {
        $class = ClassList::withTrashed()->findOrFail($id);
        return view('admin.classroom.show', compact('class'));
    }

    // Update class
    public function update(Request $request, $id)
    {
        $class = ClassList::withTrashed()->findOrFail($id);
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
        


        $class = ClassList::withTrashed()->findOrFail($id)->forceDelete();;

       
        return redirect()->back()->with('error','Class deleted successfully');
    }
    // Soft delete
    public function destroy($id)
    {
        


        $class = ClassList::withTrashed()->findOrFail($id);

        if ($class->trashed()) {
            return redirect('admin/class/all')->with('error','Class deleted successfully');

        }
       
        $class->delete();
        return redirect('admin/class/all')->with('error','Class deleted successfully');
    }

    // Restore
    public function restore($id)
    {
        $class = ClassList::withTrashed()->findOrFail($id);
        $class->restore();
        return redirect('admin/class/all')->with('success','Class restored successfully');
    }

    // Activate / Deactivate
    public function toggleActive($id)
    {
        $class = ClassList::withTrashed()->findOrFail($id);
        $class->is_active = !$class->is_active;
        $class->save();

        return redirect('admin/class/all')->with('success','Class status updated successfully');
    }
}

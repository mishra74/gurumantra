<?php

namespace App\Http\Controllers;

use App\Models\ViewrecorderModel;
use Illuminate\Http\Request;
use App\Models\Course;

class VideorecordingController extends Controller
{
     // Show all batches
     public function index()
     {
         $data['page'] = 'All Video Recording';
         $data['video'] = ViewrecorderModel::withTrashed()->latest()->paginate(10);
         return view('admin.videorecording.index')->with($data);
     }
 
     public function add()
     {
         $data['page'] = 'Add Video Recording';
         $data['courses'] = Course::where('is_active',1)->whereNull('deleted_at')->get();
         return view('admin.videorecording.add')->with($data);
     }
 
     // Store new batch
     public function store(Request $request)
     {
         //dd($request->all());
         $request->validate([
             'title' => 'required|string|max:255',
             'description' => 'nullable|string',
             'mrp' => 'nullable|string|max:255',
             'start_date' => 'nullable|date',
             'is_active' => 'boolean',
         ]);
 //dd($request->all());
         $data = $request->all();
         $data['courses'] = json_encode($request->courses);
         $batch = ViewrecorderModel::create($data);
 
         return redirect('admin/recordings/all')->with('success','Video Recording Add sucessfully');
     }
 
     // Show single batch
     public function show($id)
     {
         $batch = ViewrecorderModel::withTrashed()->findOrFail($id);
         return redirect('admin/recordings/all')->with('success','Video Recording  successfully');
 
     }
      public function edit($id)
{
    $data['page'] = 'Edit Recording';
    $data['edit'] = ViewrecorderModel::withTrashed()->findOrFail($id);
    $data['courses'] = Course::all();
    return view('admin.videorecording.edit', $data);
}

     
 
     // Update batch
     public function update(Request $request, $id)
     {
         $batch = ViewrecorderModel::withTrashed()->findOrFail($id);
         $batch->update($request->all());
         return redirect('admin/recordings/all')->with('success','Video Recording Update successfully');
 
     }
 
     // Soft delete
     public function destroy($id)
     {
         $test = ViewrecorderModel::withTrashed()->findOrFail($id);
 
         if ($test->trashed()) {
             return redirect()->back()->with('error', 'Video Recording delete deleted.');
         }
     
         $test->delete();
 
         return redirect('admin/recordings/all')->with('error','VideoRecording delete successfully');
     }
 
    public function destroy_permanent($id)
    {
        $batch = ViewrecorderModel::withTrashed()->findOrFail($id)->forceDelete();
       
        return redirect()->back()->with('error','Batch delete successfully');
    }
     // Restore
     public function restore($id)
     {
         $batch = ViewrecorderModel::withTrashed()->findOrFail($id);
         $batch->restore();
         return redirect('admin/recordings/all')->with('success','Video Recording restore successfully');
     }
 
     // Toggle Active/Inactive
     public function toggleActive($id)
     {
         $batch = ViewrecorderModel::withTrashed()->findOrFail($id);
         $batch->is_active = !$batch->is_active;
         $batch->save();
 
         return redirect('admin/recordings/all')->with('success','Video Recording update successfully');
     }
}

<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use Illuminate\Http\Request;

class OffLineBatchesController extends Controller
{
    // Show all batches
    public function index($id)
    {
        $data['page'] = 'OffLine All Batches';
        session(['course_id' => $id]);
        $data['batches'] = Batch::where('course_id',$id)->withTrashed()->latest()->paginate(10);
        return view('admin.batch.index')->with($data);
    }

    public function add()
    {
        $data['page'] = 'Add OffLine Batches';
        return view('admin.batch.add')->with($data);
    }
public function edit($id)
    {
        $data['page'] = 'Edit OffLine Batches';
        $data['edit']=Batch::withTrashed()->findOrFail($id);
        return view('admin.batch.edit')->with($data);
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
          // Upload Thumbnail
    if ($request->hasFile('thumbnail')) {
    $file = $request->file('thumbnail');

    $filename = time().'.'.$file->getClientOriginalExtension();

    $file->move('frontend/uploads/batch', $filename);

    $validated['thumbnail'] = 'frontend/uploads/batch/'.$filename;
}
        $data = $request->all();
        $data['course_id'] = session('course_id');
        $data['thumbnail'] = $validated['thumbnail'] ?? null;
        $batch = Batch::create($data);
        return redirect('cource/batch/'.session('course_id'))->with('success','Batch add sucessfully');
    }

    // Show single batch
    public function show($id)
    {
        $batch = Batch::withTrashed()->findOrFail($id);
        return redirect('cource/batch/'.session('course_id'))->with('success','Batch add successfully');

    }

    // Update batch
    public function update(Request $request, $id)
    {
        $batch = Batch::withTrashed()->findOrFail($id);
          // Upload Thumbnail
    if ($request->hasFile('thumbnail')) {
    $file = $request->file('thumbnail');

    $filename = time().'.'.$file->getClientOriginalExtension();

    $file->move('frontend/uploads/batch', $filename);

    $validated['thumbnail'] = 'frontend/uploads/batch/'.$filename;
}
        $data = $request->all();
        $data['thumbnail'] = $validated['thumbnail'] ?? null;
        $batch->update($data);
        return redirect('cource/batch/'.session('course_id'))->with('success','Batch update successfully');

    }

    // Soft delete
    public function destroy($id)
    {
        $batch = Batch::withTrashed()->findOrFail($id);

        if ($batch->trashed()) {
            return redirect('cource/batch/'.session('course_id'))->with('error','Batch delete successfully');

        }
        $batch->delete();
        return redirect('cource/batch/'.session('course_id'))->with('error','Batch delete successfully');
    }
    public function destroy_permanent($id)
    {
        $batch = Batch::withTrashed()->findOrFail($id)->forceDelete();
       
        return redirect('cource/batch/'.session('course_id'))->with('error','Batch delete successfully');
    }

    // Restore
    public function restore($id)
    {
        $batch = Batch::withTrashed()->findOrFail($id);
        $batch->restore();
        return redirect('cource/batch/'.session('course_id'))->with('success','Batch restore successfully');
    }

    // Toggle Active/Inactive
    public function toggleActive($id)
    {
        $batch = Batch::withTrashed()->findOrFail($id);
        $batch->is_active = !$batch->is_active;
        $batch->save();

        return redirect('cource/batch/'.session('course_id'))->with('success','Batch update successfully');
    }
}

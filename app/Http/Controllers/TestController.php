<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\Request;
use App\Models\Course;

class TestController extends Controller
{
    // Show all batches
    public function index()
{
    $data['page'] = 'All Tests';

    $data['test'] = Test::withTrashed()
        ->orderBy('id', 'desc')   // newest first
        ->paginate(10);

    return view('admin.test.index')->with($data);
}


    public function add()
    {
        $data['page'] = 'Add Test';
        $data['courses'] = Course::where('is_active',1)->whereNull('deleted_at')->get();
        
        return view('admin.test.add')->with($data);
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
        $batch = Test::create($data);

        return redirect('admin/test/all')->with('success','Test add sucessfully');
    }

    // Show single batch
    public function show($id)
    {
        $data['page'] = 'Edit Test';
        $data['test'] = Test::withTrashed()->findOrFail($id);
        //dd($data['test']);
                $data['courses'] = Course::where('is_active',1)->whereNull('deleted_at')->get();

 return view('admin.test.edit')->with($data);
    }

    // Update batch
    public function update(Request $request, $id)
    {
        //dd($id);
         // Validate request
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'mrp' => 'nullable|string|max:255',
        'start_date' => 'nullable|date',
        'is_active' => 'boolean',
    ]);

    // Find record
    
    $test = Test::findOrFail($id);

    // Prepare data
    $data = $request->all();
    $data['courses'] = json_encode($request->courses ?? []); // JSON encode for multiple select

    // Update record
    $test->update($data);
    

        return redirect('admin/test/all')->with('success','Test add sucessfully');

    }

    // Soft delete
    public function destroy($id)
    {
        $test = Test::withTrashed()->findOrFail($id);

        if ($test->trashed()) {
            return redirect()->back()->with('error', 'Test delete deleted.');
        }
    
        $test->delete();

        return redirect('admin/test/all')->with('error','Test delete successfully');
    }
   public function destroy_permanent($id)
{
    Test::withTrashed()->findOrFail($id)->forceDelete();

    return redirect()->back()->with('success', 'Test deleted permanently');
}


    // Restore
    public function restore($id)
    {
        $batch = Test::withTrashed()->findOrFail($id);
        $batch->restore();
        return redirect('admin/test/all')->with('success','Test restore successfully');
    }

    // Toggle Active/Inactive
    public function toggleActive($id)
    {
        $batch = Test::withTrashed()->findOrFail($id);
        $batch->is_active = !$batch->is_active;
        $batch->save();

        return redirect('admin/test/all')->with('success','Test update successfully');
    }
}

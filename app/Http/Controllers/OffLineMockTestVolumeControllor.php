<?php

namespace App\Http\Controllers;

use App\Models\Center;
use App\Models\Test;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\OffLineMockTestVolume;
use App\Models\zone;

class OffLineMockTestVolumeControllor extends Controller
{
    // Show all batches
    public function index()
{
    $data['page'] = 'All Mock Tests Volumes';

    $data['test'] = OffLineMockTestVolume::withTrashed()->orderBy('id', 'desc')
        ->paginate(10);

    return view('admin.offlinemocktestvolume.index')->with($data);
}
public function centers($id)
{
    $data['centers'] = Center::where('zone_id', $id)->where('is_active',1)->get();
    return response()->json($data);

}

   public function add()
{
    $data['page'] = 'Add Test';

    // Load zones with centers
    $data['centers'] = Center::where('is_active', 1)->get();

    return view('admin.offlinemocktestvolume.add', $data);
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
        $data['center_id'] = json_encode($request->center_ids ?? []); // JSON encode for multiple select
          // Upload Thumbnail
    if ($request->hasFile('thumbnail')) {
    $file = $request->file('thumbnail');

    $filename = time().'.'.$file->getClientOriginalExtension();

    $file->move('frontend/uploads/test', $filename);

    $validated['thumbnail'] = 'frontend/uploads/test/'.$filename;
}
        $data['thumbnail'] = $validated['thumbnail'] ?? null;
        $batch = OffLineMockTestVolume::create($data);

        return redirect('admin/offline/mocktest/volume/all')->with('success','Test add sucessfully');
    }

    // Show single batch
    public function edit($id)
    {
        $data['page'] = 'Edit Test';
        $data['data'] = OffLineMockTestVolume::withTrashed()->findOrFail($id);
        //dd($data['test']);
    $data['centers'] = Center::where('is_active', 1)->get();

 return view('admin.offlinemocktestvolume.edit')->with($data);
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
    
    $test = OffLineMockTestVolume::findOrFail($id);

    // Prepare data
    $data = $request->all();
$data['center_id'] = json_encode($request->center_ids ?? []); 
    if ($request->hasFile('thumbnail')) {
        $file = $request->file('thumbnail');
        $filename = time().'.'.$file->getClientOriginalExtension();
        $file->move('frontend/uploads/test', $filename);
        $data['thumbnail'] = 'frontend/uploads/test/'.$filename;
    }

    // Update record
    $test->update($data);
    

        return redirect()->back()->with('success','Test update successfully');

    }

    // Soft delete
    public function destroy($id)
    {
    
        $test = OffLineMockTestVolume::withTrashed()->findOrFail($id);

        if ($test->trashed()) {
            return redirect()->back()->with('error', 'Test delete deleted.');
        }
    
        $test->delete();

        return redirect()->back()->with('error','Test delete successfully');
    }
   public function destroy_permanent($id)
{
    OffLineMockTestVolume::withTrashed()->findOrFail($id)->forceDelete();

    return redirect()->back()->with('success', 'Test deleted permanently');
}


    // Restore
    public function restore($id)
    {
        $batch = OffLineMockTestVolume::withTrashed()->findOrFail($id);
        $batch->restore();
        return redirect()->back()->with('success','Test restore successfully');
    }

    // Toggle Active/Inactive
    public function toggleActive($id)
    {
        $batch = OffLineMockTestVolume::withTrashed()->findOrFail($id);
        $batch->is_active = !$batch->is_active;
        $batch->save();

        return redirect()->back()->with('success','Test update successfully');
    }
}

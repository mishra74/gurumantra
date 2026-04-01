<?php

namespace App\Http\Controllers;

use App\Models\Center;
use App\Models\CenterPrice;
use App\Models\Test;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\OffLineMockTestVolume;
use App\Models\Zone;

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
$data['zones']=Zone::where('is_active', 1)->get();
    return view('admin.offlinemocktestvolume.add', $data);
}
public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
    ]);

    // ❗ remove array fields
    $data = $request->except([
        'mrp',
        'price',
        'zone_ids',
        'center_ids',
        'total_seat'
    ]);

    // Thumbnail
    if ($request->hasFile('thumbnail')) {
        $file = $request->file('thumbnail');
        $filename = time().'.'.$file->getClientOriginalExtension();
        $file->move('frontend/uploads/test', $filename);

        $data['thumbnail'] = 'frontend/uploads/test/'.$filename;
    }

    // ❌ DO NOT ADD MRP/PRICE HERE

    // Save main table
    $testvolume = OffLineMockTestVolume::create($data);

    // ✅ Insert center pricing
    if ($request->has('center_ids')) {

        foreach ($request->center_ids as $key => $centerId) {

            CenterPrice::create([
                'zone_id' => $request->zone_ids[$key] ?? null,
                'center_id' => $centerId,
                'mock_test_volume_id' => $testvolume->id,
                'mrp' => $request->mrp[$key] ?? 0,
                'price' => $request->price[$key] ?? 0,
                'total_seat' => $request->total_seat[$key] ?? 0,
            ]);
        }
    }

    return redirect('admin/offline/mocktest/volume/all')
        ->with('success','Test added successfully');
}
    // Show single batch
    public function edit($id)
    {
        $data['page'] = 'Edit Test';
        $data['data'] = OffLineMockTestVolume::with('centerPrices')->withTrashed()->findOrFail($id);
        //dd($data['test']);
     $data['centers'] = Center::where('is_active', 1)->get();
$data['zones']=Zone::where('is_active', 1)->get();

 return view('admin.offlinemocktestvolume.edit')->with($data);
    }

   public function update(Request $request, $id)
{
    $testvolume = OffLineMockTestVolume::findOrFail($id);

    $data = $request->except([
        'zone_ids',
        'center_ids',
        'mrp',
        'price',
        'total_seat'
    ]);
 // Thumbnail
    if ($request->hasFile('thumbnail')) {
        $file = $request->file('thumbnail');
        $filename = time().'.'.$file->getClientOriginalExtension();
        $file->move('frontend/uploads/test', $filename);

        $data['thumbnail'] = 'frontend/uploads/test/'.$filename;
    }
    // update main
    $testvolume->update($data);

    // ❗ delete old pricing
    CenterPrice::where('mock_test_volume_id', $id)->delete();

    // insert new
    if ($request->has('center_ids')) {
        foreach ($request->center_ids as $key => $centerId) {

            CenterPrice::create([
                'zone_id' => $request->zone_ids[$key],
                'center_id' => $centerId,
                'mock_test_volume_id' => $id,
                'mrp' => $request->mrp[$key],
                'price' => $request->price[$key],
                'total_seat' => $request->total_seat[$key],
            ]);
        }
    }

    return back()->with('success', 'Updated successfully');
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

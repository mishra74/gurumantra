<?php

namespace App\Http\Controllers;

use App\Models\Center;
use Illuminate\Http\Request;


class CenterController extends Controller
{
      //
    public function index($id)
{
    $data['page'] = 'All Center';


    $data['centers'] = Center::where('zone_id',$id)->orderBy('id','desc')
                        ->paginate(10);
$data['zone_id']=$id;
    return view('admin.center.index', $data);
}


    public function add($id){
        $data['page'] = 'Add Center';
        $data['zone_id']=$id;
        return view('admin.center.add')->with($data);
    }


    public function store(Request $request){
        $request->validate([
            'title' => 'required|string|max:255',
        ]); 
        $data = $request->all();
       
    if ($request->hasFile('thumbnail')) {
    $file = $request->file('thumbnail');

    $filename = time().'.'.$file->getClientOriginalExtension();

    $file->move('frontend/uploads/batch', $filename);

    $data['thumbnail'] = 'frontend/uploads/batch/'.$filename;
}
        Center::create($data);
        return redirect('admin/center/all/'.$request->zone_id)->with('success','Zone add successfully');

    }

// Update course
    public function edit($id)
    {   $data['page']="Edit Zonne";
        $data['center'] = Center::findOrFail($id);
        
         return view('admin.center.edit')->with($data);
    }

    // Update course
    public function update(Request $request, $id)
    {
        $course = Center::findOrFail($id);
         $data = $request->all();
        if ($request->hasFile('thumbnail')) {
    $file = $request->file('thumbnail');

    $filename = time().'.'.$file->getClientOriginalExtension();

    $file->move('frontend/uploads/batch', $filename);

    $data['thumbnail'] = 'frontend/uploads/batch/'.$filename;
}
        $course->update($data);
         return redirect()->back()->with('success','Zone update successfully');
    }

    // Soft delete
    public function destroy($id)
    {
       

        $course = Center::findOrFail($id);

        
        $course->delete();
        return redirect()->back()->with('error','Zone deleted successfully');
    }

    // Restore
    public function restore($id)
    {

       
        $course = Center::findOrFail($id);
        $course->restore();
        return redirect()->back()->with('success','Zone restore successfully');
    }

    // Activate / Deactivate
    public function toggleActive($id)
    {
        $course = Center::findOrFail($id);
        $course->is_active = !$course->is_active;
        $course->save();

        return redirect()->back()->with('success','Zone status updated successfully');
    }
}

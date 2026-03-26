<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Zone;

class ZoneController extends Controller
{
    //
    public function index()
{
    $data['page'] = 'All Zone';


    $data['zones'] = Zone::orderBy('id','desc')
                        ->paginate(10);

    return view('admin.zone.index', $data);
}


    public function add(){
        $data['page'] = 'Add Zone';
        return view('admin.zone.add')->with($data);
    }


    public function store(Request $request){
        $request->validate([
            'title' => 'required|string|max:255',
        ]); 
        $data = $request->all();
        Zone::create($data);
        return redirect()->back()->with('success','Zone add successfully');

    }

// Update course
    public function edit($id)
    {   $data['page']="Edit Zonne";
        $data['zone'] = Zone::findOrFail($id);
        
         return view('admin.zone.edit')->with($data);
    }

    // Update course
    public function update(Request $request, $id)
    {
        $course = Zone::findOrFail($id);
        $course->update($request->all());
         return redirect()->back()->with('success','Zone update successfully');
    }

    // Soft delete
    public function destroy($id)
    {
       

        $course = Zone::findOrFail($id);

        
        $course->delete();
        return redirect()->back()->with('error','Zone deleted successfully');
    }

    // Restore
    public function restore($id)
    {

       
        $course = Zone::findOrFail($id);
        $course->restore();
        return redirect()->back()->with('success','Zone restore successfully');
    }

    // Activate / Deactivate
    public function toggleActive($id)
    {
        $course = Zone::findOrFail($id);
        $course->is_active = !$course->is_active;
        $course->save();

        return redirect()->back()->with('success','Zone status updated successfully');
    }

}
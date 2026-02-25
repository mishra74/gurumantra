<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Tags;


class TagController extends Controller
{
    public function index($id)
{
    $data['page'] = 'All Tags';

    session(['quetion_id' => $id]);

    $data['tags'] = Tags::withTrashed()
                        ->orderBy('id','desc')
                        ->paginate(10);

    return view('admin.tag.index', $data);
}


    public function add(){
        $data['page'] = 'Add Tags';
        return view('admin.tag.add')->with($data);
    }


    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
        ]); 
        $data = $request->all();
        $data['quetion_id'] = session('quetion_id');
        Tags::create($data);
        return redirect('questions/tag/'.session('quetion_id'))->with('success','Tags add successfully');

    }


    // Update course
    public function update(Request $request, $id)
    {
        $course = Tags::withTrashed()->findOrFail($id);
        $course->update($request->all());
         return redirect('questions/tag/'.session('quetion_id'))->with('success','Tags update successfully');
    }

    // Soft delete
    public function destroy($id)
    {
       

        $course = Tags::withTrashed()->findOrFail($id);

        if ($course->trashed()) {
            return redirect('questions/tag/'.session('quetion_id'))->with('error','Tags deleted successfully');

        }
        $course->delete();
        return redirect('questions/tag/'.session('quetion_id'))->with('error','Tags deleted successfully');
    }

    // Restore
    public function restore($id)
    {

       
        $course = Tags::withTrashed()->findOrFail($id);
        $course->restore();
        return redirect('questions/tag/'.session('quetion_id'))->with('success','Tags restore successfully');
    }

    // Activate / Deactivate
    public function toggleActive($id)
    {
        $course = Tags::withTrashed()->findOrFail($id);
        $course->is_active = !$course->is_active;
        $course->save();

        return redirect('questions/tag/'.session('quetion_id'))->with('success','Tags status updated successfully');
    }

}

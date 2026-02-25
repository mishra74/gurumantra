<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Questions;
class QuestionsController extends Controller
{
    public function index(){
        $data['page'] = 'All Questions';
        $data['question'] = Questions::withTrashed()->paginate(10);
        return view('admin.quetion.index')->with($data);
    }

    public function add(){
        $data['page'] = 'Add Questions';
        return view('admin.quetion.add')->with($data);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
        ]); 

        $course = Questions::create($request->all());
        return redirect('admin/questions/all')->with('success','Questions add successfully');
        
        
    }


    // Update course
    public function update(Request $request, $id)
    {
        $course = Questions::withTrashed()->findOrFail($id);
        $course->update($request->all());
         return redirect('admin/questions/all')->with('success','Questions update successfully');
    }

    // Soft delete
    public function destroy($id)
    {
       

        $course = Questions::withTrashed()->findOrFail($id);

        if ($course->trashed()) {
            return redirect('admin/questions/all')->with('error','Questions deleted successfully');

        }
        $course->delete();
        return redirect('admin/questions/all')->with('error','Questions deleted successfully');
    }

    // Restore
    public function restore($id)
    {

       
        $course = Questions::withTrashed()->findOrFail($id);
        $course->restore();
        return redirect('admin/questions/all')->with('success','Questions restore successfully');
    }

    // Activate / Deactivate
    public function toggleActive($id)
    {
        $course = Questions::withTrashed()->findOrFail($id);
        $course->is_active = !$course->is_active;
        $course->save();

        return redirect('admin/questions/all')->with('success','Questions status updated successfully');
    }


}

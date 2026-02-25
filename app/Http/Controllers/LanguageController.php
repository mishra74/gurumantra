<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Language;

class LanguageController extends Controller
{
        public function index()
{
    $data['page'] = 'All Language';


    $data['languages'] = Language::orderBy('id','desc')
                        ->paginate(10);

    return view('admin.language.index', $data);
}


    public function add(){
        $data['page'] = 'Add Language';
        return view('admin.language.add')->with($data);
    }
public function edit($id){
        $data['page'] = 'Edit Language';
        $data['language'] = Language::find($id);

        return view('admin.language.edit')->with($data);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
        ]); 
        
        $data=new Language();
        $data->name=$request->name;
        $data->save();
        return redirect('language/')->with('success','Language add successfully');

    }


    // Update course
    public function update(Request $request, $id)
    {
        $data = Language::findOrFail($id);
        $data->name=$request->name;
        $data->save();
         return redirect('language/')->with('success','Tags update successfully');
    }

    // Soft delete
    public function destroy($id)
    {
       

        $course = Language::findOrFail($id);

        $course->delete();
        return redirect('language/')->with('error','Language deleted successfully');
    }

    // Restore
    public function restore($id)
    {

       
        $course = Language::withTrashed()->findOrFail($id);
        $course->restore();
        return redirect('language/')->with('success','Language restore successfully');
    }

    // Activate / Deactivate
    public function toggleActive($id)
    {
        $course = Language::withTrashed()->findOrFail($id);
        $course->is_active = !$course->is_active;
        $course->save();

        return redirect('language/')->with('success','Language status updated successfully');
    }


}



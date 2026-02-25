<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sectionmodel;
use App\Models\QuestionBank;
use App\Models\Questions;
use App\Models\Language;
use App\Models\QuestionToVolume;

class SectionController extends Controller
{
    public function index($id){
       
        $data['page'] = 'All Sections';
        session(['create_testID' => $id]);
        session(['tid' => $id]);
        $data['section'] = Sectionmodel::withTrashed()->orderBy('id','desc')
                        ->paginate(10);
        return view('admin.section.index',$data);
    }


    public function add(){
        
        $data['page'] = 'Add Sections';
        //$data['section'] = Sectionmodel::withTrashed()->latest()->paginate(10);
        $data['languages']=Language::all();
        return view('admin.section.add')->with($data);
    }
public function edit($id)
{
    $data['page'] = 'Edit Section';
    $data['section'] = Sectionmodel::findOrFail($id);
    $data['languages'] = Language::all();

    return view('admin.section.edit')->with($data);
}



    public function store(Request $request){
        $request->validate([
            'title'     => 'required',
            'marks'    => 'required',
            'negative_marks'    => 'required',
        ]);
        Sectionmodel::create([
            'create_test'     => session('create_testID'),
            'title'    => $request->title,
            'marks'    => $request->marks,
            'language' => $request->language,
            'negative_marks' => $request->negative_marks,
            'is_active'=> $request->is_active ?? 0,
        ]);

        return redirect('admin/section/'.session('create_testID'))->with('success','Section add successfully');
    }
public function update(Request $request, $id)
{
    $section = Sectionmodel::findOrFail($id);

    $section->update([
        'title' => $request->title,
        'marks' => $request->marks,
        'negative_marks' => $request->negative_marks,
        'language' => $request->language,
        'is_active' => $request->is_active,
    ]);

    return redirect()->back()
                     ->with('success', 'Section Updated Successfully');
}

    public function add_question($id){
        $data['page'] = 'Add Questions';
        session(['sectionID' => $id]);
        $data['QuestionBank'] = Questions::where('is_active',1)->whereNull('deleted_at')->get();
     
        return view('admin.section.add_question')->with($data);
    }
// Soft delete
    public function destroy($id)
    {
        $Sectionmodel = Sectionmodel::withTrashed()->findOrFail($id);

        if ($Sectionmodel->trashed()) {
            return redirect()->back()->with('error','Batch delete successfully');

        }
        $Sectionmodel->delete();
        return redirect()->back()->with('error','Batch delete successfully');
    }
    public function destroy_permanent($id)
    {
        $batch = Sectionmodel::withTrashed()->findOrFail($id)->forceDelete();
       
        return redirect()->back()->with('error','Batch delete successfully');
    }

    public function getQuestion($id)
    {
       
       // Get session values
       $volume_id = session('tvid');
       $test_id = session('tid');
       $section_id = session('sectionID');

   // Get question IDs already added
    $alreadyAdded = QuestionToVolume::where([
        'volume_id' => $volume_id,
        'test_id' => $test_id,
        'section_id' => $section_id
    ])->pluck('question_id')->toArray();
 $alreadyAdded = QuestionToVolume::pluck('question_id')->toArray();

  //  Fetch remaining questions only
    $question = QuestionBank::where('question_tileid', $id)
        ->whereNotIn('id', $alreadyAdded)
        ->get();
//$question = QuestionBank::all();
    if ($question->isEmpty()) {
        return response()->json(['status' => false, 'message' => 'No new questions found']);
    }

    return response()->json([
        'status' => true,
        'data' => $question
    ]);


    }
}




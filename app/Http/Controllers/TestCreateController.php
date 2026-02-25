<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CreateModel;

class TestCreateController extends Controller
{
    public function index($id)
{
    $data['page'] = 'All Tests';

    session(['tvid' => $id]);

    $data['create_test'] = CreateModel::withTrashed()
        ->where('volume_id', $id)
        ->paginate(10);

    session(['test_volume' => $id]);

    return view('admin.create_test.index')->with($data);
}


    public function add(){
        $data['page'] = 'Add Tests';
        return view('admin.create_test.add')->with($data);
    }
    public function edit($id){
        $data['page'] = 'Edit Tests';
        $data['edit'] =CreateModel::withTrashed()->findOrFail($id);
        return view('admin.create_test.edit')->with($data);
    }

    public function store(Request $request){
        $data = $request->all();
        if ($request->hasFile('pdf_upload_question')) {
            $data['pdf_file_question'] = $request->file('pdf_upload_question')->store('dailycurrent/pdfs', 'public');
        }
        
        if ($request->hasFile('pdf_upload_answer')) {
            $data['pdf_file_answer'] = $request->file('pdf_upload_answer')->store('dailycurrent/pdfs', 'public');
        }

      if($request->live_class == 'yes'){
        $data['live_class'] = 1;
      }else{
        $data['live_class'] =0;
      }

        $data['volume_id'] = session('test_volume');
        $data['pdf_enter_question'] = $request->content_upload_question;
        $data['pdf_enter_answer'] = $request->content_upload_answer;
        CreateModel::create($data);
      return redirect('admin/test_create/'.session('test_volume'))->with('success','Test Created Successfully');


    }
    public function update(Request $request, $id)
{
    $test = CreateModel::findOrFail($id);

    $data = $request->except([
        '_token',
        '_method',
        'pdf_upload_question',
        'pdf_upload_answer'
    ]);

    /* ---------------- PDF QUESTION ---------------- */
    if ($request->hasFile('pdf_upload_question')) {
        $data['pdf_file_question'] =
            $request->file('pdf_upload_question')
                    ->store('dailycurrent/pdfs', 'public');
    } else {
        $data['pdf_file_question'] = $test->pdf_file_question;
    }

    /* ---------------- PDF ANSWER ---------------- */
    if ($request->hasFile('pdf_upload_answer')) {
        $data['pdf_file_answer'] =
            $request->file('pdf_upload_answer')
                    ->store('dailycurrent/pdfs', 'public');
    } else {
        $data['pdf_file_answer'] = $test->pdf_file_answer;
    }

    /* ---------------- LIVE CLASS ---------------- */
    $data['live_class'] = $request->live_class === 'yes' ? 1 : 0;

    /* ---------------- CONTENT ---------------- */
    $data['pdf_enter_question'] = $request->content_upload_question;
    $data['pdf_enter_answer']   = $request->content_upload_answer;

    /* ---------------- UPDATE ---------------- */
    $test->update($data);

    return redirect()
        ->back()
        ->with('success', 'Test Updated Successfully');
}
 public function destroy($id)
    {
        $test = CreateModel::withTrashed()->findOrFail($id);

        if ($test->trashed()) {
            return redirect()->back()->with('error', 'Test delete deleted.');
        }
    
        $test->delete();

        return redirect()->back()->with('error','Notes delete successfully');
    }
         public function destroy_permanent($id)
{
    CreateModel::withTrashed()->findOrFail($id)->forceDelete();

    return redirect()->back()->with('success', 'Test  deleted permanently');
}

    // Restore
    public function restore($id)
    {
        $batch = CreateModel::withTrashed()->findOrFail($id);
        $batch->restore();
        return redirect()->back()->with('success','Test restore successfully');
    }

    // Toggle Active/Inactive
    public function toggleActive($id)
    {
        $batch = CreateModel::withTrashed()->findOrFail($id);
        $batch->is_active = !$batch->is_active;
        $batch->save();

        return redirect()->back()->with('success','Test update successfully');
    }



    
}

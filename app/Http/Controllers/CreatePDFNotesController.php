<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CreatePDFNotesModel;

class CreatePDFNotesController extends Controller
{
    public function index($id){
        $data['page'] = 'All PDF Notes';
        $data['create_test'] = CreatePDFNotesModel::withTrashed()->where('volume_id',$id)->latest()->paginate(10);
        session(['notes_volume' => $id]);
        return view('admin.createpdf.index')->with($data);
    }

    public function add(){
        $data['page'] = 'Add PDF Notes';
        return view('admin.createpdf.add')->with($data);
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
  // Upload Thumbnail
    if ($request->hasFile('thumbnail')) {
    $file = $request->file('thumbnail');

    $filename = time().'.'.$file->getClientOriginalExtension();

    $file->move('frontend/uploads/pdfnotes', $filename);

    $validated['thumbnail'] = 'frontend/uploads/pdfnotes/'.$filename;
}
        $data['volume_id'] = session('notes_volume');
        $data['pdf_enter_question'] = $request->content_upload_question;
        $data['pdf_enter_answer'] = $request->content_upload_answer;
        $data['thumbnail'] = $validated['thumbnail'] ?? null;
        CreatePDFNotesModel::create($data);
      return redirect('admin/create_pdfnote/'.session('notes_volume'))->with('success','Test Created Successfully');


    }
    // Update batch
    public function edit($id)
    {
        $data['page'] = 'Edit PDF Notes';
        $data['create_note']= CreatePDFNotesModel::findOrFail($id);
        return view('admin.createpdf.edit')->with($data);
    }
    // Update batch
    public function update(Request $request, $id)
    {
        
        $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'mrp' => 'nullable|string|max:255',
        'start_date' => 'nullable|date',
        'is_active' => 'boolean',
    ]);

    // Find record
    $pdfNote = CreatePDFNotesModel::findOrFail($id);

    // Prepare data
    $data = $request->all();
    $data['courses'] = json_encode($request->courses ?? []); // multiple courses as JSON
     
    // Update record
      // Upload Thumbnail
    if ($request->hasFile('thumbnail')) {
    $file = $request->file('thumbnail');

    $filename = time().'.'.$file->getClientOriginalExtension();

    $file->move('frontend/uploads/pdfnotes', $filename);

    $validated['thumbnail'] = 'frontend/uploads/pdfnotes/'.$filename;
}
    $data['thumbnail'] = $validated['thumbnail'] ?? null;
    $pdfNote->update($data);
        return redirect('admin/pdfnotes/all')->with('success','Notes update successfully');

    }

    // Soft delete
    public function destroy($id)
    {
        $test = CreatePDFNotesModel::withTrashed()->findOrFail($id);

        if ($test->trashed()) {
            return redirect()->back()->with('error', 'Notes delete deleted.');
        }
    
        $test->delete();

        return redirect()->back()->with('error','Notes delete successfully');
    }
         public function destroy_permanent($id)
{
    CreatePDFNotesModel::withTrashed()->findOrFail($id)->forceDelete();

    return redirect()->back()->with('success', 'PDF Note deleted permanently');
}

    // Restore
    public function restore($id)
    {
        $batch = CreatePDFNotesModel::withTrashed()->findOrFail($id);
        $batch->restore();
        return redirect()->back()->with('success','Notes restore successfully');
    }

    // Toggle Active/Inactive
    public function toggleActive($id)
    {
        $batch = CreatePDFNotesModel::withTrashed()->findOrFail($id);
        $batch->is_active = !$batch->is_active;
        $batch->save();

        return redirect()->back()->with('success','Notes update successfully');
    }

}

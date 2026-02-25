<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PDFNoteModel;
use App\Models\Course;

class PDfNoteController extends Controller
{
    // Show all batches
    public function index()
    {
        $data['page'] = 'All Notes';
        $data['test'] = PDFNoteModel::withTrashed()->paginate(10);
       
        
        return view('admin.pdfnotes.index')->with($data);
    }

    public function add()
    {
        $data['page'] = 'Add Notes';
        $data['courses'] = Course::where('is_active',1)->whereNull('deleted_at')->get();
        
        return view('admin.pdfnotes.add')->with($data);
    }
    
     public function edit($id)
    {
        $data['page'] = 'Edit Notes';
        $data['test'] = PDFNoteModel::withTrashed()->findOrFail($id);
        $data['courses'] = Course::where('is_active',1)->whereNull('deleted_at')->get();
        
        return view('admin.pdfnotes.edit')->with($data);
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
        $data['courses'] = json_encode($request->courses);
        $batch = PDFNoteModel::create($data);

        return redirect('admin/pdfnotes/all')->with('success','Notes add sucessfully');
    }

    // Show single batch
   

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
    $pdfNote = PDFNoteModel::findOrFail($id);

    // Prepare data
    $data = $request->all();
    $data['courses'] = json_encode($request->courses ?? []); // multiple courses as JSON

    // Update record
    $pdfNote->update($data);
        return redirect('admin/pdfnotes/all')->with('success','Notes add successfully');

    }

    // Soft delete
    public function destroy($id)
    {
        $test = PDFNoteModel::withTrashed()->findOrFail($id);

        if ($test->trashed()) {
            return redirect()->back()->with('error', 'Notes delete deleted.');
        }
    
        $test->delete();

        return redirect('admin/pdfnotes/all')->with('error','Notes delete successfully');
    }
         public function destroy_permanent($id)
{
    PDFNoteModel::withTrashed()->findOrFail($id)->forceDelete();

    return redirect()->back()->with('success', 'PDF Note deleted permanently');
}

    // Restore
    public function restore($id)
    {
        $batch = PDFNoteModel::withTrashed()->findOrFail($id);
        $batch->restore();
        return redirect('admin/pdfnotes/all')->with('success','Notes restore successfully');
    }

    // Toggle Active/Inactive
    public function toggleActive($id)
    {
        $batch = PDFNoteModel::withTrashed()->findOrFail($id);
        $batch->is_active = !$batch->is_active;
        $batch->save();

        return redirect('admin/pdfnotes/all')->with('success','Notes update successfully');
    }
}

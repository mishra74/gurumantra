<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DailyCurrent;

class NotesController extends Controller
{
    public function index(){
        $data['page'] = 'All Daily Current Affairs';
        $data['dailycurrent'] =  DailyCurrent::all();
        return view('admin.notes.index')->with($data);
    }

    public function add(){
        $data['page'] = 'Add Daily Current Affairs';
        return view('admin.notes.add')->with($data);
    }

    public function store(Request $request)
    {
       // dd($request->all());
        $request->validate([
            'title'     => 'required|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'pdf'       => 'nullable|file|mimes:pdf|max:2048',
            'content'   => 'nullable|string',
            'is_active' => 'boolean',
            'category'=>'required'
        ]);

        $data = $request->all();
        // File Upload
        if ($request->hasFile('pdf')) {
            $data['pdf'] = $request->file('pdf')->store('dailycurrent/pdfs', 'public');
        }
        
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('dailycurrent/thumbnail', 'public');
        }

        DailyCurrent::create($data);

        return redirect('admin/notes')->with('success','Daily current add successfully');
    }

    public function edit($id){
       // dd($id);
        $data['page'] = 'Edit Daily Current Affairs';
        $data['dailycurrent'] =  DailyCurrent::where('id',$id)->first();
        return view('admin.notes.edit')->with($data);
    }


    public function update(Request $request, $id)
    {
        $dailyCurrent = DailyCurrent::findOrFail($id);

        $request->validate([
            'title'     => 'required|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'pdf'       => 'nullable|file|mimes:pdf|max:2048',
            'content'   => 'nullable|string',
            'is_active' => 'boolean',
            'category'  => 'required|string|max:255',
            'thumbnail' => 'nullable|string|max:255'
        ]);
    
        $data = $request->all();
    
        // File Upload (replace old if new uploaded)
        if ($request->hasFile('pdf')) {

            $data['pdf'] = $request->file('pdf')->store('dailycurrent/pdfs', 'public');
        }
        
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('dailycurrent/thumbnail', 'public');
        }
    
        $dailyCurrent->update($data);
    
        return redirect('admin/notes')->with('success','Daily current update successfully');
    }

    public function delete(Request $request, $id){
        $dailyCurrent = DailyCurrent::findOrFail($id);

        // Agar PDF file bhi delete karni hai storage se
        if ($dailyCurrent->pdf && \Storage::disk('public')->exists($dailyCurrent->pdf)) {
            \Storage::disk('public')->delete($dailyCurrent->pdf);
        }
    
        $dailyCurrent->delete();
    
        return redirect('admin/notes')->with('error','Daily current delete successfully');
    
    }

    

}

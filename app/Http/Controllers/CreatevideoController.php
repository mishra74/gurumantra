<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CreatevideoModel;

class CreatevideoController extends Controller
{
    public function index($id){
     // dd($id);
        $data['page'] = 'All Create Videos';
        $data['create_test'] = CreatevideoModel::withTrashed()->where('volume_id',$id)->get();
        session(['video_volume' => $id]);
        return view('admin.createvideo.index')->with($data);
    }

    public function add(){
        $data['page'] = 'Create Videos';
        return view('admin.createvideo.add')->with($data);
    }

    public function store(Request $request){
        $data = $request->all();
        if ($request->hasFile('video_upload')) {
            $data['video'] = $request->file('video_upload')->store('dailycurrent/video', 'public');
        }
        
        if ($request->hasFile('pdf_upload_question')) {
            $data['pdf_upload_question'] = $request->file('pdf_upload_question')->store('dailycurrent/pdfs', 'public');
        }

        $data['volume_id'] = session('video_volume');
        CreatevideoModel::create($data);
      return redirect('admin/recording_create/'.session('video_volume'))->with('success','Test Created Successfully');


    }

}

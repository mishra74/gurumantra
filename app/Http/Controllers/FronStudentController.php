<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DailyCurrent;

class FronStudentController extends Controller
{
    public function index(){
        return view('daily');
    }
    
     public function category(){

        return view('category');
    }

    public function read_document($id,$category){
    
            $allContent = DailyCurrent::where('is_active',1)->get();
            
        return view('co-contentlist',compact('allContent'));
    }

   public function read_content($id)
{
    $content = DailyCurrent::findOrFail($id);

    $thumbnail = asset('storage/' . $content->thumbnail);

    if (!file_exists(public_path('storage/' . $content->thumbnail))) {
        $thumbnail = asset('admin_assets/assets/images/default-thumb.jpg');
    }

    return view('read', compact('content', 'thumbnail'));
}


    
}

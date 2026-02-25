<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class StudentController extends Controller
{
    public function index(){
        $data['page'] = 'All Student';
        $data['student'] = User::where('type','student')->select('*')->get();
        return view('admin.student.index')->with($data);
    }
    

    
}

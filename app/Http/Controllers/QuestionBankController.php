<?php

namespace App\Http\Controllers;

use App\Models\QuestionBank;
use Illuminate\Http\Request;

class QuestionBankController extends Controller
{
    public function index($id)
    {
        
       
        session(['tagsId' => $id]);
        $data['page'] = 'All Quetions';
        $data['question'] = QuestionBank::where('tag_id',$id)->latest()->get();
      // dd($data['question']);
        return view('admin.question_banks.index')->with($data);
    }

    public function store(Request $request)
    {

      //dd($request->all());
        $data = $request->validate([
            'question' => 'required',
            'marks' => 'required|integer',
            'negative_marks' => 'nullable|integer',
            'type' => 'required',
            'total_options' => 'required|integer',
            'options' => 'required|array',
            'correct_answer' => 'required',
            'hint' => 'nullable'
        ]);

        $data['options'] = array_values($request->options);
        $data['tag_id'] =  session('tagsId');
        $data['question_tileid'] =  session('quetion_id');
        

        QuestionBank::create($data);

        return redirect('questions_bank/all/'.session('tagsId'))->with('success', 'Question saved successfully!');
    }

    public function add(){
        $data['page'] = 'Add Quetions';
        return view('admin.question_banks.add')->with($data);
    }


    public function getQuestion($id)
    {
        $question = QuestionBank::find($id);

        if (!$question) {
            return response()->json(['status' => false, 'message' => 'Not Found']);
        }

        return response()->json([
            'status' => true,
            'data' => [
                'id' => $question->id,
                'question' => $question->question,
                'marks' => $question->marks,
                'total_options' => $question->total_options,
            ]
        ]);
    }


}

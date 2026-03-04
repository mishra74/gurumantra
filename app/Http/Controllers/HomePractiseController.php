<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Language;
use Auth;
use App\Models\PurchasedModel;


class HomePractiseController extends Controller
{
    public function index($id)
    {
        $data['languages']=Language::all();
        // Store values in session
    $test_volume = session('volumeId');



    $userId = Auth::id();

    $OrderTest = PurchasedModel::where('user_id', $userId)
        ->where('test_volume', $test_volume)
        ->first();

    if (!$OrderTest) {
        return redirect('/purchase/test/' . $test_volume);
    }

        return view('home.practise.index')->with($data);
    }
    public function instructions()
    {
        return view('home.practise.instructions');
    }
    public function start()
    {
        return view('home.practise.start');
    }
   public function result(Request $request)
{
    $data = [
        'questions' => json_decode($request->questions, true),
        'answers'   => json_decode($request->answers, true),
        'correct'   => $request->correct,
        'wrong'     => $request->wrong,
        'attempted' => $request->attempted,
        'total'     => $request->total,
    ];

    return view('home.practise.result', compact('data'));
}
public function resultView()
{
    $data = session('quiz_data');

    return view('student.practise.result', compact('data'));
}
}

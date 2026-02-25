<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuestionBank;
use App\Models\QuestionToVolume;
use App\Models\UserAnswer;
use App\Models\Batche;
use App\Models\Batch;
use App\Models\Coupon;


use Auth;

class HomeLiveClassCotronller extends Controller
{
    public function liveclass($test_id, $volume_id)
    {
        $questionIds = QuestionToVolume::where('test_id', $test_id)
            ->where('volume_id', $volume_id)
            ->pluck('question_id');

        $questions = QuestionBank::whereIn('id', $questionIds)->get();

        return view('livetest', compact('questions', 'test_id', 'volume_id'));
    }

    public function saveAnswer(Request $request)
    {
        $request->validate([
            'question_id' => 'required',
            'selected_answer' => 'required',
            'test_id' => 'required',
            'volume_id' => 'required',
        ]);

        // ✅ Handle user or guest
        $userId = Auth::check() ? Auth::id() : session()->get('guest_user_id');
        if (!$userId) {
            $userId = 'guest_' . uniqid(); // unique guest ID
            session(['guest_user_id' => $userId]);
        }

        // ✅ Get question and check correctness
        $question = QuestionBank::find($request->question_id);
        $is_correct = ($question && trim($question->correct_answer) == trim($request->selected_answer));

        // ✅ Store or update answer
        UserAnswer::updateOrCreate(
            [
                'user_id' => $userId,
                'test_id' => $request->test_id,
                'volume_id' => $request->volume_id,
                'question_id' => $request->question_id,
            ],
            [
                'selected_answer' => $request->selected_answer,
                'is_correct' => $is_correct,
            ]
        );

        return response()->json(['status' => true, 'message' => 'Answer saved']);
    }

    public function submitTest(Request $request)
    {
        // ✅ Same user logic for guest or logged-in
        $userId = Auth::check() ? Auth::id() : session()->get('guest_user_id');
        if (!$userId) {
            return response()->json(['status' => false, 'message' => 'User not found']);
        }

        $total = UserAnswer::where('user_id', $userId)
            ->where('test_id', $request->test_id)
            ->where('volume_id', $request->volume_id)
            ->count();

        $correct = UserAnswer::where('user_id', $userId)
            ->where('test_id', $request->test_id)
            ->where('volume_id', $request->volume_id)
            ->where('is_correct', 1)
            ->count();

        $wrong = $total - $correct;

        return response()->json([
            'status' => true,
            'total' => $total,
            'correct' => $correct,
            'wrong' => $wrong
        ]);
    }
     public function checkout($id){
        session(['volumeId' => $id]);
        session(['type' => 'Batch']);

        
        $data['checkout'] = Batch::where('is_active',1)
        ->select('batches.*','batches.start_date as test_startDate')
        ->whereNull('deleted_at')
        ->where('id',$id)
        ->first();
        
       //dd($data['checkout']);
       //dd($data['checkout']);
       $data['coupons']=Coupon::where('test_series',1)->orwhere('all',1)->get(); 
        if($data['checkout']['extend_type']==='fixed'){
            return view('checkoutCard')->with($data);
        }else{
            return view('checkout')->with($data);
        }
    }
}

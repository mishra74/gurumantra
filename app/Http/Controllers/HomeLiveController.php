<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuestionBank;
use App\Models\PurchasedModel;
use App\Models\QuestionToVolume;
use App\Models\CreateModel;
use App\Models\Sectionmodel;
use Auth;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;


use App\Models\QuizResult;

class HomeLiveController extends Controller
{
    public function index(Request $request, $id)
{
    
    // Store values in session
       $test_volume = session('volumeId');
session(['test_q_id'=>$id]);

    $userId = Auth::id();

    $OrderTest = PurchasedModel::where('user_id', $userId)
        ->where('test_volume', $test_volume)
        ->first();

    if (!$OrderTest) {
        return redirect('/purchase/test/' . $test_volume);
    }

    return view('home.live.index');
}
    

public function instructions(Request $request)
{
    $lang = $request->lang ?? 'english';

    $test_q_id = session('test_q_id');
    $live_test = CreateModel::find($test_q_id);

    if (!$live_test) {
        return redirect()->back()->with('error', 'Test not found');
    }

    // Combine start_date + start_time
    $startDateTime = Carbon::createFromFormat(
        'Y-m-d H:i:s',
        $live_test->start_date . ' ' . $live_test->start_time
    );

    $remainingSeconds = (int) now()->diffInSeconds($startDateTime, false);
   return view('home.live.instructions', compact(
        'lang',
        'startDateTime',
        'remainingSeconds'
    ));
}
  public function start()
{
    $test_q_id = session('test_q_id');
    $live_test = CreateModel::find($test_q_id);

    if (!$live_test) {
        return redirect()->back()->with('error', 'Test not found');
    }

    // Start datetime
    $startDateTime = Carbon::parse(
        $live_test->start_date . ' ' . $live_test->start_time
    );

    // End datetime (already full datetime in DB)
    $endDateTime = Carbon::parse($live_test->last_time);

    // If test has not started yet
    if (now()->lt($startDateTime)) {
        return redirect()->route('live.instructions')
            ->with('error', 'Test has not started yet.');
    }

    // If test already ended
    if (now()->gte($endDateTime)) {
        return redirect()->route('live.instructions')
            ->with('error', 'Test time is over.');
    }

    // Remaining seconds
    $remainingSeconds = now()->diffInSeconds($endDateTime);

    $data['live_test'] = $live_test;
    $data['section'] = Sectionmodel::where('create_test', $test_q_id)->first();
    $data['remainingSeconds'] = $remainingSeconds;

    return view('home.live.start')->with($data);
}





public function result(Request $request)
{
    $user = auth()->user();
    $test_q_id = session('test_q_id');
    $live_test = CreateModel::find($test_q_id);

    if (!$live_test) {
        return redirect()->back()->with('error', 'Test not found');
    }

    // Calculate percentage
    $percentage = ($request->correct / $request->total) * 100;

    // Save Result
    $data = QuizResult::create([
        'user_id' => auth()->id(),
        'tile_id' => $request->tile_id ?? null,
        'total_questions' => $request->total,
        'attempted' => $request->attempted,
        'correct' => $request->correct,
        'incorrect' => $request->wrong,
        'percentage' => $percentage,
        'questions' => json_decode($request->questions, true),
        'answers' => json_decode($request->answers, true),
        'exam_type' => 'Live Test'
    ]);

    /*
    |---------------------------------------------------
    | RANK CALCULATION
    |---------------------------------------------------
    */

    $allResults = QuizResult::where('exam_type', 'Live Test')
        ->orderByDesc('percentage')
        ->orderByDesc('correct')
        ->get();

    $rank = $allResults->search(function ($item) use ($data) {
        return $item->id === $data->id;
    }) + 1;

    $totalStudents = $allResults->count();
    $topScore = $allResults->first()->percentage ?? 0;

    return view('home.live.result', compact(
        'data',
        'user',
        'rank',
        'totalStudents',
        'topScore',
        'allResults'
    ));
}
    public function getQuestion($id)
{
    $test_q_id = session('test_q_id');

    if (!$test_q_id) {
        return response()->json([
            'status' => false,
            'message' => 'Test ID not found in session'
        ]);
    }

    // Get question IDs already added in this test
    $allquestionId = QuestionToVolume::where('test_id', $test_q_id)
        ->pluck('question_id')
        ->toArray();

    if (empty($allquestionId)) {
        return response()->json([
            'status' => false,
            'message' => 'No questions linked to this test'
        ]);
    }

    // Fetch questions that:
    // 1. Match the section ID ($id)
    // 2. Exist in the QuestionToVolume list
    $questions = QuestionBank::whereIn('id', $allquestionId)
        ->get();

    if ($questions->isEmpty()) {
        return response()->json([
            'status' => false,
            'message' => 'No questions found for this section'
        ]);
    }

    return response()->json([
        'status' => true,
        'data' => $questions
    ]);
}

public function downloadPdf($id)
{
    $data = QuizResult::findOrFail($id);

    $user = auth()->user();

    $pdf = Pdf::loadView('home.live.pdf', compact('data','user'));

    return $pdf->download('Test_Result_'.$user->name.'.pdf');
}
}

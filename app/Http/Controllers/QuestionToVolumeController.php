<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuestionToVolume;
use Auth;

class QuestionToVolumeController extends Controller
{
    public function store(Request $request)
    {

       
        $volume_id = session('tvid');
        $test_id = session('tid');
        $section_id = session('sectionID');
        $question_id = $request->question_id;

        // Check if question already exists for same combination
        $exists = QuestionToVolume::where([
            'volume_id' => $volume_id,
            'test_id' => $test_id,
            'section_id' => $section_id,
            'question_id' => $question_id
        ])->exists();

        if ($exists) {
            return response()->json(['status' => false, 'message' => 'Question already added']);
        }

        $save = QuestionToVolume::create([
            'volume_id' => $volume_id,
            'test_id' => $test_id,
            'section_id' => $section_id,
            'question_id' => $question_id
        ]);

        if ($save) {
            return response()->json(['status' => true, 'message' => 'Question added successfully']);
        }

        return response()->json(['status' => false, 'message' => 'Failed to add question']);
    }
}

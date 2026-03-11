<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ZoomRecording;
    use Carbon\Carbon;


class ZoomWebhookController extends Controller
{

public function handle(Request $request)
{
    $data = $request->all();

    if(isset($data['event']) && $data['event'] == 'recording.completed')
    {
        $meeting = $data['payload']['object'];

        foreach($meeting['recording_files'] as $file)
        {
            ZoomRecording::create([
                'meeting_id' => $meeting['id'],
                'topic' => $meeting['topic'] ?? null,
                'recording_url' => $file['play_url'] ?? null,
                'download_url' => $file['download_url'] ?? null,
                'recording_start' => Carbon::parse($file['recording_start'])->format('Y-m-d H:i:s'),
                'recording_end' => Carbon::parse($file['recording_end'])->format('Y-m-d H:i:s')
            ]);
        }
    }

    return response()->json(['status'=>'success']);
}
}
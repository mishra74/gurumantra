<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ZoomRecording;

class ZoomWebhookController extends Controller
{

public function handle(Request $request)
{

$data = $request->all();

if($data['event'] == 'recording.completed')
{

$meeting = $data['payload']['object'];

foreach($meeting['recording_files'] as $file)
{

ZoomRecording::create([

'meeting_id' => $meeting['id'],
'topic' => $meeting['topic'],
'recording_url' => $file['play_url'],
'download_url' => $file['download_url'],
'recording_start' => $meeting['recording_start'],
'recording_end' => $meeting['recording_end']

]);

}

}

return response()->json(['status'=>'success']);

}
}

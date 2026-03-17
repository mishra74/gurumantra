<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ZoomService;
use App\Models\ClassList;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Firebase\JWT\JWT;

class ZoomController extends Controller
{

   

public function joinMeeting($id)
{
 
    $class = ClassList::findOrFail($id);
    
if($class->live_by==="youtube"){
 return view('youtube.join',[
        'embedUrl'=>$class->join_url,
        'username'=>Auth::user()->name ?? 'Guest'
    ]);
}
    return view('zoom.meeting',[
        'meetingNumber'=>$class->zoom_meeting_id,
        'password'=>$class->password,
        'username'=>Auth::user()->name ?? 'Guest'
    ]);

}
public function hostMeeting($id)
{

    $class = ClassList::findOrFail($id);

    return view('zoom.startmeeting',[
        'meetingNumber'=>$class->zoom_meeting_id,
        'password'=>$class->password,
        'username'=>Auth::user()->name ?? 'Guest'
    ]);

}




public function generateSignature(Request $request)
{

$sdkKey = config('services.zoom.sdk_key');
$sdkSecret = config('services.zoom.sdk_secret');

$meetingNumber = $request->meetingNumber;
$role = $request->role;

$iat = time();
$exp = $iat + 7200;

$payload = [

'sdkKey' => $sdkKey,
'mn' => $meetingNumber,
'role' => $role,
'iat' => $iat,
'exp' => $exp,
'appKey' => $sdkKey,
'tokenExp' => $exp

];

$signature = JWT::encode($payload,$sdkSecret,'HS256');

return response()->json([
'signature'=>$signature
]);

}
public function store(Request $request, ZoomService $zoom)
{

$startDateTime = Carbon::parse($request->start_date.' '.$request->time);

// format for zoom
$zoomTime = $startDateTime->toIso8601String();

// format for database
$dbTime = $startDateTime->format('Y-m-d H:i:s');


$meeting = $zoom->createMeeting(
$request->title,
$zoomTime
);
if($request->liveBy == 'youtube' && $request->embedUrl){
    $meeting['join_url'] = $request->embedUrl;
}

ClassList::create([

'title'=>$request->title,
'class_room_id'=>$request->class_room_id,
'time'=>$request->time,
'start_date'=>$request->start_date,
'zoom_meeting_id'=>$meeting['id'],
'join_url'=>$meeting['join_url'],
'start_url'=>$meeting['start_url'],
'start_time'=>$dbTime,
'password'=>$meeting['password']

]);

return redirect()->back()->with('success','Meeting Created');

}
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ZoomService;
use App\Models\ClassList;
use Carbon\Carbon;

class ZoomController extends Controller
{

   

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

ClassList::create([

'title'=>$request->title,
'zoom_meeting_id'=>$meeting['id'],
'join_url'=>$meeting['join_url'],
'start_url'=>$meeting['start_url'],
'start_time'=>$dbTime

]);

return redirect()->back()->with('success','Meeting Created');

}
}
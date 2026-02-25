<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PDFNoteModel;
use App\Models\PurchasedModel;
use App\Models\CreatePDFNotesModel;
use Auth;
use App\Models\Coupon;
use Carbon\Carbon;


class HomepdfController extends Controller
{
    public function note_series(){
       //dd('test');
        //$courseId = session('courcesID');
         $data['tests'] = PDFNoteModel::where('is_active', 1)
     ->whereNull('deleted_at')
     //->whereRaw("JSON_CONTAINS(courses, '\"$courseId\"')")
     ->get();
     //dd($data['tests']);

    // dd('test');
         return view('note_valume')->with($data);
     }

     public function note_valume($id)
{
    // Store volume ID in session
    session(['volumeId' => $id]);

    $userId = Auth::id();

    // Check if user has purchased this volume
    $data['hasPurchased'] = PurchasedModel::where('user_id', $userId)
        ->where('notes_volume', $id)
        ->exists();
               

$data['volume_id']=$id;
    // Fetch active notes
    $data['tests'] = CreatePDFNotesModel::where('is_active', 1)
        ->whereNull('deleted_at')
        ->where('volume_id', $id)
        ->get();

    // If user has purchased
    if ($data['hasPurchased']) {

        $test = PDFNoteModel::find($id);

        // Safety check
        if (!$test) {
            abort(404, 'Note volume not found');
        }

        // Allow access only if start_date has arrived
        if ($test->start_date <= now()) {
            return view('allnotes', $data);
        } else {
            return view('alert', compact('id'));
        }
    }

    // If not purchased, still show notes (free preview?)
    return view('allnotes', $data);
}



    // public function noteshow($id){
    //     session(['NotesCreatedId' => $id]);
    //     $data['pdf'] = CreatePDFNotesModel::where('pdfnotes_create.is_active',1)
    //     ->select('pdfnotes_create.*','pdfnotes.paid')
    //     ->leftJoin('pdfnotes','pdfnotes.id','=','pdfnotes_create.volume_id')
    //     ->whereNull('pdfnotes_create.deleted_at')
    //     ->where('pdfnotes_create.id',$id)
    //     ->first();
    //     //dd($data['pdf']);
    //     //dd($data['pdf']);
        
    //     return view('notespdf')->with($data);
    // }
public function noteshow($id){
    $content = CreatePDFNotesModel::find($id);
    $test_volume=session('volumeId');
$test = PDFNoteModel::find($test_volume);

    $startDate = Carbon::parse($test->start_date)->format('Y-m-d');
    $todayDate = Carbon::now()->format('Y-m-d');

if (Carbon::now()->lt($test->start_date)) {
    return redirect('student/success');
}
    $url = urlencode(url()->current());
    $title = urlencode($content->title);

    // ✅ Best-practice: Public storage link
    // Ensure php artisan storage:link is run
    $thumbnail = asset('storage/' . $content->thumbnail);

    // Optional fallback image
    if(!file_exists(public_path('storage/app/public' . $content->thumbnail))){
        $thumbnail = asset('admin_assets/assets/images/default-thumb.jpg');
    }

    return view('read_notes', compact('content', 'url', 'title', 'thumbnail'));
}

    public function checkout($id){
        session(['volumeId' => $id]);
        session(['type' => 'Notes']);

        
        $data['checkout'] = PDFNoteModel::where('is_active',1)
        ->select('pdfnotes.*','pdfnotes.start_date as test_startDate')
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

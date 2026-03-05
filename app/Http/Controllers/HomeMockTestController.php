<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Course;
use App\Models\Test;
use App\Models\QuestionBank;
use App\Models\CreateModel;
use App\Models\PurchasedModel;
use App\Models\CreatePDFNotesModel;
use App\Models\Batch;
use App\Models\OrderBatch;
use App\Models\Coupon;
use App\Models\ClassModel;
use Carbon\Carbon;
use App\Models\VolumeMockTest;
class HomeMockTestController extends Controller
{
  public function index(){

        $baseUrl = url('/referral'); 

if (Auth::check()) {
   
    $referralCode = Auth::user()->referral_code ?? Auth::id();
    $url= $baseUrl . '/' . $referralCode;
} else {
   
    $url = url('/');
}

$data['latest_tests'] = CreateModel::latest()->take(3)->get();$url = urlencode($url);
        return view('index')->with($data);
    }
    public function cources(){
        $data['Courses'] = Course::where('is_active',1)->whereNull('deleted_at')->get();
        return view('cources')->with($data);
    }

    public function cources_type($id){
        session(['courcesID' => $id]);
        return view('cources_type');
    }
    
 public function batches_series(){
       
       $courseId = session('courcesID');
        $data['batches'] = Batch::where('is_active', 1)->where('course_id',$courseId)
    ->whereNull('deleted_at')
    // ->whereRaw("JSON_CONTAINS(courses, '\"$courseId\"')")
    ->get();
   // dd($data['tests']);
        return view('batches')->with($data);
    }
    
  public function batches_valume($id)
{
    
    session(['volumeId' => $id]);
    session(['type' => 'Batch']);

    $userId = Auth::id();

    $data['OrderBatch'] = PurchasedModel::where('user_id', $userId)
        ->where('batch_volume', $id)
        ->first();

    // Get classes where batch id exists in JSON column
    $data['classes'] = ClassModel::where('is_active', 1)
        ->whereNull('deleted_at')
        ->whereJsonContains('batches', (string) $id)
        ->get();

    $data['batche'] = Batch::findOrFail($id);

    return view('batches_series', $data);
}



public function join_class($id){
      
    
    $userId = Auth::id();
     $batch_volume = session('volumeId');
$order= OrderBatch::where('user_id', $userId)
        ->where('batch_volume', $batch_volume)
        ->first();
        if(!$order){
            return redirect('/purchase/class/'.$batch_volume)->with('error','Please purchase the batch to join the class.');
        }
    $test = Batch::find($batch_volume);

    $startDate = Carbon::parse($test->start_date)->format('Y-m-d');
    $todayDate = Carbon::now()->format('Y-m-d');

if (Carbon::now()->lt($test->start_date)) {
    return redirect('student/success');
}
    $data['classes'] = ClassModel::find($id);
        return $data['classes'];
    
}
    public function mocktest_volume(){
       
       $courseId = session('courcesID');
        $data['tests'] = VolumeMockTest::where('is_active', 1)
    ->whereNull('deleted_at')
    ->get();
   // dd($data['tests']);
        return view('mocktest_volume')->with($data);
    }


    public function mocktest_series($id){
        session(['volumeId' => $id]);
        session(['type' => 'Tests']);
        $userId = Auth::id();

        // Check if user has purchased this volume
        $data['hasPurchased'] = PurchasedModel::where('user_id', $userId)
            ->where('test_volume', $id)
            ->exists();

        // Fetch active notes
        $data['tests'] = VolumeMockTest::where('is_active', 1)
            ->whereNull('deleted_at')
            ->where('volume_id', $id)
            ->get();

        // If user has purchased
        if ($data['hasPurchased']) {

            $test = VolumeMockTest::find($id);

            // Safety check
            if (!$test) {
                abort(404, 'Note volume not found');
            }
            // Allow access only if start_date has arrived
            if ($test->start_date <= now()) {
                return view('allmocktest', $data);
            } else {
                return view('alert', compact('id'));
            }
        }

        // If not purchased, still show notes (free preview?)
        return view('alltests')->with($data);
     // Store volume ID in session
    session(['volumeId' => $id]);
    session(['type' => 'Tests']);
    $userId = Auth::id();

    // Check if user has purchased this volume
    $data['hasPurchased'] = PurchasedModel::where('user_id', $userId)
        ->where('test_volume', $id)
        ->exists();

    // Fetch active notes
    $data['tests'] = VolumeMockTest::where('is_active', 1)
        ->whereNull('deleted_at')
        ->where('volume_id', $id)
        ->get();

    // If user has purchased
    if ($data['hasPurchased']) {

        $test = VolumeMockTest::find($id);

        // Safety check
        if (!$test) {
            abort(404, 'Note volume not found');
        }
        // Allow access only if start_date has arrived
        if ($test->start_date <= now()) {
            return view('allmocktest', $data);
        } else {
            return view('alert', compact('id'));
        }
    }

    // If not purchased, still show notes (free preview?)
    return view('allmocktest')->with($data);
     
        
    }

    public function pdf_show($id){
        session(['TestcreatedID' => $id]);
        $test_volume=session('volumeId');
        $userId=Auth::id();
        $data['pdf'] = CreateModel::where('create_test.is_active',1)
        ->select('create_test.*','tests.paid')
        ->leftJoin('tests','tests.id','=','create_test.volume_id')
        ->whereNull('create_test.deleted_at')
        ->where('create_test.id',$id)
        ->first();
         $data['hasPurchased'] = PurchasedModel::where('user_id', $userId)
        ->where('test_volume', $test_volume)
        ->exists();
       
        return view('pdf')->with($data);
    }

    // public function pdfcontent($id){
    //     $data['pdf'] = CreateModel::where('is_active',1)->whereNull('deleted_at')->where('id',$id)->first();
    //     //dd( $data['pdf']);
    //     return view('pdfcontent')->with($data);

    // }
    public function pdfcontent($id){
        $data['pdf'] = CreateModel::where('is_active',1)->whereNull('deleted_at')->where('id',$id)->first();
        // dd( $data['pdf']);
        return view('pdfcontent')->with($data);

    }


public function pdfanswer($id)
{
    $test_volume = session('volumeId');

    $test = Test::find($test_volume);

    $startDate = Carbon::parse($test->start_date)->format('Y-m-d');
    $todayDate = Carbon::now()->format('Y-m-d');

if (Carbon::now()->lt($test->start_date)) {
    return redirect('student/success');
}


    $data['pdf'] = CreateModel::where('is_active', 1)
        ->whereNull('deleted_at')
        ->where('id', $id)
        ->first();

    return view('pdfanswer')->with($data);
}

    public function checkout($id){
        $data['checkout'] = CreateModel::where('create_test.is_active',1)
        ->select('create_test.*','tests.*','tests.start_date as test_startDate')
        ->leftJoin('tests','tests.id','=','create_test.volume_id')
        ->whereNull('create_test.deleted_at')
        ->where('create_test.id',$id)
        ->first();
        //dd($data['checkout']);
        $data['coupons']=Coupon::where('test_series',1)->orwhere('all',1)->get();   
        if($data['checkout']['extend_type']==='fixed'){
            return view('checkoutCard')->with($data);
        }else{
            return view('checkout')->with($data);
        }
        
    }

    public function privacy_policy(){
        return view('privacy');
   }
    public function term_and_conditions(){
        return view('terms');
   }
    public function refund_policy(){
        return view('refund_policy');
   }
    public function shipping_cancellation(){
        return view('shipping_cancellation');
   }

}

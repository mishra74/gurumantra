<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Center;
use App\Models\OffLineBatch;
use App\Models\OffLineMockTestVolume;
use App\Models\PurchasedModel;
use App\Models\zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OffLineHomeController extends Controller
{
     

    public function zone(){
        session(['type'=>'mocktest']);
        $data['zones'] = zone::where('is_active',1)->whereNull('deleted_at')->get();
        return view('center')->with($data);
    }
    public function batch_zone(){
        session(['type'=>'batch']);
        $data['zones'] = zone::where('is_active',1)->whereNull('deleted_at')->get();
        return view('center')->with($data);
    }

    public function offline_type(){

        return view('offline_type');
    }
    public function mocktest_volume($id){

    
    session(['volumeId' => $id]);
    $type = session('type');

    
if($type === 'batch'){
    $data['MockTestVolumes'] = OffLineBatch::where('is_active', 1)
        ->whereNull('deleted_at')
        ->whereJsonContains('center_id', (string) $id)
        ->get();
        return view('Offline_batch')->with($data);
}
   
    // Get classes where batch id exists in JSON column
    $data['MockTestVolumes'] = OffLineMockTestVolume::where('is_active', 1)
        ->whereNull('deleted_at')
        ->whereJsonContains('center_id', (string) $id)
        ->get();

    $data['center'] = Center::findOrFail($id);

        return view('offline_mocktest_volume')->with($data);
    }

    public function offline_mocktest($id)
    {     $userId = Auth::id();
        session(['type' => 'OfflineMockTest']);
        session(['volumeId' => $id]);

        $data['OrderBatch'] = PurchasedModel::where('user_id', $userId)
            ->where('offline_mocktest_volume', $id)
            ->first();
            
if(!$data['OrderBatch']){
    return redirect('/purchase/offline/'.$id)->with('error','Please purchase the mocktest to access the content.');
}
        $data['mocktest'] = OffLineMockTestVolume::findOrFail($id);

        return view('offline_mocktest')->with($data);
    }

    public function checkout($id){
        $data['checkout'] = OffLineMockTestVolume::findOrFail($id);
         return view('offlinecheckout')->with($data);
}
}
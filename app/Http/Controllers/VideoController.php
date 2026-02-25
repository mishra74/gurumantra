<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ViewrecorderModel;
use App\Models\CreatevideoModel;
use App\Models\PurchasedModel;
use Auth;
use App\Models\Coupon;

class VideoController extends Controller
{
    public function index(){
        
        $courseId = session('courcesID');
         $data['tests'] = ViewrecorderModel::where('is_active', 1)
     ->whereNull('deleted_at')
     //->whereRaw("JSON_CONTAINS(courses, '\"$courseId\"')")
     ->get();
    //dd($data['tests']);
         return view('video_valume')->with($data);
    }

    

    public function video_valume($id){
       $userId = Auth::id();
       $data['VideoVolumeId']=$id;
        // Check if user has purchased this volume
    $data['hasPurchased'] = PurchasedModel::where('user_id', $userId)
        ->where('notes_volume', $id)
        ->exists();
        session(['VideoVolumeId' => $id]);
        $data['tests'] = CreatevideoModel::where('is_active',1)->whereNull('deleted_at')->where('volume_id',$id)->get();
        return view('allvideo')->with($data);
     
        //dd( $data['tests']);
        
    }


    public function video_show($id){
        session(['VideoCreatedId' => $id]);
        
        $data['pdf'] = CreatevideoModel::where('create_video.is_active',1)
        ->select('create_video.*','video.paid')
        ->leftJoin('video','video.id','=','create_video.volume_id')
        ->whereNull('create_video.deleted_at')
        ->where('create_video.id',$id)
        ->first();
        //dd($data['pdf']);
        //dd($data['pdf']);
        return view('showvideo')->with($data);
    }
    public function checkout($id){
        session(['VideoVolumeId' => $id]);
        session(['type' => 'video']);

        
        $data['checkout'] = ViewrecorderModel::where('is_active',1)
        ->select('video.*','video.start_date as test_startDate')
        ->whereNull('deleted_at')
        ->where('id',$id)
        ->first();
       //dd($data['checkout']);
       //dd($data['checkout']);
$data['coupons']=Coupon::where('recording_room',1)->orwhere('all',1)->get();       
        if($data['checkout']['extend_type']==='fixed'){
            return view('checkoutCard')->with($data);
        }else{
            return view('checkout')->with($data);
        }
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Course;
use App\Models\PDFNoteModel;
use App\Models\PurchasedModel;
use App\Models\Test;
use App\Models\ViewrecorderModel;
use Illuminate\Http\Request;

class ManualAddController extends Controller
{
    public function course($student_id){
session(['student_id'=>$student_id]);
$courses=Course::latest()->get();

return view('admin.manual.courses',compact('courses'));

    }
    public function category($id){

        return view('admin.manual.courses_type');
    }
    public function batch(){
                session(['type'=>'batch']);
                $data['page']="Batches";
        $data['series']=Batch::all();
        return view('admin.manual.series')->with($data);
    }
    public function test(){
                session(['type'=>'test']);
                $data['page']="Testes";

        $data['series']=Test::all();
        return view('admin.manual.series')->with($data);
    }
    public function notes(){
                session(['type'=>'notes']);
                                $data['page']="Notes";

        $data['series']=PDFNoteModel::all();
        return view('admin.manual.series')->with($data);
    }
    public function record(){
                session(['type'=>'recode']);
                                $data['page']="Recordings";

        $data['series']=ViewrecorderModel::all();
        return view('admin.manual.series')->with($data);
    }
    public function checkout($id){
        $type=session('type');
        $data=null;
session(['volumeId'=>$id]);
        if($type=='batch'){
            $data=Batch::findOrFail($id);
        }elseif($type=='test'){
            $data=Test::findOrFail($id);
        }elseif($type=='notes'){
            $data=PDFNoteModel::findOrFail($id);
        }elseif($type=='recode'){
            $data=ViewrecorderModel::findOrFail($id);
        }
        $checkout=$data;
        if($checkout->extend_type==="fixed"){  
                        return view('admin.manual.chackoutcard',compact('checkout'));

        }else{
            return view('admin.manual.chackout',compact('checkout'));

        }
        
    }
    public function create_order(Request $request){
         $data['user_id'] = session('student_id');
            // $data['test_volume'] = isset(session('TestsVolumeId')) ? session('TestsVolumeId') : session('NotesVolumeId');
            
            $data['type'] = session('type');
           if(session('type')==="notes"){
               $data['notes_volume'] = session('volumeId');
;
           }
           if(session('type')==="test"){
               $data['test_volume'] =  session('volumeId');
              

           }
           if(session('type')==="batch"){
               $data['batch_volume'] =  session('volumeId');

           }
           
            $data['price'] = $request->amount;
            $data['order_number'] = "manual";
            PurchasedModel::create($data);
            return response()->json(['status' => 'success']);
    }
}

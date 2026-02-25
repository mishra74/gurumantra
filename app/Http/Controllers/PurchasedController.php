<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PurchasedModel;
use App\Models\CoinsModel;
use App\Models\User;
use Auth;

class PurchasedController extends Controller
{
    public function purchased(Request $request){
       // dd($request->all());
        $data['user_id'] = Auth::user()->id;
        // $data['test_volume'] = isset(session('TestsVolumeId')) ? session('TestsVolumeId') : session('NotesVolumeId');
        $data['test_volume'] = session('volumeId');
        $data['type'] = session('type');
       
        $data['test_id'] = session('TestcreatedID',session('NotesCreatedId'));
        $data['price'] = $request->total;
        $data['order_number'] = $code = 'GSH' . str_pad(rand(0, 99999999), 8, '0', STR_PAD_LEFT);
        PurchasedModel::create($data);
        CoinsModel::where('testid',session('TestsVolumeId'))->update(array('status'=>1));
        return 1;   
    }
public function purchasednotes(Request $request){
       // dd($request->all());
        $data['user_id'] = Auth::user()->id;
        // $data['test_volume'] = isset(session('TestsVolumeId')) ? session('TestsVolumeId') : session('NotesVolumeId');
        $data['notes_volume'] = session('volumeId');
        $data['type'] = session('type');
        $data['availcoins']=Auth::user()->coins-$request->use_coins;
        $data['notes_id'] = session('TestcreatedID',session('NotesCreatedId'));
        $data['price'] = $request->total;
        $data['order_number'] = $code = 'GSH' . str_pad(rand(0, 99999999), 8, '0', STR_PAD_LEFT);
                User::where('id',Auth::user()->id)->update(array('coins'=>$data['availcoins']));

        PurchasedModel::create($data);
        CoinsModel::where('notes_id',session('notes_volume'))->update(array('status'=>1));
        return 1;   
    }

    public function success(){
        return view('success');
    }
    public function successnotes(){
        
        return view('notes_success');
    }
    
}

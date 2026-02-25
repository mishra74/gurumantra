<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CoinsModel;
use App\Models\User;
use Auth;
class CoinsController extends Controller
{
    public function coins_detucts(Request $request){

        $data['user_id'] = Auth::user()->id;
        if($request->type==="Tests"){
        $data['testid'] = session('volumeId');
}
if($request->type==="Notes"){
        $data['notes_id'] = session('volumeId');
}
if($request->type==="Batch"){
        $data['batch_id'] = session('volumeId');
}
if($request->type==="Record"){
        $data['record_id'] = session('volumeId');
}
        $data['coinsuse'] = $request->coins;
        $data['availcoins'] = Auth::user()->coins - $request->coins;
        $CoinsModel=CoinsModel::create($data);

        if($data['availcoins'] < 0){
            User::where('id',Auth::user()->id)->update(array('coins'=>0));

        }else{
            User::where('id',Auth::user()->id)->update(array('coins'=>$data['availcoins']));

        }
        return  response()->json(array('avail'=>$data['availcoins'],'useCoims'=>$data['coinsuse'],'usecoins'=>$CoinsModel));
    }

public function restore(Request $request){


$availableCoins  = Auth::user()->coins;
$CoinsModel=CoinsModel::find($request->id);

$restoreCoins = $availableCoins + $CoinsModel->coinsuse;
User::where('id',Auth::user()->id)->update(array('coins'=>$restoreCoins));
$CoinsModel->delete();
return 0;

    }
}

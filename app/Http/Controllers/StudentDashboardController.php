<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PurchasedModel;
use App\Models\CreatePDFNotesModel;
use App\Models\CoinsModel;
use App\Models\Coupon;

use Auth;

class StudentDashboardController extends Controller
{
    public function index(){
        $data['orders'] = PurchasedModel::where('user_id',Auth::user()->id)->get();
$data['usecoins'] = CoinsModel::where('user_id', Auth::id())
                    ->sum('coinsuse');
                 $data['coupon']=Coupon::all();
        return view('student.index')->with($data);
    }
    public function booking(){
        $data['orders'] = PurchasedModel::where('orderd.user_id', Auth::id())
    ->select(
        'orderd.*',

        'tests.title as test_title',
        'tests.id as test_id',
        'pdfnotes.title as notes_title',
        'pdfnotes.id as notes_id',

        'batches.title as batch_title',
        'batches.id as batch_id'
    )
    ->leftJoin('tests', 'tests.id', '=', 'orderd.test_volume')
    ->leftJoin('pdfnotes', 'pdfnotes.id', '=', 'orderd.notes_volume')
    ->leftJoin('batches', 'batches.id', '=', 'orderd.batch_volume')
    ->get();

   //dd($data['orders']);
        return view('student.booking')->with($data);

    }

    public function coins()
{
    $data['usecoins'] = CoinsModel::where('coins_use.user_id', Auth::id())
        ->select(
            'coins_use.*',

            'tests.title as test_title',
            'tests.id as test_id',

            'pdfnotes.title as notes_title',
            'pdfnotes.id as notes_id',

            'batches.title as batch_title',
            'batches.id as batch_id'
        )
        ->leftJoin('tests', 'tests.id', '=', 'coins_use.testid')
        ->leftJoin('pdfnotes', 'pdfnotes.id', '=', 'coins_use.notes_id')
        ->leftJoin('batches', 'batches.id', '=', 'coins_use.batch_id')
        ->get();

    return view('student.coins')->with($data);
}



    public function checkout($id){
        $data['checkout'] = CreateModel::where('create_test.is_active',1)
        ->select('create_test.*','tests.*','tests.start_date as test_startDate')
        ->leftJoin('tests','tests.id','=','create_test.volume_id')
        ->whereNull('create_test.deleted_at')
        ->where('create_test.id',$id)
        ->first();
        //dd($data['checkout']);
        return view('checkout')->with($data);
    }
    public function profile(){
        $data['profile']=Auth::user();
        return view('student.profile')->with($data);
    }
    public function updateProfile(Request $request)
{
    $user = Auth::user();

    $user->name = $request->name;
    $user->email = $request->email;
    $user->phone = $request->phone;

    if ($request->hasFile('image')) {
        $image = $request->file('image')->store('profile', 'public');
        $user->image = $image;
    }

    $user->save();

    return back()->with('success', 'Profile Updated Successfully');
}

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Log;
use App\Models\PurchasedModel;
use App\Models\CoinsModel;
use Auth;

class PaymentController extends Controller
{
    public function createOrder(Request $request)
    {
        
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $order = $api->order->create([
            'receipt' => 'order_rcptid_' . time(),
            'amount' => $request->amount * 100, // amount in paise
            'currency' => 'INR',
            'payment_capture' => 1 // auto capture enabled
        ]);

        return response()->json([
            'order_id' => $order['id'],
            'amount' => $order['amount'],
            'key' => env('RAZORPAY_KEY')
        ]);
    }

    public function verifyPayment(Request $request)
    {

        //dd($request->all());
        $signatureStatus = false;

        $razorpay_order_id = $request->razorpay_order_id;
        $razorpay_payment_id = $request->razorpay_payment_id;
        $razorpay_signature = $request->razorpay_signature;
        $user_id=Auth::user()->id;

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $generated_signature = hash_hmac('sha256', $razorpay_order_id . "|" . $razorpay_payment_id, env('RAZORPAY_SECRET'));

        if ($generated_signature === $razorpay_signature) {
            $signatureStatus = true;

            // (Optional) verify payment or capture manually
            try {
                $payment = $api->payment->fetch($razorpay_payment_id);
                if ($payment->status == 'authorized') {
                    $payment->capture(['amount' => $payment->amount]);
                }
            } catch (\Exception $e) {
                Log::error('Payment Capture Error: ' . $e->getMessage());
            }

            $data['user_id'] = Auth::user()->id;
            // $data['test_volume'] = isset(session('TestsVolumeId')) ? session('TestsVolumeId') : session('NotesVolumeId');
            
            $data['type'] = session('type');
           if(session('type')==="Notes"){
               $data['notes_volume'] = session('volumeId');
           }
           if(session('type')==="Tests"){
               $data['test_volume'] = session('volumeId');
               $data['test_id'] = session('TestcreatedID',session('NotesCreatedId'));

           }
           if(session('type')==="Batch"){
               $data['batch_volume'] = session('volumeId');

           }
           
            $data['price'] = $request->amount;
            $data['rezorpay_orderID'] = $request->razorpay_order_id;
            $data['razorpay_payment_id'] = $request->razorpay_payment_id;
            $data['razorpay_signature'] = $request->razorpay_signature;
            $data['order_number'] = $code = 'GSH' . str_pad(rand(0, 99999999), 8, '0', STR_PAD_LEFT);
            PurchasedModel::create($data);
             if(session('type')==="Notes"){
                          CoinsModel::where('notes_id',session('VolumeId'))->where('user_id',$user_id)->update(array('status'=>1));

           }
           if(session('type')==="Tests"){
                           CoinsModel::where('testid',session('TestsVolumeId'))->where('user_id',$user_id)->update(array('status'=>1));


           }
           if(session('type')==="Batch"){
            CoinsModel::where('testid',session('TestsVolumeId'))->where('user_id',$user_id)->update(array('status'=>1));

           }
            

            return response()->json(['status' => 'success', 'payment_id' => $razorpay_payment_id]);

            


        } else {
            return response()->json(['status' => 'failed', 'error' => 'Signature verification failed!']);
        }
    }

    public function payment(){
        return view('payment');
    }
}

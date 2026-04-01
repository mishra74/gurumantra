<?php

namespace App\Http\Controllers;

use App\Models\CoinsModel;
use App\Models\PDFNoteModel;
use App\Models\VolumeMockTest;
use App\Models\PurchasedModel;
use App\Models\Test;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function addStudent($student_id)
    {
        $data['page']="Add Student";
        $data['student_id']=$student_id;
        $data['test']=Test::latest();
        $data['mocktest']=VolumeMockTest::latest();
        $data['notest']=PDFNoteModel::latest();
        $data['batch']=Test::latest();
        $data['offlinetest']=Test::latest();
        return view('admin.history.add_student', $data);
    }

    public function payment($student_id)
    {
        $data = PurchasedModel::where('user_id', $student_id)
                    ->latest()
                    ->paginate(10);

        return view('admin.history.payment', compact('student_id', 'data'));
    }

    public function coin($student_id)
    {
        $data = CoinsModel::where('user_id', $student_id)
                    ->latest()
                    ->paginate(10);

        return view('admin.history.coin', compact('student_id', 'data'));
    }

    public function coupon($student_id)
    {
        $data = PurchasedModel::where('user_id', $student_id)
                    ->whereNotNull('coupon_id')
                    ->latest()
                    ->paginate(10);

        return view('admin.history.coupon', compact('student_id', 'data'));
    }
}

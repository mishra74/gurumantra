<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    // Show all Coupones
    public function index()
    {
        $data['page'] = 'All Coupones';
        
        $data['coupons'] = Coupon::latest()->paginate(10);
        return view('admin.coupons.index')->with($data);
    }

    public function add()
    {
        $data['page'] = 'Add Coupones';
        return view('admin.coupons.add')->with($data);
    }
public function edit($id)
    {
        $data['page'] = 'Edi Coupones';
        $data['coupon']=Coupon::withTrashed()->findOrFail($id);
        return view('admin.coupons.edit')->with($data);
    }
    // Store new Coupon
   public function store(Request $request)
{
    Coupon::create($request->all());
    // Validate request
    $request->validate([
        'name' => 'required|string|max:255',
        'coupon_code' => 'required|string|max:100|unique:coupons,coupon_code',
        'discount_type' => 'required|in:percentage,flat',
        'value' => 'required|numeric|min:0',
        'minimum_price' => 'nullable|numeric|min:0'
    ]);

    // $data = $request->only([
    //     'name',
    //     'coupon_code',
    //     'discount_type',
    //     'value',
    //     'minimum_price',
    //     'status'
    // ]);

  

    // // Store arrays as JSON
    // $data['class_type'] = $request->class_type
    //     ? json_encode($request->class_type)
    //     : null;

    // $data['batches'] = $request->batches
    //     ? json_encode($request->batches)
    //     : null;

    // // Individual class checkboxes
    // $data['test_series'] = $request->has('test_series') ? 1 : 0;
    // $data['notes'] = $request->has('notes') ? 1 : 0;
    // $data['recording_room'] = $request->has('recording_room') ? 1 : 0;
    // $data['all'] = $request->has('all') ? 1 : 0;

    // // Coupon usage checkboxes
    // $data['coupon_for_scholarship'] = $request->has('coupon_for_scholarship') ? 1 : 0;
    // $data['coupon_for_gn_package'] = $request->has('coupon_for_gn_package') ? 1 : 0;
    // $data['coupon_for_influencer'] = $request->has('coupon_for_influencer') ? 1 : 0;
    // $data['coupon_for_all'] = $request->has('coupon_for_all') ? 1 : 0;

    

    return redirect('admin/coupon/all')
        ->with('success', 'Coupon added successfully');
}


    // Show single Coupon
    public function show($id)
    {
        $Coupon = Coupon::withTrashed()->findOrFail($id);
        return redirect('admin/coupon/'.session('course_id'))->with('success','Coupon add successfully');

    }

    // Update Coupon
    public function update(Request $request, $id)
    {
        $Coupon = Coupon::withTrashed()->findOrFail($id);
        $Coupon->update($request->all());
        return redirect('admin/coupon/all')->with('success','Coupon add successfully');

    }

    // Soft delete
    public function destroy($id)
    {
        $Coupon = Coupon::withTrashed()->findOrFail($id);

        if ($Coupon->trashed()) {
            return redirect('admin/coupon/all')->with('error','Coupon delete successfully');

        }
        $Coupon->delete();
        return redirect('admin/coupon/all')->with('error','Coupon delete successfully');
    }
    public function destroy_permanent($id)
    {
        $Coupon = Coupon::withTrashed()->findOrFail($id)->forceDelete();
       
        return redirect('admin/coupon/all')->with('error','Coupon delete successfully');
    }

    // Restore
    public function restore($id)
    {
        $Coupon = Coupon::withTrashed()->findOrFail($id);
        $Coupon->restore();
        return redirect('admin/coupon/all')->with('success','Coupon restore successfully');
    }

    // Toggle Active/Inactive
    public function toggleActive($id)
    {
        $Coupon = Coupon::withTrashed()->findOrFail($id);
        $Coupon->is_active = !$Coupon->is_active;
        $Coupon->save();

        return redirect('admin/coupon/all')->with('success','Coupon update successfully');
    }
}

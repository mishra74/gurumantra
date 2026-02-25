@include('admin.layouts.header')

<div class="wrapper">
@include('admin.layouts.topbar')
@include('admin.layouts.sidebar')

<div class="content-page">
<div class="content">
<div class="container-fluid">

<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">{{ $page }}</h4>
        </div>
    </div>
</div>

<div class="row">
<div class="col-12">
<div class="card">
<div class="card-body">

<h4 class="header-title">{{ $page }}</h4>

<form method="post" action="{{ route('coupon.update', $coupon->id) }}">
    @csrf
    @method('PUT')

    <div class="row g-2">

        <!-- Coupon Name -->
        <div class="mb-3 col-md-6">
            <label class="form-label">Coupon Name</label>
            <input type="text" class="form-control" name="name"
                   value="{{ old('name', $coupon->name) }}" required>
        </div>

        <!-- Coupon Code -->
        <div class="mb-3 col-md-6">
            <label class="form-label">Coupon Code</label>
            <input type="text" class="form-control" name="coupon_code"
                   value="{{ old('coupon_code', $coupon->coupon_code) }}" required>
        </div>

        <!-- Discount Type -->
        <div class="mb-3 col-md-6">
            <label class="form-label">Discount Type</label>
            <select class="form-control" name="discount_type" required>
                <option value="percentage" {{ old('discount_type', $coupon->discount_type)=='percentage'?'selected':'' }}>Percentage</option>
                <option value="flat" {{ old('discount_type', $coupon->discount_type)=='flat'?'selected':'' }}>Flat</option>
            </select>
        </div>

        <!-- Discount Value -->
        <div class="mb-3 col-md-6">
            <label class="form-label">Discount Value</label>
            <input type="number" class="form-control" name="value"
                   value="{{ old('value', $coupon->value) }}" required>
        </div>

        <!-- Minimum Price -->
        <div class="mb-3 col-md-6">
            <label class="form-label">Minimum Price</label>
            <input type="number" class="form-control" name="minimum_price"
                   value="{{ old('minimum_price', $coupon->minimum_price) }}">
        </div>

        <!-- Class Type -->
        <div class="mb-3 col-md-6">
            <label class="form-label">Class Type</label>
            <select class="form-control" name="class_type" required>
                <option value="online" {{ old('class_type', $coupon->class_type)=='online'?'selected':'' }}>Online</option>
                <option value="offline" {{ old('class_type', $coupon->class_type)=='offline'?'selected':'' }}>Offline</option>
            </select>
        </div>

    </div>

    <!-- Coupon Apply For -->
    <div class="mb-3">
        <label class="form-label">Coupon Apply For</label><br>

        @php
            $applyFor = ['batches','test_series','notes','recording_room','all'];
        @endphp

        @foreach($applyFor as $type)
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox"
                       name="{{ $type }}" value="1"
                       {{ old($type, $coupon->$type) ? 'checked' : '' }}>
                <label class="form-check-label">{{ ucfirst(str_replace('_',' ',$type)) }}</label>
            </div>
        @endforeach
    </div>

    <!-- Coupon For -->
    <div class="mb-3">
        <label class="form-label">Coupon For</label><br>

        @php
            $couponFor = [
                'coupon_for_scholarship' => 'Scholarship',
                'coupon_for_gn_package' => 'GN Package',
                'coupon_for_influencer' => 'Influencer',
                'coupon_for_all' => 'All'
            ];
        @endphp

        @foreach($couponFor as $key => $label)
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox"
                       name="{{ $key }}" value="1"
                       {{ old($key, $coupon->$key) ? 'checked' : '' }}>
                <label class="form-check-label">{{ $label }}</label>
            </div>
        @endforeach
    </div>

    <!-- Status -->
    <div class="mb-3 col-md-6">
        <label class="form-label">Status</label>
        <select class="form-control" name="status" required>
            <option value="1" {{ old('status', $coupon->status)==1?'selected':'' }}>Active</option>
            <option value="0" {{ old('status', $coupon->status)==0?'selected':'' }}>Inactive</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Update Coupon</button>

</form>

</div>
</div>
</div>
</div>

</div>
</div>
</div>

@include('admin.layouts.footer')

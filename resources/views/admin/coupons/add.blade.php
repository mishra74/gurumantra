
       
       <!-- Begin page -->
       @include('admin.layouts.header')

        <div class="wrapper">

        @include('admin.layouts.topbar')
        @include('admin.layouts.sidebar')
            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">My Coupon</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Add Coupon</a></li>
                                            <li class="breadcrumb-item active">{{$page}}</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">{{$page}}</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        

                        <!-- final Form row -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">{{$page}}</h4>
                                       

                                        <form method="post" action="{{route('coupon.store')}}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row g-2">
                                                

    <!-- Coupon Name -->
    <div class="mb-3 col-md-6">
        <label class="form-label">Coupon Name</label>
        <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
    </div>

    <!-- Coupon Code -->
    <div class="mb-3 col-md-6">
        <label class="form-label">Coupon Code</label>
        <input type="text" class="form-control" name="coupon_code" value="{{ old('coupon_code') }}" required>
    </div>

    <!-- Discount Type -->
    <div class="mb-3 col-md-6">
        <label class="form-label">Discount Type</label>
        <select class="form-control" name="discount_type" required>
            <option value="">Select</option>
            <option value="percentage" {{ old('discount_type')=='percentage'?'selected':'' }}>Percentage (%)</option>
            <option value="flat" {{ old('discount_type')=='flat'?'selected':'' }}>Flat Amount</option>
        </select>
    </div>

    <!-- Discount Value -->
    <div class="mb-3 col-md-6">
        <label class="form-label">Discount Value</label>
        <input type="number" class="form-control" name="value" value="{{ old('value') }}" required>
    </div>

    <!-- Minimum Price -->
    <div class="mb-3 col-md-6">
        <label class="form-label">Minimum Price</label>
        <input type="number" class="form-control" name="minimum_price" value="{{ old('minimum_price') }}">
    </div>

</div>
<div class="mb-3 col-md-6">
        <label class="form-label">Class Type</label>
        <select class="form-control" name="class_type" required>
            <option value="">Select</option>
            <option value="online" {{ old('class_type')=='online'?'selected':'' }}>Online</option>
            <option value="offline" {{ old('class_type')=='offline'?'selected':'' }}>Offline</option>
        </select>
    </div>
<div class="mb-3">
    <label class="form-label">Coupon Apply For</label><br>

    @php
        $classTypes = ['batches','test_series','notes','recording_room','all'];
    @endphp

    @foreach($classTypes as $type)
        <div class="form-check form-check-inline">
            <input class="form-check-input"
                   type="checkbox"
                   name="{{$type}}"
                   value="1"
                   {{ (is_array(old('class_type')) && in_array($type, old('class_type'))) ? 'checked' : '' }}>
            <label class="form-check-label">{{ ucfirst(str_replace('_',' ',$type)) }}</label>
        </div>
    @endforeach
</div>

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
            <input class="form-check-input"
                   type="checkbox"
                   name="{{ $key }}"
                   value="1"
                   {{ old($key) ? 'checked' : '' }}>
            <label class="form-check-label">{{ $label }}</label>
        </div>
    @endforeach
</div>




                                               
                                            </div>

                                             

                                                

                                                <div class="mb-3 col-md-6">
                                                    <label for="inputPassword4" class="form-label">Is_Active</label>
                                                    <select class="form-control" name="is_active" required>
                                                        <option value="1">Yes</option>
                                                        <option value="0">No</option>
                                                    </select>
                                                    @error('is_active') <small class="text-danger">{{ $message }}</small> @enderror

                                                </div>

                                            </div>

                                           

                                            <button type="submit" class="btn btn-primary">Add</button>
                                        </form>   

                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->
                        
                    </div> <!-- container -->

                </div> <!-- content -->

             
                

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

        </div>
        

        @include('admin.layouts.footer')



       
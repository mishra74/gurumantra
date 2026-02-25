
       
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Live Classes</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Add Teacher</a></li>
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
                                      
                                       

                                    <form method="post" action="{{ route('packages.store') }}">
    @csrf
    <div class="row g-2">

        <!-- Package Name -->
        <div class="mb-3 col-md-6">
            <label class="form-label">Package Name</label>
            <input type="text" class="form-control" name="package_name" value="{{ old('package_name') }}" placeholder="Enter Package Name" required>
            @error('package_name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- Package Type -->
        <div class="mb-3 col-md-6">
            <label class="form-label">Package Type</label>
            <select class="form-control" name="package_type" required>
                <option value="">-- Select --</option>
                <option value="day" {{ old('package_type')=='day'?'selected':'' }}>Day</option>
                <option value="month" {{ old('package_type')=='month'?'selected':'' }}>Month</option>
                <option value="year" {{ old('package_type')=='year'?'selected':'' }}>Year</option>
            </select>
            @error('package_type') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- Course Type -->
        <div class="mb-3 col-md-6">
            <label class="form-label">Course Type</label>
            <select class="form-control" name="course_type" required>
                <option value="">-- Select --</option>
                <option value="test_notes" {{ old('course_type')=='test_notes'?'selected':'' }}>Test + Notes</option>
                <option value="recorded_test_notes" {{ old('course_type')=='recorded_test_notes'?'selected':'' }}>Recorded Class + Test + Notes</option>
                <option value="live_recorded_test_notes" {{ old('course_type')=='live_recorded_test_notes'?'selected':'' }}>Live + Recorded Class + Test + Notes</option>
            </select>
            @error('course_type') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- Package Validity -->
        <div class="mb-3 col-md-6">
            <label class="form-label">Package Validity (Days)</label>
            <input type="number" class="form-control" name="package_validity" value="{{ old('package_validity') }}" placeholder="Enter validity in days" required>
            @error('package_validity') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- MRP -->
        <div class="mb-3 col-md-6">
            <label class="form-label">MRP</label>
            <input type="number" step="0.01" class="form-control" name="mrp" value="{{ old('mrp') }}" placeholder="Enter MRP" required>
            @error('mrp') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- Price -->
        <div class="mb-3 col-md-6">
            <label class="form-label">Price</label>
            <input type="number" step="0.01" class="form-control" name="price" value="{{ old('price') }}" placeholder="Enter Price" required>
            @error('price') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- Discount -->
        <div class="mb-3 col-md-6">
            <label class="form-label">Discount (%)</label>
            <input type="number" step="0.01" class="form-control" name="discount" value="{{ old('discount') }}" placeholder="Enter Discount">
            @error('discount') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- Expire At -->
        <div class="mb-3 col-md-6">
            <label class="form-label">Expire At</label>
            <input type="date" class="form-control" name="expire_at" value="{{ old('expire_at') }}">
            @error('expire_at') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- Package Key -->
        <div class="mb-3 col-md-6">
            <label class="form-label">Package Key</label>
            <input type="text" class="form-control" name="package_key" value="{{ old('package_key') }}" placeholder="Enter Unique Key" required>
            @error('package_key') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- Is Active -->
        <div class="mb-3 col-md-6">
            <label class="form-label">Is Active</label>
            <select class="form-control" name="is_active" required>
                <option value="1" {{ old('is_active')=='1'?'selected':'' }}>Yes</option>
                <option value="0" {{ old('is_active')=='0'?'selected':'' }}>No</option>
            </select>
            @error('is_active') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Save Package</button>
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
        <!-- END wrapper -->
        @include('admin.layouts.footer')

       
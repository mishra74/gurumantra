
       
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">My Courses</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Add Courses</a></li>
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
                                       

                                        <form method="post" action="{{route('center.update', $center->id)}}" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="row g-2">
                                                <div class="mb-3 col-md-6">
                                                    <label for="inputEmail4" class="form-label"></label>
                                                    <input type="text" class="form-control" name="title" value="{{old('title', $center->title)}}" placeholder="Enter Zone Title" required>
                                                    @error('title') <small class="text-danger">{{ $message }}</small> @enderror

                                                </div>
                                                <div class="col-md-6">
            <label class="form-label">Thumbnail</label>
            <input type="file" name="thumbnail" class="form-control"
                   accept=".jpg,.jpeg,.png">
            @if($center->thumbnail)
            <div class="mt-2">
                <img src="{{ asset($center->thumbnail) }}" width="80" class="rounded">
            </div>
        @endif
        </div>
  <div class="col-md-6">
            <label class="form-label">Location</label>
            <input type="text" name="location" value="{{$center->location}}" class="form-control"
                   >
            @error('location')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3 col-md-12">
    <label for="inputEmail4" class="form-label">Description</label>
    <textarea type="text" class="form-control ckeditor" name="discription" value="{{old('mrp_five',$center->discription)}}"></textarea>
    @error('description') <small class="text-danger">{{ $message }}</small> @enderror
   </div>

                                                 <div class="mb-3 col-md-6">
                                                    <label for="inputPassword4" class="form-label">Is_Active</label>
                                                    <select class="form-control" name="is_active" required>
                                                        <option value="1" {{ old('is_active', $center->is_active) == 1 ? 'selected' : '' }}>Yes</option>
                                                        <option value="0" {{ old('is_active', $center->is_active) == 0 ? 'selected' : '' }}>No</option>
                                                    </select>
                                                    @error('is_active') <small class="text-danger">{{ $message }}</small> @enderror

                                                </div>
                                            </div>
                                                 <button type="submit" class="btn btn-primary">Update</button>
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

       
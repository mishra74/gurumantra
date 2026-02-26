
       
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">All Notes</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Notes</a></li>
                                            <li class="breadcrumb-item active">{{$page}}</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">{{$page}}</h4>
                                </div>
                            </div>
                        </div>
                       
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">{{$page}}</h4>
                                       

                                        <form method="post" action="{{route('dailycurrent.update', $dailycurrent->id)}}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row g-2">
                                                <div class="mb-3 col-md-6">
                                                    <label for="inputEmail4" class="form-label">Title</label>
                                                    <input type="text" class="form-control" name="title" value="{{old('title',$dailycurrent->title)}}" placeholder="Title">
                                                    @error('title') <small class="text-danger">{{ $message }}</small> @enderror

                                                </div>
                                                 <!-- Thumbnail -->
    <div class="col-md-6">
        <label class="form-label">Thumbnail</label>
        <input type="file" name="thumbnail" class="form-control" accept=".jpg,.jpeg,.png">

        @if($dailycurrent->thumbnail)
            <div class="mt-2">
                <img src="{{ asset($dailycurrent->thumbnail) }}" width="80" class="rounded">
            </div>
        @endif
    </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="inputPassword4" class="form-label">Sub Title</label>
                                                    <input type="text" class="form-control" name="sub_title" value="{{old('sub_title',$dailycurrent->sub_title)}}" placeholder="Sub Title">
                                                    @error('sub_title') <small class="text-danger">{{ $message }}</small> @enderror

                                                </div>
                                            </div>

                                            <div class="row g-2">
                                                <div class="mb-3 col-md-6">
                                                    <label for="inputEmail4" class="form-label">Pdf</label>
                                                    <input type="file" class="form-control" name="pdf" placeholder="" accept="application/pdf">
                                                    @error('pdf') <small class="text-danger">{{ $message }}</small> @enderror

                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="inputEmail4" class="form-label">Thumbnail</label>
                                                    <input type="file" class="form-control" name="thumbnail" placeholder="" accept=".png, .jpg, .jpeg" >
                                                    @error('thumbnail') <small class="text-danger">{{ $message }}</small> @enderror

                                                </div>
                                                
                                                

                                                <div class="mb-3 col-md-6">
                                                    <label for="inputPassword4" class="form-label">Category</label>
                                                   <select class="form-control" name="category" required>
    <option value="daily" {{ $dailycurrent->category == 'daily' ? 'selected' : '' }}>
        Daily Current Affairs
    </option>
    <option value="vvi" {{ $dailycurrent->category == 'vvi' ? 'selected' : '' }}>
        VVI Current Affairs
    </option>
</select>

                                                    @error('is_active') <small class="text-danger">{{ $message }}</small> @enderror

                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="inputPassword4" class="form-label">Is_Active</label>
                                                    <select class="form-control" name="is_active">
                                                        <option value="1" {{$dailycurrent->is_active== '1' ? 'selected' : ''}}>Yes</option>
                                                        <option value="0" {{$dailycurrent->is_active== '0' ? 'selected' : ''}}>No</option>
                                                    </select>
                                                    @error('is_active') <small class="text-danger">{{ $message }}</small> @enderror

                                                </div>

                                                <div class="mb-3 col-md-12">
                                                    <label for="inputPassword4" class="form-label">Content</label>
                                                    <textarea type="text" class="form-control ckeditor" name="content" placeholder="">{{$dailycurrent->content}}</textarea>
                                                    @error('content') <small class="text-danger">{{ $message }}</small> @enderror

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

       
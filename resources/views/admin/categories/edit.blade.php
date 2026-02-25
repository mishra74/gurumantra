
       
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">My Category</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Edit Category</a></li>
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
                                       

                                        <form method="post" action="{{route('category.update', $category->id)}}" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="row g-2">
                                                <div class="mb-3 col-md-6">
                                                    <label for="inputEmail4" class="form-label"></label>
                                                    <input type="text" class="form-control" name="title" value="{{old('title', $category->title)}}" id="title" placeholder="Enter language" required>
                                                    @error('title') <small class="text-danger">{{ $message }}</small> @enderror

                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="inputEmail4" class="form-label"></label>
                                                    <input type="text" class="form-control" name="slug" value="{{old('slug', $category->slug)}}" id="slug" placeholder="Enter slug" required>
                                                    @error('slug') <small class="text-danger">{{ $message }}</small> @enderror

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
          <script>
            document.getElementById('title').addEventListener('input', function() {
                var title = this.value;
                var slug = title.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
                document.getElementById('slug').value = slug;
            });
        </script>
        <!-- END wrapper -->
        @include('admin.layouts.footer')

       
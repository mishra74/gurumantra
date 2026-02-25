
       
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


                                        <form method="post" action="{{route('questionbank.store')}}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row g-2">
                                                <div class="mb-3 col-md-12">
                                                    <label for="inputEmail4" class="form-label">Question</label>
                                                    <textarea class="form-control ckeditor" id="editor" name="question" placeholder="Enter Question" required>{{ old('question') }}</textarea>
@error('question') <small class="text-danger">{{ $message }}</small> @enderror

                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="inputEmail4" class="form-label">Marks</label>
                                                    <input type="text" class="form-control" name="marks" value="{{old('marks')}}" placeholder="Enter Marks" required>
                                                    @error('marks') <small class="text-danger">{{ $message }}</small> @enderror
                                                </div>

                                                <div class="mb-3 col-md-6">
                                                    <label for="inputEmail4" class="form-label">Negative Marks</label>
                                                    <input type="text" class="form-control" name="negative_marks" value="{{old('negative_marks')}}" placeholder="Enter Question" required>
                                                    @error('negative_marks') <small class="text-danger">{{ $message }}</small> @enderror
                                                </div>

                                                <div class="mb-3 col-md-6">
                                                    <label for="inputEmail4" class="form-label">Type</label>
                                                    <select class="form-control" name="type">
                                                        <option>--Select Type--</option>
                                                        <option>Multiple Single Answer</option>
                                                        <option>MultipleChoice Multiple Answer</option>
                                                        
                                                    </select>
                                                    @error('negative_marks') <small class="text-danger">{{ $message }}</small> @enderror
                                                </div>



                                                <div class="mb-3 col-md-6">
                                                    <label for="inputEmail4" class="form-label">Total Options</label>
                                                    <input type="text" class="form-control" id="total_options" name="total_options" value="{{old('total_options')}}" placeholder="Enter Question" required>
                                                    @error('total_options') <small class="text-danger">{{ $message }}</small> @enderror
                                                </div>

                                              

                                                
                                            </div>
                                            <div class="row g-2" id="options_box">
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                    <label for="inputEmail4" class="form-label">Answer</label>
                                                    <input type="text" class="form-control" id="answer" name="correct_answer" value="{{old('correct_answer')}}" placeholder="Enter Answer">
                                                    @error('correct_answer') <small class="text-danger">{{ $message }}</small> @enderror
                                                </div>

                                            <div class="mb-3 col-md-12">
                                                    <label for="inputEmail4" class="form-label">Hint</label>
                                                    <textarea type="text" class="form-control ckeditor" name="hint" value="{{old('hint')}}" placeholder="Enter Hint"></textarea>
                                                    @error('hint') <small class="text-danger">{{ $message }}</small> @enderror

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
        <!-- END wrapper -->
        @include('admin.layouts.footer')

        {{-- CKEditor --}}
        <script>
    function getCkConfig() {
        return {
            extraPlugins: 'uploadimage,uploadfile,image2',
            removePlugins: 'easyimage,cloudservices',

            // File Browser URLs
            filebrowserBrowseUrl: '{{ route('ckfinder_browser') }}',
            filebrowserImageBrowseUrl: '{{ route('ckfinder_browser') }}?type=Images',
            filebrowserUploadUrl: '{{ route('ckfinder_connector') }}?command=QuickUpload&type=Files',
            filebrowserImageUploadUrl: '{{ route('ckfinder_connector') }}?command=QuickUpload&type=Images'
        };
    }

    function loadOptions(count){
        let box = document.getElementById('options_box');

        // Purane editors destroy karo
        for (let instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].destroy(true);
        }

        // Naya HTML add karo
        box.innerHTML = "";
        for(let i=1; i<=count; i++){
            box.innerHTML += `<div class="mb-3 col-md-6">
                <label>Option ${i}</label>
                <textarea name="options[]" id="option_${i}" class="ckeditor"></textarea>
            </div>`;
        }

        // Naye editors initialize karo with CKFinder config
        document.querySelectorAll('.ckeditor').forEach((el) => {
            CKEDITOR.replace(el.id, getCkConfig());
        });
    }

    // Focusout par trigger hoga
    document.getElementById('total_options').addEventListener('focusout', function(){
        loadOptions(this.value);
    });

    // Default load (4 options)
    loadOptions(document.getElementById('total_options').value);
</script>
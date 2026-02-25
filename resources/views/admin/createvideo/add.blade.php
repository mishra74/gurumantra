
       
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
                                       

                                        <form method="post" action="{{route('recording_creates.store')}}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row g-2">




                                                <div class="mb-3 col-md-6">

                                                    <label for="inputEmail4" class="form-label">Title</label>
                                                    <input type="text" class="form-control" name="title" value="{{old('title')}}" placeholder="Title" required>
                                                    @error('title') <small class="text-danger">{{ $message }}</small> @enderror

                                                </div>

                                                <div class="mb-3 col-md-6">

                                                    <label for="inputEmail4" class="form-label">Video Upload</label>
                                                    <input type="file" class="form-control" name="video_upload" value="{{old('video_upload')}}" placeholder="Title" required accept="video/*">
                                                    @error('video_upload') <small class="text-danger">{{ $message }}</small> @enderror

                                                </div>
                                                <div class="mb-3 col-md-6 liveclass" style="display:none">
                                                    <label for="inputPassword4" class="form-label">Start Date</label>
                                                    <input type="date" class="form-control requiredfield" name="start_date" value="{{old('start_date')}}" placeholder="Meta Key">
                                                    @error('start_date') <small class="text-danger">{{ $message }}</small> @enderror

                                                </div>


                                                <div class="mb-3 col-md-6 liveclass" style="display:none">
                                                    <label for="inputPassword4" class="form-label">Time Period (In Minuts)</label>
                                                    <input type="text" class="form-control requiredfield" name="time_period" value="{{old('time_period')}}" placeholder="Time Period">
                                                    @error('time_period') <small class="text-danger">{{ $message }}</small> @enderror

                                                </div>


                                                <div class="mb-3 col-md-6 liveclass" style="display:none">
                                                    <label for="inputPassword4" class="form-label">Live Test Expire  Date Time</label>
                                                    <input type="date" class="form-control requiredfield" name="last_time" value="{{old('start_date')}}" placeholder="Meta Key">
                                                    @error('start_date') <small class="text-danger">{{ $message }}</small> @enderror

                                                </div>


                                                

                                                

   <div class="mb-3 col-md-12">

<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option2">
  <label class="form-check-label" for="inlineRadio2">PDF File</label>
</div>

<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio4" value="option2">
  <label class="form-check-label" for="inlineRadio2">Content</label>
</div>
</div>


<div class="mb-3 col-md-6 pdfile" style="display:none">
<label for="inputEmail4" class="form-label">PDF Upload</label>

<input type="file" class="form-control" name="pdf_upload_question" value="{{old('pdf_upload_question')}}" placeholder="PDF Upload Quetion">
@error('mrp_one') <small class="text-danger">{{ $message }}</small> @enderror

</div>

<!-- <div class="mb-3 col-md-6 pdfile" style="display:none">
<label for="inputEmail4" class="form-label">PDF Enter Question</label>

<textarea type="text" class="form-control ckeditor" name="pdf_enter_question" value="{{old('pdf_enter_question')}}"></textarea>
@error('mrp_one') <small class="text-danger">{{ $message }}</small> @enderror

</div> -->


    <div class="mb-3 col-md-6 pdfcon" style="display:none">
    <label for="inputEmail4" class="form-label">Content Upload</label>
    <textarea type="file" class="form-control ckeditor" name="content_upload_question" value="{{old('content_upload_question')}}"></textarea>
    @error('enter_question') <small class="text-danger">{{ $message }}</small> @enderror
   </div>

   <!-- <div class="mb-3 col-md-6 pdfcon" style="display:none">
    <label for="inputEmail4" class="form-label">Content Enter Question</label>
    <input type="file" class="form-control" name="content_enter_quetion" value="{{old('content_enter_quetion')}}" placeholder="PDF Upload Quetion">
    @error('content_enter_quetion') <small class="text-danger">{{ $message }}</small> @enderror
   </div> -->


   <!-- <div>--------------PDF AREA ANSWER-------------------</div>
   <div class="mb-3 col-md-12">

<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="inlineRadioOptions1" id="inlineRadio5" value="option2">
  <label class="form-check-label" for="inlineRadio2">PDF File</label>
</div>

<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="inlineRadioOptions1" id="inlineRadio6" value="option2">
  <label class="form-check-label" for="inlineRadio2">PDF CONTENT</label>
</div>
</div> -->




<div class="mb-3 col-md-6 pdfileAnswer" style="display:none">
<label for="inputEmail4" class="form-label">PDF Upload Answer</label>

<input type="file" class="form-control" name="pdf_upload_answer" value="{{old('pdf_upload_answer')}}" placeholder="PDF Upload Quetion">
@error('mrp_one') <small class="text-danger">{{ $message }}</small> @enderror

</div>

<!-- <div class="mb-3 col-md-6 pdfileAnswer" style="display:none">
<label for="inputEmail4" class="form-label">PDF Enter Answer</label>

<textarea type="text" class="form-control ckeditor" name="pdf_enter_answer" value="{{old('pdf_enter_answer')}}"></textarea>
@error('mrp_one') <small class="text-danger">{{ $message }}</small> @enderror

</div> -->


    <div class="mb-3 col-md-6 pdfconAnswer" style="display:none">
    <label for="inputEmail4" class="form-label">Content Upload Answer</label>
    <textarea type="file" class="form-control ckeditor" name="content_upload_answer" value="{{old('content_upload_answer')}}"></textarea>
    @error('enter_question') <small class="text-danger">{{ $message }}</small> @enderror
   </div>

   <!-- <div class="mb-3 col-md-6 pdfconAnswer" style="display:none">
    <label for="inputEmail4" class="form-label">Content Enter Answer</label>
    <input type="file" class="form-control" name="content_enter_answer" value="{{old('content_enter_answer')}}" placeholder="PDF Upload Answer">
    @error('content_enter_quetion') <small class="text-danger">{{ $message }}</small> @enderror
   </div> -->

                                            <div class="row g-2">



                                            <div class="mb-3 col-md-6">
                                                    <label for="inputPassword4" class="form-label">Meta Key</label>
                                                    <input type="text" class="form-control" name="meta_key" value="{{old('meta_key')}}" placeholder="Meta Key" required>

                                                    @error('meta_key') <small class="text-danger">{{ $message }}</small> @enderror

                                                </div>
   
                                          <div class="mb-3 col-md-6">
                                                    <label for="inputPassword4" class="form-label">Is_Active</label>
                                                    <select class="form-control" name="is_active" required>
                                                        <option value="1">Yes</option>
                                                        <option value="0">No</option>
                                                    </select>
                                                    @error('is_active') <small class="text-danger">{{ $message }}</small> @enderror

                                                </div>

                                                <div class="mb-3 col-md-12">
    <label for="inputEmail4" class="form-label">Description</label>
    <textarea type="text" class="form-control ckeditor" name="description" value="{{old('mrp_five')}}"></textarea>
    @error('description') <small class="text-danger">{{ $message }}</small> @enderror
   </div>

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
        <!-- END wrapper -->
        @include('admin.layouts.footer')
        <script>
$("#extend").on('change',function(){
    console.log($(this).val())
    if($(this).val() === 'custom'){
$(".custom").show();
$(".fixed").hide();
    }else{
        $(".custom").hide();
        $(".fixed").show();
    }
})

$("#inlineRadio2").on('click',function(){
    if ($("#inlineRadio2").prop("checked") === true) {
    $(".liveclass").show();
    $(".requiredfield").prop('required',true)
}else{
    $(".liveclass").hide();
    $(".requiredfield").prop('required',false)
}
})



$("#extend").on('change',function(){
    console.log($(this).val())
    if($(this).val() === 'custom'){
$(".custom").show();
$(".fixed").hide();
    }else{
        $(".custom").hide();
        $(".fixed").show();
    }
})

$("#inlineRadio3").on('click',function(){
    if ($("#inlineRadio3").prop("checked") === true) {
    $(".pdfile").show();
    $(".pdfcon").hide();
    
}else{
    $(".pdfile").hide();
   
}
})

$("#inlineRadio4").on('click',function(){
    if ($("#inlineRadio4").prop("checked") === true) {
    $(".pdfcon").show();
    $(".pdfile").hide();
    
}else{
    $(".pdfcon").hide();
   
}
})




$("#inlineRadio5").on('click',function(){
    if ($("#inlineRadio5").prop("checked") === true) {
    $(".pdfileAnswer").show();
    $(".pdfconAnswer").hide();
   
    
}
})


$("#inlineRadio6").on('click',function(){
    if ($("#inlineRadio6").prop("checked") === true) {
    $(".pdfconAnswer").show();
    $(".pdfileAnswer").hide();

    
}
})



        </script>

       
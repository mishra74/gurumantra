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
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">OffLine Mock Tests</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Add Mock Tests</a></li>
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


                                <form method="post" action="{{ route('mocktest.offline.update', $model->id) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="row g-2">

                                        <!-- Live Test Checkbox -->
                                        <div class="mb-3 col-md-12">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="live_class"
                                                    id="inlineRadio2" value="yes"
                                                    {{ $model->live_class == 'yes' ? 'checked' : '' }}>
                                                <label class="form-check-label">Live Test + Practice</label>
                                            </div>
                                        </div>

                                        <!-- Title -->
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Title</label>
                                            <input type="text" class="form-control" name="title"
                                                value="{{ old('title', $model->title) }}" required>
                                        </div>

                                        <!-- Thumbnail -->
                                        <div class="col-md-6">
                                            <label class="form-label">Thumbnail</label>
                                            <input type="file" name="thumbnail" class="form-control">

                                            @if($model->thumbnail)
                                            <img src="{{ asset($model->thumbnail) }}" width="80" class="mt-2">
                                            @endif
                                        </div>

                                        <!-- Start Date -->
                                        <div class="mb-3 col-md-6 liveclass">
                                            <label class="form-label">Start Date</label>
                                            <input type="date" class="form-control requiredfield" name="start_date"
                                                value="{{ old('start_date', $model->start_date) }}">
                                        </div>

                                        <!-- Start Time -->
                                        <div class="mb-3 col-md-6 liveclass">
                                            <label class="form-label">Start Time</label>
                                            <input type="time" class="form-control requiredfield" name="start_time"
                                                value="{{ old('start_time', $model->start_time) }}">
                                        </div>

                                        <!-- Time Period -->
                                        <div class="mb-3 col-md-6 liveclass">
                                            <label class="form-label">Time Period</label>
                                            <input type="text" class="form-control requiredfield" name="time_period"
                                                value="{{ old('time_period', $model->time_period) }}">
                                        </div>

                                        <!-- Expiry -->
                                        <div class="mb-3 col-md-6 liveclass">
                                            <label class="form-label">Live Test Expire</label>
                                            <input type="datetime-local" class="form-control requiredfield"
                                                name="last_time"
                                                value="{{ old('last_time', \Carbon\Carbon::parse($model->last_time)->format('Y-m-d\TH:i')) }}">
                                        </div>

                                        <!-- QUESTION TYPE -->
                                        <div class="mb-3 col-md-12">
                                            <label><b>Question Type</b></label><br>

                                            <input type="radio" name="question_type" value="file"
                                                {{ $model->question_type == 'file' ? 'checked' : '' }}> PDF File

                                            <input type="radio" name="question_type" value="content"
                                                {{ $model->question_type == 'content' ? 'checked' : '' }}> PDF Content
                                        </div>

                                        <!-- PDF FILE -->
                                        <div class="mb-3 col-md-6 pdfile">
                                            <label>PDF Upload Question</label>
                                            <input type="file" class="form-control" name="pdf_upload_question">
                                        </div>

                                        <!-- CONTENT -->
                                        <div class="mb-3 col-md-6 pdfcon">
                                            <label>Content Question</label>
                                            <textarea class="form-control ckeditor" name="content_upload_question">
                {{ old('content_upload_question', $model->content_upload_question) }}
            </textarea>
                                        </div>

                                        <!-- ANSWER TYPE -->
                                        <div class="mb-3 col-md-12">
                                            <label><b>Answer Type</b></label><br>

                                            <input type="radio" name="answer_type" value="file"
                                                {{ $model->answer_type == 'file' ? 'checked' : '' }}> PDF File

                                            <input type="radio" name="answer_type" value="content"
                                                {{ $model->answer_type == 'content' ? 'checked' : '' }}> PDF Content
                                        </div>

                                        <!-- PDF ANSWER -->
                                        <div class="mb-3 col-md-6 pdfileAnswer">
                                            <label>PDF Upload Answer</label>
                                            <input type="file" class="form-control" name="pdf_upload_answer">
                                        </div>

                                        <!-- CONTENT ANSWER -->
                                        <div class="mb-3 col-md-6 pdfconAnswer">
                                            <label>Content Answer</label>
                                            <textarea class="form-control ckeditor" name="content_upload_answer">
                {{ old('content_upload_answer', $model->content_upload_answer) }}
            </textarea>
                                        </div>

                                        <!-- Meta -->
                                        <div class="mb-3 col-md-6">
                                            <label>Meta Key</label>
                                            <input type="text" class="form-control" name="meta_key"
                                                value="{{ old('meta_key', $model->meta_key) }}" required>
                                        </div>

                                        <!-- Status -->
                                        <div class="mb-3 col-md-6">
                                            <label>Status</label>
                                            <select class="form-control" name="is_active">
                                                <option value="1" {{ $model->is_active == 1 ? 'selected' : '' }}>Yes
                                                </option>
                                                <option value="0" {{ $model->is_active == 0 ? 'selected' : '' }}>No
                                                </option>
                                            </select>
                                        </div>

                                        <!-- Description -->
                                        <div class="mb-3 col-md-12">
                                            <label>Description</label>
                                            <textarea class="form-control ckeditor" name="description">
                {{ old('description', $model->description) }}
            </textarea>
                                        </div>

                                    </div>

                                    <button type="submit" class="btn btn-success">Update</button>


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
$("#extend").on('change', function() {

})

$("#inlineRadio2").on('click', function() {
    if ($("#inlineRadio2").prop("checked") === true) {
        $(".liveclass").show();
        $(".requiredfield").prop('required', true)
    } else {
        $(".liveclass").hide();
        $(".requiredfield").prop('required', false)
    }
})



$("#extend").on('change', function() {
    console.log($(this).val())
    if ($(this).val() === 'custom') {
        $(".custom").show();
        $(".fixed").hide();
    } else {
        $(".custom").hide();
        $(".fixed").show();
    }
})

$("#inlineRadio3").on('click', function() {
    if ($("#inlineRadio3").prop("checked") === true) {
        $(".pdfile").show();
        $(".pdfcon").hide();

    } else {
        $(".pdfile").hide();

    }
})

$("#inlineRadio4").on('click', function() {
    if ($("#inlineRadio4").prop("checked") === true) {
        $(".pdfcon").show();
        $(".pdfile").hide();

    } else {
        $(".pdfcon").hide();

    }
})




$("#inlineRadio5").on('click', function() {
    if ($("#inlineRadio5").prop("checked") === true) {
        $(".pdfileAnswer").show();
        $(".pdfconAnswer").hide();


    }
})


$("#inlineRadio6").on('click', function() {
    if ($("#inlineRadio6").prop("checked") === true) {
        $(".pdfconAnswer").show();
        $(".pdfileAnswer").hide();


    }
})
</script>
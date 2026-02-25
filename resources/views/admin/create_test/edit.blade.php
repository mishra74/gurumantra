<!-- Begin page -->
@include('admin.layouts.header')

<div class="wrapper">

@include('admin.layouts.topbar')
@include('admin.layouts.sidebar')

<div class="content-page">
<div class="content">
<div class="container-fluid">

<!-- Page Title -->
<div class="row">
<div class="col-12">
<div class="page-title-box">
<div class="page-title-right">
<ol class="breadcrumb m-0">
<li class="breadcrumb-item">My Tests</li>
<li class="breadcrumb-item active">{{ $page }}</li>
</ol>
</div>
<h4 class="page-title">{{ $page }}</h4>
</div>
</div>
</div>

<!-- Form -->
<div class="row">
<div class="col-12">
<div class="card">
<div class="card-body">

<form method="POST"
      action="{{ route('createst.update', $edit->id) }}"
      enctype="multipart/form-data">
@csrf
@method('PUT')

<div class="row g-2">

<!-- Live Class -->
<div class="mb-3 col-md-12">
<div class="form-check form-check-inline">
<input class="form-check-input"
       type="checkbox"
       name="live_class"
       id="inlineRadio2"
       value="yes"
       {{ old('live_class', $edit->live_class) == true ? 'checked' : '' }}>
<label class="form-check-label">Live Test + Practice</label>
</div>
</div>

<!-- Title -->
<div class="mb-3 col-md-6">
<label class="form-label">Title</label>
<input type="text"
       class="form-control"
       name="title"
       value="{{ old('title', $edit->title) }}"
       required>
</div>

<!-- Start Date -->
<div class="mb-3 col-md-6 liveclass" style="display:none">
<label class="form-label">Start Date</label>
<input type="date"
       class="form-control requiredfield"
       name="start_date"
       value="{{ old('start_date', $edit->start_date) }}"
>
</div>

<!-- Start Time -->
<div class="mb-3 col-md-6 liveclass" style="display:none">
<label class="form-label">Start Time</label>
<input type="time"
       class="form-control requiredfield"
       name="start_time"
       value="{{ old('start_time', $edit->start_time) }}">
</div>
<div class="mb-3 col-md-6 liveclass" style="display:none">
                                                    <label for="inputPassword4" class="form-label">Live Test Expire  Date Time</label>
<input type="datetime-local" 
       class="form-control requiredfield" 
       name="last_time" 
       value="{{ old('last_time', isset($edit->last_time) ? \Carbon\Carbon::parse($edit->last_time)->format('Y-m-d\TH:i') : '') }}">


                                                    @error('start_date') <small class="text-danger">{{ $message }}</small> @enderror

                                                </div>
<!-- Time Period -->
<div class="mb-3 col-md-6 liveclass" style="display:none">
<label class="form-label">Time Period (Minutes)</label>
<input type="text"
       class="form-control requiredfield"
       name="time_period"
       value="{{ old('time_period', $edit->time_period) }}">
</div>

<!-- Question Type -->
<div class="col-md-12 mt-3">------ QUESTION ------</div>

<div class="mb-3 col-md-12">
<input type="radio" name="question_type" id="inlineRadio3"
       value="pdf"
       {{ old('question_type', $edit->question_type) === 'pdf' ? 'checked' : '' }}>
PDF File

<input type="radio" name="question_type" id="inlineRadio4"
       value="content"
       {{ old('question_type', $edit->question_type) === 'content' ? 'checked' : '' }}>
Content
</div>

<div class="mb-3 col-md-6 pdfile" style="display:none">
<label>PDF Upload Question</label>
<input type="file" class="form-control" name="pdf_upload_question">
</div>

<div class="mb-3 col-md-6 pdfcon" style="display:none">
<label>Content Question</label>
<textarea class="form-control ckeditor"
          name="content_upload_question">{{ old('content_upload_question', $edit->content_upload_question) }}</textarea>
</div>

<!-- Meta -->
<div class="mb-3 col-md-6">
<label>Meta Key</label>
<input type="text"
       class="form-control"
       name="meta_key"
       value="{{ old('meta_key', $edit->meta_key) }}"
       required>
</div>

<!-- Status -->
<div class="mb-3 col-md-6">
<label>Status</label>
<select name="is_active" class="form-control">
<option value="1" {{ $edit->is_active == 1 ? 'selected' : '' }}>Yes</option>
<option value="0" {{ $edit->is_active == 0 ? 'selected' : '' }}>No</option>
</select>
</div>

<!-- Description -->
<div class="mb-3 col-md-12">
<label>Description</label>
<textarea class="form-control ckeditor"
          name="description">{{ old('description', $edit->description) }}</textarea>
</div>

</div>

<button type="submit" class="btn btn-primary">Update</button>

</form>

</div>
</div>
</div>
</div>

</div>
</div>
</div>

@include('admin.layouts.footer')

<!-- JS -->
<script>
$(document).ready(function () {

    if ($("#inlineRadio2").is(":checked")) {
        $(".liveclass").show();
        $(".requiredfield").prop('required', true);
    }

    $("#inlineRadio2").change(function () {
        $(".liveclass").toggle(this.checked);
        $(".requiredfield").prop('required', this.checked);
    });

    $("#inlineRadio3").change(function () {
        $(".pdfile").show();
        $(".pdfcon").hide();
    });

    $("#inlineRadio4").change(function () {
        $(".pdfcon").show();
        $(".pdfile").hide();
    });

    if ($("#inlineRadio3").is(":checked")) {
        $(".pdfile").show();
    }

    if ($("#inlineRadio4").is(":checked")) {
        $(".pdfcon").show();
    }
});
</script>

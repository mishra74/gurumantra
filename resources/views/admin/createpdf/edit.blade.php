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

@php
$pdfType = old('pdf_type');

if(!$pdfType){
    if(!empty($create_note->pdf_file_question)){
        $pdfType = 'file';
    }elseif(!empty($create_note->pdf_enter_question)){
        $pdfType = 'content';
    }
}
@endphp

<form method="post"
      action="{{ route('create_pdfnotes.update', $create_note->id) }}"
      enctype="multipart/form-data">
@csrf
@method('PUT')

<div class="row g-2">

<!-- Title -->
<div class="mb-3 col-md-6">
<label class="form-label">Title</label>
<input type="text" name="title" class="form-control"
value="{{ old('title', $create_note->title) }}" required>
</div>

<!-- Thumbnail -->
<div class="mb-3 col-md-6">
<label class="form-label">Thumbnail</label>
<input type="file" name="thumbnail" class="form-control">

@if($create_note->thumbnail)
<div class="mt-2">
<img src="{{ asset($create_note->thumbnail) }}" width="80">
</div>
@endif
</div>

<!-- PDF TYPE -->
<div class="mb-3 col-md-12">
<label class="form-label">PDF Type</label><br>

<label>
<input type="radio" name="pdf_type" value="pdf_file_question"
{{ $pdfType == 'file' ? 'checked' : '' }}> PDF File
</label>

<label class="ms-3">
<input type="radio" name="pdf_type" value="content"
{{ $pdfType == 'content' ? 'checked' : '' }}> PDF Content
</label>
</div>

<!-- PDF FILE -->
<div class="mb-3 col-md-6 pdfile"
style="{{ $pdfType == 'file' ? '' : 'display:none' }}">
<label class="form-label">Upload PDF</label>
<input type="file" name="pdf_upload_question" class="form-control">

@if($create_note->pdf_file_question)
<div class="mt-2">
<a href="{{ asset($create_note->pdf_file_question) }}" target="_blank">
View Existing PDF
</a>
</div>
@endif
</div>

<!-- PDF CONTENT -->
<div class="mb-3 col-md-6 pdfcon"
style="{{ $pdfType == 'content' ? '' : 'display:none' }}">
<label class="form-label">Content</label>
<textarea name="content_upload_question"
class="form-control ckeditor">{{ old('pdf_enter_question', $create_note->pdf_enter_question) }}</textarea>
</div>

<!-- Meta Key -->
<div class="mb-3 col-md-6">
<label class="form-label">Meta Key</label>
<input type="text" name="meta_key" class="form-control"
value="{{ old('meta_key', $create_note->meta_key) }}" required>
</div>

<!-- Status -->
<div class="mb-3 col-md-6">
<label class="form-label">Is Active</label>
<select name="is_active" class="form-control">
<option value="1" {{ $create_note->is_active == 1 ? 'selected' : '' }}>Yes</option>
<option value="0" {{ $create_note->is_active == 0 ? 'selected' : '' }}>No</option>
</select>
</div>

<!-- Description -->
<div class="mb-3 col-md-12">
<label class="form-label">Description</label>
<textarea name="description" class="form-control ckeditor">
{{ old('description', $create_note->description) }}
</textarea>
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
$(document).ready(function(){

    function togglePdf(){
        let type = $("input[name='pdf_type']:checked").val();

        if(type === 'file'){
            $(".pdfile").show();
            $(".pdfcon").hide();
        } else {
            $(".pdfcon").show();
            $(".pdfile").hide();
        }
    }

    togglePdf();

    $("input[name='pdf_type']").change(function(){
        togglePdf();
    });

});
</script>
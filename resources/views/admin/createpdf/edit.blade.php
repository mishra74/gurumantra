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

<form method="post"
      action="{{ route('create_pdfnotes.update', $create_note->id) }}"
      enctype="multipart/form-data">
@csrf
@method('PUT')

<div class="row g-2">

<div class="mb-3 col-md-6">
<label class="form-label">Title</label>
<input type="text" name="title" class="form-control"
       value="{{ old('title', $create_note->title) }}" required>
</div>
 <!-- Thumbnail -->
    <div class="col-md-6">
        <label class="form-label">Thumbnail</label>
        <input type="file" name="thumbnail" class="form-control" accept=".jpg,.jpeg,.png">

        @if($create_note->thumbnail)
            <div class="mt-2">
                <img src="{{ asset($create_note->thumbnail) }}" width="80" class="rounded">
            </div>
        @endif
    </div>
<div class="mb-3 col-md-6 liveclass"
     style="{{ $create_note->start_date ? '' : 'display:none' }}">
<label class="form-label">Start Date</label>
<input type="date" name="start_date" class="form-control requiredfield"
       value="{{ old('start_date', $create_note->start_date) }}">
</div>

<div class="mb-3 col-md-6 liveclass"
     style="{{ $create_note->time_period ? '' : 'display:none' }}">
<label class="form-label">Time Period (Minutes)</label>
<input type="text" name="time_period" class="form-control requiredfield"
       value="{{ old('time_period', $create_note->time_period) }}">
</div>

<div class="mb-3 col-md-6 liveclass"
     style="{{ $create_note->last_time ? '' : 'display:none' }}">
<label class="form-label">Live Test Expire Date</label>
<input type="date" name="last_time" class="form-control requiredfield"
       value="{{ old('last_time', $create_note->last_time) }}">
</div>

<!-- PDF TYPE -->
<div class="mb-3 col-md-12">
<label class="form-label">PDF Type</label><br>

<input type="radio" name="pdf_type" value="file"
{{ $create_note->pdf_upload_question ? 'checked' : '' }}> PDF File

<input type="radio" name="pdf_type" value="content"
{{ $create_note->content_upload_question ? 'checked' : '' }}> PDF Content
</div>

<div class="mb-3 col-md-6 pdfile"
     style="{{ $create_note->pdf_upload_question ? '' : 'display:none' }}">
<label class="form-label">PDF Upload</label>
<input type="file" name="pdf_upload_question" class="form-control">
@if($create_note->pdf_upload_question)
<small class="text-success">File already uploaded</small>
@endif
</div>

<div class="mb-3 col-md-6 pdfcon"
     style="{{ $create_note->content_upload_question ? '' : 'display:none' }}">
<label class="form-label">PDF Content</label>
<textarea name="content_upload_question"
          class="form-control ckeditor">{{ old('content_upload_question', $create_note->content_upload_question) }}</textarea>
</div>

<div class="mb-3 col-md-6">
<label class="form-label">Meta Key</label>
<input type="text" name="meta_key" class="form-control"
       value="{{ old('meta_key', $create_note->meta_key) }}" required>
</div>

<div class="mb-3 col-md-6">
<label class="form-label">Is Active</label>
<select name="is_active" class="form-control">
<option value="1" {{ $create_note->is_active == 1 ? 'selected' : '' }}>Yes</option>
<option value="0" {{ $create_note->is_active == 0 ? 'selected' : '' }}>No</option>
</select>
</div>

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

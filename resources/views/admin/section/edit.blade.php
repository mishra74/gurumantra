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
<li class="breadcrumb-item">Live Classes</li>
<li class="breadcrumb-item">Section</li>
<li class="breadcrumb-item active">{{$page}}</li>
</ol>
</div>
<h4 class="page-title">{{$page}}</h4>
</div>
</div>
</div>

<!-- Edit Form -->
<div class="row">
<div class="col-12">
<div class="card">
<div class="card-body">

<form method="POST"
      action="{{ route('section.update', $section->id) }}"
      enctype="multipart/form-data">

@csrf
@method('PUT')

<div class="row g-2">

<!-- Title -->
<div class="mb-3 col-md-6">
<label class="form-label">Title</label>
<input type="text"
       class="form-control"
       name="title"
       value="{{ old('title', $section->title) }}"
       required>
@error('title') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<!-- Marks -->
<div class="mb-3 col-md-6">
<label class="form-label">Marks</label>
<input type="text"
       class="form-control"
       name="marks"
       value="{{ old('marks', $section->marks) }}"
       required>
@error('marks') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<!-- Negative Marks -->
<div class="mb-3 col-md-6">
<label class="form-label">Negative Marks</label>
<input type="text"
       class="form-control"
       name="negative_marks"
       value="{{ old('negative_marks', $section->negative_marks) }}"
       required>
@error('negative_marks') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<!-- Language -->
<div class="mb-3 col-md-6">
<label class="form-label">Select Language</label>
<select class="form-control" name="language" required>
@foreach($languages as $language)
<option value="{{ $language->id }}"
    {{ old('language', $section->language) == $language->id ? 'selected' : '' }}>
    {{ $language->name }}
</option>
@endforeach
</select>
@error('language') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<!-- Status -->
<div class="mb-3 col-md-6">
<label class="form-label">Is Active</label>
<select class="form-control" name="is_active" required>
<option value="1" {{ old('is_active', $section->is_active) == 1 ? 'selected' : '' }}>Yes</option>
<option value="0" {{ old('is_active', $section->is_active) == 0 ? 'selected' : '' }}>No</option>
</select>
@error('is_active') <small class="text-danger">{{ $message }}</small> @enderror
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

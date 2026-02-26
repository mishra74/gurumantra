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
<h4 class="page-title">{{ $page }}</h4>
</div>
</div>
</div>

<div class="row">
<div class="col-12">
<div class="card">
<div class="card-body">

<form method="POST"
      action="{{ route('recording.update', $edit->id) }}"
      enctype="multipart/form-data">
@csrf
@method('PUT')

<!-- General Package -->
<div class="form-check mb-3">
<input class="form-check-input"
       type="checkbox"
       name="genral_package"
       value="yes"
       {{ old('genral_package', $edit->genral_package) == 'yes' ? 'checked' : '' }}>
<label class="form-check-label">General Package</label>
</div>

<div class="row g-2">

<!-- Title -->
<div class="mb-3 col-md-6">
<label>Title</label>
<input type="text"
       class="form-control"
       name="title"
       value="{{ old('title', $edit->title) }}"
       required>
</div>
 <!-- Thumbnail -->
    <div class="col-md-6">
        <label class="form-label">Thumbnail</label>
        <input type="file" name="thumbnail" class="form-control" accept=".jpg,.jpeg,.png">

        @if($edit->thumbnail)
            <div class="mt-2">
                <img src="{{ asset($edit->thumbnail) }}" width="80" class="rounded">
            </div>
        @endif
    </div>
<!-- Start Date -->
<div class="mb-3 col-md-6">
<label>Start Date</label>
<input type="date"
       class="form-control"
       name="start_date"
       value="{{ old('start_date', optional($edit->start_date)->format('Y-m-d')) }}"
       required>
</div>

<!-- Validity -->
<div class="mb-3 col-md-6 custom" style="display:none">
<label>Validity</label>
<div class="input-group">
<input type="number"
       class="form-control"
       name="validity"
       value="{{ old('validity', $edit->validity) }}">
<select name="validity_type" class="form-select">
<option value="days" {{ $edit->validity_type=='days'?'selected':'' }}>Days</option>
<option value="months" {{ $edit->validity_type=='months'?'selected':'' }}>Months</option>
<option value="years" {{ $edit->validity_type=='years'?'selected':'' }}>Years</option>
</select>
</div>
</div>

<!-- Courses -->
<div class="mb-3 col-md-6">
<label>Select Courses</label>
@php
    $selectedCourses = json_decode($edit->courses, true) ?? [];
@endphp

<select class="form-control select2" name="courses[]" multiple required>
    @foreach($courses as $course)
        <option value="{{ $course->id }}"
            {{ in_array((string)$course->id, $selectedCourses) ? 'selected' : '' }}>
            {{ $course->title }}
        </option>
    @endforeach
</select>

</div>

<!-- Extend Type -->
<div class="mb-3 col-md-6">
<label>Extend Type</label>
<select name="extend_type" id="extend" class="form-control">
<option value="fixed" {{ $edit->extend_type=='fixed'?'selected':'' }}>Fixed</option>
<option value="custom" {{ $edit->extend_type=='custom'?'selected':'' }}>Custom</option>
</select>
</div>

<!-- Custom Pricing -->
<div class="mb-3 col-md-6 custom" style="display:none">
<label>MRP</label>
<input type="text" class="form-control" name="mrp" value="{{ old('mrp',$edit->mrp) }}">
</div>

<div class="mb-3 col-md-6 custom" style="display:none">
<label>Price</label>
<input type="text" class="form-control" name="price" value="{{ old('price',$edit->price) }}">
</div>

<!-- Status -->
<div class="mb-3 col-md-6">
<label>Status</label>
<select name="is_active" class="form-control">
<option value="1" {{ $edit->is_active==1?'selected':'' }}>Yes</option>
<option value="0" {{ $edit->is_active==0?'selected':'' }}>No</option>
</select>
</div>

<!-- Paid -->
<div class="mb-3 col-md-6">
<label>Paid</label>
<select name="paid" class="form-control">
<option value="1" {{ $edit->paid==1?'selected':'' }}>Yes</option>
<option value="0" {{ $edit->paid==0?'selected':'' }}>No</option>
</select>
</div>

<!-- Coin -->
<div class="mb-3 col-md-6">
<label>Coin Deduction %</label>
<input type="text"
       class="form-control"
       name="coin_percentage"
       value="{{ old('coin_percentage', $edit->coin_percentage) }}">
</div>

<!-- Description -->
<div class="mb-3 col-md-12">
<label>Description</label>
<textarea class="form-control ckeditor"
          name="description">{{ old('description',$edit->description) }}</textarea>
</div>

</div>

<button class="btn btn-primary">Update</button>

</form>

</div>
</div>
</div>
</div>

</div>
</div>
</div>

@include('admin.layouts.footer')

<script>
$(document).ready(function () {

    if ($("#extend").val() === 'custom') {
        $(".custom").show();
        $(".fixed").hide();
    }

    $("#extend").change(function () {
        if ($(this).val() === 'custom') {
            $(".custom").show();
            $(".fixed").hide();
        } else {
            $(".custom").hide();
            $(".fixed").show();
        }
    });

});
</script>

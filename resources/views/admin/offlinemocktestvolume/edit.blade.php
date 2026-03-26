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
            <h4 class="page-title">{{$page}}</h4>
        </div>
    </div>
</div>

<div class="row">
<div class="col-12">
<div class="card">
<div class="card-body">

<h4 class="header-title">{{$page}}</h4>

<form method="POST" action="{{ route('mocktest.offline.update.volume', $data->id) }}" enctype="multipart/form-data">
@csrf
@method('PUT')

<div class="row">

    <!-- Title -->
    <div class="col-md-6 mb-3">
        <label>Title</label>
        <input type="text" name="title" class="form-control"
               value="{{ old('title', $data->title) }}" required>
    </div>

    <!-- Thumbnail -->
    <div class="col-md-6 mb-3">
        <label>Thumbnail</label>
        <input type="file" name="thumbnail" class="form-control">

        @if($data->thumbnail)
            <br>
            <img src="{{ asset($data->thumbnail) }}" width="80">
        @endif
    </div>

    <!-- Centers -->
    <div class="col-md-6 mb-3">
        <label>Centers</label>
        <select name="center_ids[]" class="form-control select2" multiple>

            @php
                $selectedCenters = old('center_id', $data->center_id ?? []);
                if(is_string($selectedCenters)){
                    $selectedCenters = json_decode($selectedCenters, true);
                }
            @endphp

            @foreach($centers as $center)
                <option value="{{ $center->id }}"
                    {{ in_array($center->id, $selectedCenters ?? []) ? 'selected' : '' }}>
                    {{ $center->title }}
                </option>
            @endforeach

        </select>
    </div>

    <!-- CBT -->
    <div class="col-md-6 mb-3">
        <label>CBT</label><br>
        <input type="radio" name="cbt" value="1"
            {{ old('cbt', $data->cbt) == '1' ? 'checked' : '' }}> Yes

        <input type="radio" name="cbt" value="0"
            {{ old('cbt', $data->cbt) == '0' ? 'checked' : '' }}> No
    </div>

    <!-- OMR -->
    <div class="col-md-6 mb-3">
        <label>OMR</label><br>
        <input type="radio" name="omr" value="1"
            {{ old('omr', $data->omr) == '1' ? 'checked' : '' }}> Yes

        <input type="radio" name="omr" value="0"
            {{ old('omr', $data->omr) == '0' ? 'checked' : '' }}> No
    </div>

    <!-- Meta Key -->
    <div class="col-md-6 mb-3">
        <label>Meta Key</label>
        <input type="text" name="meta_key" class="form-control"
               value="{{ old('meta_key', $data->meta_key) }}">
    </div>

    <!-- Description -->
    <div class="col-md-12 mb-3">
        <label>Description</label>
        <textarea class="form-control ckeditor" name="description">
            {{ old('description', $data->description) }}
        </textarea>
    </div>

    <!-- Pricing -->
    <div class="col-md-4 mb-3">
        <label>MRP</label>
        <input type="number" name="mrp" class="form-control"
               value="{{ old('mrp', $data->mrp) }}">
    </div>

    <div class="col-md-4 mb-3">
        <label>Price</label>
        <input type="number" name="price" class="form-control"
               value="{{ old('price', $data->price) }}">
    </div>

    <div class="col-md-4 mb-3">
        <label>Discount</label>
        <input type="number" name="discount" class="form-control"
               value="{{ old('discount', $data->discount) }}">
    </div>

    <!-- Dates -->
    <div class="col-md-6 mb-3">
        <label>Start Date</label>
        <input type="date" name="start_date" class="form-control"
               value="{{ old('start_date', $data->start_date) }}">
    </div>

    <div class="col-md-6 mb-3">
        <label>End Date</label>
        <input type="date" name="end_date" class="form-control"
               value="{{ old('end_date', $data->end_date) }}">
    </div>

    <!-- Payment Method -->
    <div class="col-md-6 mb-3">
        <label>Payment Method</label>
        <select name="payment_method" class="form-control">
            <option value="online" {{ old('payment_method', $data->payment_method) == 'online' ? 'selected' : '' }}>Online</option>
            <option value="offline" {{ old('payment_method', $data->payment_method) == 'offline' ? 'selected' : '' }}>Offline</option>
        </select>
    </div>

    <!-- Total Tests -->
    <div class="col-md-6 mb-3">
        <label>Total Tests</label>
        <input type="number" name="total_tests" class="form-control"
               value="{{ old('total_tests', $data->total_tests) }}">
    </div>

    <!-- Status -->
    <div class="col-md-6 mb-3">
        <label>Status</label>
        <select name="is_active" class="form-control">
            <option value="1" {{ old('is_active', $data->is_active) == '1' ? 'selected' : '' }}>Active</option>
            <option value="0" {{ old('is_active', $data->is_active) == '0' ? 'selected' : '' }}>Inactive</option>
        </select>
    </div>

</div>

<button type="submit" class="btn btn-success">Update</button>

</form>

</div>
</div>
</div>
</div>

</div>
</div>
</div>

@include('admin.layouts.footer')
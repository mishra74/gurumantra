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

<!-- ================= CENTER + PRICING ================= -->
<div class="col-md-12 mb-3">
    <label><b>Centers + Pricing</b></label>

    <table class="table table-bordered" id="centerTable">
        <thead>
            <tr>
                <th>Zone</th>
                <th>Center</th>
                <th>MRP</th>
                <th>Price</th>
                <th>Total Seat</th>
                <th width="80">Action</th>
            </tr>
        </thead>
        <tbody>

@php
$centerPrices = $data->centerPrices;
@endphp

@if($centerPrices && count($centerPrices) > 0)
    @foreach($centerPrices as $index => $cp)
    <tr>
        <!-- ZONE -->
        <td>
            <select name="zone_ids[]" class="form-control zone-select" required>
                <option value="">Select Zone</option>
                @foreach($zones as $zone)
                    <option value="{{ $zone->id }}"
                        {{ $zone->id == $cp->zone_id ? 'selected' : '' }}>
                        {{ $zone->title }}
                    </option>
                @endforeach
            </select>
        </td>

        <!-- CENTER -->
        <td>
            <select name="center_ids[]" class="form-control center-select" required
                    data-selected="{{ $cp->center_id }}">
                <option value="">Loading...</option>
            </select>
        </td>

        <!-- MRP -->
        <td>
            <input type="number" name="mrp[]" value="{{ $cp->mrp }}" class="form-control" required>
        </td>

        <!-- PRICE -->
        <td>
            <input type="number" name="price[]" value="{{ $cp->price }}" class="form-control" required>
        </td>

        <!-- SEAT -->
        <td>
            <input type="number" name="total_seat[]" value="{{ $cp->total_seat }}" class="form-control" required>
        </td>

        <!-- ACTION -->
        <td>
            @if($index == 0)
                <button type="button" class="btn btn-success addRow">+</button>
            @else
                <button type="button" class="btn btn-danger removeRow">-</button>
            @endif
        </td>
    </tr>
    @endforeach
@else
<tr>
    <td>
        <select name="zone_ids[]" class="form-control zone-select">
            <option value="">Select Zone</option>
            @foreach($zones as $zone)
                <option value="{{ $zone->id }}">{{ $zone->title }}</option>
            @endforeach
        </select>
    </td>

    <td>
        <select name="center_ids[]" class="form-control center-select">
            <option value="">Select Center</option>
        </select>
    </td>

    <td><input type="number" name="mrp[]" class="form-control"></td>
    <td><input type="number" name="price[]" class="form-control"></td>
    <td><input type="number" name="total_seat[]" class="form-control"></td>

    <td>
        <button type="button" class="btn btn-success addRow">+</button>
    </td>
</tr>
@endif

        </tbody>
    </table>
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

<!-- Meta -->
<div class="col-md-6 mb-3">
    <label>Meta Key</label>
    <input type="text" name="meta_key" class="form-control"
           value="{{ old('meta_key', $data->meta_key) }}">
</div>

<!-- Description -->
<div class="col-md-12 mb-3">
    <label>Description</label>
    <textarea class="form-control ckeditor" name="description">{{ old('description', $data->description) }}</textarea>
</div>

<!-- Discount -->
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

<!-- Payment -->
<div class="col-md-6 mb-3">
    <label>Payment Method</label>
    <select name="payment_method" class="form-control">
        <option value="online" {{ old('payment_method', $data->payment_method) == 'online' ? 'selected' : '' }}>Online</option>
        <option value="offline" {{ old('payment_method', $data->payment_method) == 'offline' ? 'selected' : '' }}>Offline</option>
    </select>
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

<script>
$(document).ready(function(){

    // LOAD CENTERS ON PAGE LOAD
    $('.zone-select').each(function(){
        let zoneId = $(this).val();
        let row = $(this).closest('tr');
        let centerDropdown = row.find('.center-select');
        let selectedCenter = centerDropdown.data('selected');

        if(zoneId){
            loadCenters(zoneId, centerDropdown, selectedCenter);
        }
    });

    // ON CHANGE ZONE
    $(document).on('change', '.zone-select', function(){
        let zoneId = $(this).val();
        let row = $(this).closest('tr');
        let centerDropdown = row.find('.center-select');

        loadCenters(zoneId, centerDropdown);
    });

    // ADD ROW
    $(document).on('click', '.addRow', function(){

        let row = `
        <tr>
            <td>
                <select name="zone_ids[]" class="form-control zone-select">
                    <option value="">Select Zone</option>
                    @foreach($zones as $zone)
                        <option value="{{ $zone->id }}">{{ $zone->title }}</option>
                    @endforeach
                </select>
            </td>

            <td>
                <select name="center_ids[]" class="form-control center-select">
                    <option value="">Select Center</option>
                </select>
            </td>

            <td><input type="number" name="mrp[]" class="form-control"></td>
            <td><input type="number" name="price[]" class="form-control"></td>
            <td><input type="number" name="total_seat[]" class="form-control"></td>

            <td>
                <button type="button" class="btn btn-danger removeRow">-</button>
            </td>
        </tr>`;

        $('#centerTable tbody').append(row);
    });

    // REMOVE ROW
    $(document).on('click', '.removeRow', function(){
        $(this).closest('tr').remove();
    });

    // LOAD CENTERS FUNCTION
    function loadCenters(zoneId, dropdown, selectedId = null){

        dropdown.html('<option>Loading...</option>');

        $.ajax({
            url: '/centers/' + zoneId,
            type: 'GET',
            success: function(res){

                let html = '<option value="">Select Center</option>';

                res.centers.forEach(function(center){

                    let selected = (center.id == selectedId) ? 'selected' : '';

                    html += `<option value="${center.id}" ${selected}>${center.title}</option>`;
                });

                dropdown.html(html);
            }
        });
    }

});
</script>
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

<form method="POST" action="{{ route('mocktest.offline.store.volume') }}" enctype="multipart/form-data">
@csrf
<div class="row">

    <!-- Title -->
    <div class="col-md-6 mb-3">
        <label>Title</label>
        <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
    </div>

    <!-- Thumbnail -->
    <div class="col-md-6 mb-3">
        <label>Thumbnail</label>
        <input type="file" name="thumbnail" class="form-control">
    </div>

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

            <tr>
    <!-- ZONE -->
    <td>
        <select name="zone_ids[]" class="form-control zone-select" required>
            <option value="">Select Zone</option>
            @foreach($zones as $zone)
                <option value="{{ $zone->id }}">{{ $zone->title }}</option>
            @endforeach
        </select>
    </td>

    <!-- CENTER -->
    <td>
        <select name="center_ids[]" class="form-control center-select" required>
            <option value="">Select Center</option>
        </select>
    </td>

    <!-- MRP -->
    <td>
        <input type="number" name="mrp[]" class="form-control" required>
    </td>

    <!-- PRICE -->
    <td>
        <input type="number" name="price[]" class="form-control" required>
    </td>
 <td>
                <input type="number" name="total_seat[]" class="form-control" required>
            </td>
    <!-- ACTION -->
    <td>
        <button type="button" class="btn btn-success addRow">+</button>
    </td>
</tr>

        </tbody>
    </table>
</div>
    <!-- CBT -->
    <div class="col-md-6 mb-3">
        <label>CBT</label><br>
        <input type="radio" name="cbt" value="1" {{ old('cbt') == '1' ? 'checked' : '' }}> Yes
        <input type="radio" name="cbt" value="0" {{ old('cbt') == '0' ? 'checked' : '' }}> No
    </div>

    <!-- OMR -->
    <div class="col-md-6 mb-3">
        <label>OMR</label><br>
        <input type="radio" name="omr" value="1" {{ old('omr') == '1' ? 'checked' : '' }}> Yes
        <input type="radio" name="omr" value="0" {{ old('omr') == '0' ? 'checked' : '' }}> No
    </div>

    <!-- Meta Key -->
    <div class="col-md-6 mb-3">
        <label>Meta Key</label>
        <input type="text" name="meta_key" class="form-control" value="{{ old('meta_key') }}">
    </div>

    <!-- Description -->
    <div class="col-md-12 mb-3">
        <label>Description</label>
        <textarea class="form-control ckeditor" name="description">{{ old('description') }}</textarea>
    </div>

   
    <div class="col-md-4 mb-3">
        <label>Discount(%)</label>
        <input type="number" name="discount" class="form-control" value="{{ old('discount') }}">
    </div>

    <!-- Dates -->
    <div class="col-md-6 mb-3">
        <label>Start Date</label>
        <input type="date" name="start_date" class="form-control" value="{{ old('start_date') }}">
    </div>

    <div class="col-md-6 mb-3">
        <label>End Date</label>
        <input type="date" name="end_date" class="form-control" value="{{ old('end_date') }}">
    </div>

    <!-- Payment Method -->
    <div class="col-md-6 mb-3">
        <label>Payment Method</label>
        <select name="payment_method" class="form-control">
            <option value="online" {{ old('payment_method') == 'online' ? 'selected' : '' }}>Online</option>
            <option value="offline" {{ old('payment_method') == 'offline' ? 'selected' : '' }}>Offline</option>
        </select>
    </div>

    

    <!-- Status -->
    <div class="col-md-6 mb-3">
        <label>Status</label>
        <select name="is_active" class="form-control">
            <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>Active</option>
            <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Inactive</option>
        </select>
    </div>

</div>

<button type="submit" class="btn btn-primary">Submit</button>

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

    // ADD ROW
    $(document).on('click', '.addRow', function(){

        let row = `
        <tr>
            <td>
                <select name="zone_ids[]" class="form-control zone-select" required>
                    <option value="">Select Zone</option>
                    @foreach($zones as $zone)
                        <option value="{{ $zone->id }}">{{ $zone->title }}</option>
                    @endforeach
                </select>
            </td>

            <td>
                <select name="center_ids[]" class="form-control center-select" required>
                    <option value="">Select Center</option>
                </select>
            </td>

            <td>
                <input type="number" name="mrp[]" class="form-control" required>
            </td>

            <td>
                <input type="number" name="price[]" class="form-control" required>
            </td>
            <td>
                <input type="number" name="total_seat[]" class="form-control" required>
            </td>

            <td>
                <button type="button" class="btn btn-danger removeRow">-</button>
            </td>
        </tr>
        `;

        $('#centerTable tbody').append(row);
    });

    // REMOVE ROW
    $(document).on('click', '.removeRow', function(){
        $(this).closest('tr').remove();
    });

    // LOAD CENTERS BASED ON ZONE
    $(document).on('change', '.zone-select', function(){

        let zoneId = $(this).val();
        let currentRow = $(this).closest('tr');
        let centerDropdown = currentRow.find('.center-select');

        centerDropdown.html('<option value="">Loading...</option>');

        if(zoneId != ''){
            $.ajax({
                url: '/centers/' + zoneId,
                type: 'GET',
                success: function(response){

                    let html = '<option value="">Select Center</option>';

                    if(response.centers.length > 0){
                        response.centers.forEach(function(center){
                            html += `<option value="${center.id}">${center.title}</option>`;
                        });
                    } else {
                        html = '<option value="">No Centers Found</option>';
                    }

                    centerDropdown.html(html);
                },
                error: function(){
                    centerDropdown.html('<option value="">Error loading centers</option>');
                }
            });
        } else {
            centerDropdown.html('<option value="">Select Center</option>');
        }
    });

});
</script>
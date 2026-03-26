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

<form method="post" action="{{route('batch.update',$edit->id)}}" enctype="multipart/form-data">
@csrf
@method('PUT')

<div class="row g-2">

<div class="mb-3 col-md-6">
<label class="form-label">Title</label>
<input type="text" class="form-control"
name="title"
value="{{old('title',$edit->title)}}" required>
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

<div class="mb-3 col-md-6">
<label class="form-label">Start Date</label>
<input type="date" class="form-control"
name="start_date"
value="{{ old('start_date', \Carbon\Carbon::parse($edit->start_date)->format('Y-m-d')) }}"
 required>
</div>

</div>

<div class="row g-2">

<div class="mb-3 col-md-6">
<label class="form-label">Extend Type</label>
<select name="extend_type" class="form-select" id="extend">
<option value="fixed" {{ old('extend_type',$edit->extend_type)=='fixed'?'selected':'' }}>Fixed</option>
<option value="custom" {{ old('extend_type',$edit->extend_type)=='custom'?'selected':'' }}>Custom</option>
</select>
</div>

</div>

{{-- ================= CUSTOM SECTION ================= --}}
<div class="row g-2 custom">

<div class="mb-3 col-md-6">
<label class="form-label">Validity</label>
<div class="input-group">
<input type="number" min="1" class="form-control"
name="validity"
value="{{old('validity',$edit->validity)}}">

<select name="validity_type" class="form-select">
<option value="days" {{ old('validity_type',$edit->validity_type)=='days'?'selected':'' }}>Days</option>
<option value="months" {{ old('validity_type',$edit->validity_type)=='months'?'selected':'' }}>Months</option>
<option value="years" {{ old('validity_type',$edit->validity_type)=='years'?'selected':'' }}>Years</option>
</select>
</div>
</div>

<div class="mb-3 col-md-6">
<label class="form-label">MRP</label>
<input type="text" class="form-control"
name="mrp_"
value="{{old('mrp',$edit->mrp)}}">
</div>

<div class="mb-3 col-md-6">
<label class="form-label">Price</label>
<input type="text" class="form-control"
name="price"
value="{{old('price',$edit->price)}}">
</div>

</div>

{{-- ================= FIXED SECTION ================= --}}
<div class="row g-2 fixed">

{{-- 30 Days --}}
<div class="mb-3 col-md-2">
<label class="form-label">MRP 30 Days</label>
<input type="text" class="form-control"
name="mrp_one"
value="{{old('mrp_one',$edit->mrp_one)}}">
</div>

<div class="mb-3 col-md-2">
<label class="form-label">Price 30 Days</label>
<input type="text" class="form-control"
name="price_one"
value="{{old('price_one',$edit->price_one)}}">
</div>

<div class="mb-3 col-md-2">
<label class="form-label">Discount 30 Days</label>
<input type="text" class="form-control"
name="discount_one"
value="{{old('discount_one',$edit->discount_one)}}">
</div>

{{-- 90 Days --}}
<div class="mb-3 col-md-2">
<label class="form-label">MRP 90 Days</label>
<input type="text" class="form-control"
name="mrp_two"
value="{{old('mrp_two',$edit->mrp_two)}}">
</div>

<div class="mb-3 col-md-2">
<label class="form-label">Price 90 Days</label>
<input type="text" class="form-control"
name="price_two"
value="{{old('price_two',$edit->price_two)}}">
</div>

<div class="mb-3 col-md-2">
<label class="form-label">Discount 90 Days</label>
<input type="text" class="form-control"
name="discount_two"
value="{{old('discount_two',$edit->discount_two)}}">
</div>

{{-- 180 Days --}}
<div class="mb-3 col-md-2">
<label class="form-label">MRP 180 Days</label>
<input type="text" class="form-control"
name="mrp_three"
value="{{old('mrp_three',$edit->mrp_three)}}">
</div>

<div class="mb-3 col-md-2">
<label class="form-label">Price 180 Days</label>
<input type="text" class="form-control"
name="price_three"
value="{{old('price_three',$edit->price_three)}}">
</div>

<div class="mb-3 col-md-2">
<label class="form-label">Discount 180 Days</label>
<input type="text" class="form-control"
name="discount_three"
value="{{old('discount_three',$edit->discount_three)}}">
</div>

{{-- 270 Days --}}
<div class="mb-3 col-md-2">
<label class="form-label">MRP 270 Days</label>
<input type="text" class="form-control"
name="mrp_four"
value="{{old('mrp_four',$edit->mrp_four)}}">
</div>

<div class="mb-3 col-md-2">
<label class="form-label">Price 270 Days</label>
<input type="text" class="form-control"
name="price_four"
value="{{old('price_four',$edit->price_four)}}">
</div>

<div class="mb-3 col-md-2">
<label class="form-label">Discount 270 Days</label>
<input type="text" class="form-control"
name="discount_four"
value="{{old('discount_four',$edit->discount_four)}}">
</div>

{{-- 360 Days --}}
<div class="mb-3 col-md-2">
<label class="form-label">MRP 360 Days</label>
<input type="text" class="form-control"
name="mrp_five"
value="{{old('mrp_five',$edit->mrp_five)}}">
</div>

<div class="mb-3 col-md-2">
<label class="form-label">Price 360 Days</label>
<input type="text" class="form-control"
name="price_five"
value="{{old('price_five',$edit->price_five)}}">
</div>

<div class="mb-3 col-md-2">
<label class="form-label">Discount 360 Days</label>
<input type="text" class="form-control"
name="discount_five"
value="{{old('discount_five',$edit->discount_five)}}">
</div>

</div>

<div class="row g-2">

<div class="mb-3 col-md-6">
<label class="form-label">Coin Percentage</label>
<input type="number" class="form-control"
name="coin_percentage"
value="{{old('coin_percentage',$edit->coin_percentage)}}">
</div>

<div class="mb-3 col-md-6">
<label class="form-label">Is Active</label>
<select class="form-control" name="is_active">
<option value="1" {{ old('is_active',$edit->is_active)==1?'selected':'' }}>Yes</option>
<option value="0" {{ old('is_active',$edit->is_active)==0?'selected':'' }}>No</option>
</select>
</div>

<div class="mb-3 col-md-12">
<label class="form-label">Description</label>
<textarea class="form-control ckeditor" name="description">
{{old('description',$edit->description)}}
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

<script>
$(document).ready(function(){
toggleFields();
});

$("#extend").on('change',function(){
toggleFields();
});

function toggleFields(){
if($("#extend").val()==='custom'){
$(".custom").show();
$(".fixed").hide();
}else{
$(".custom").hide();
$(".fixed").show();
}
}
</script>

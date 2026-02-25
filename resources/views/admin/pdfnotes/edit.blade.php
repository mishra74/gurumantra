
       
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">My Courses</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Add Courses</a></li>
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
                                       

                                        <form method="post" action="{{route('pdfnotes.update',$test->id)}}" enctype="multipart/form-data">
                                            @csrf

                                            <div class="form-check">
  <input class="form-check-input" type="checkbox" id="check1" name="genral_package" value="yes" >
  <label class="form-check-label">General Package</label>
</div>
                                            <div class="row g-2 mt-2">
                                                <div class="mb-3 col-md-6">
                                                    <label for="inputEmail4" class="form-label">Title</label>
                                                    <input type="text" class="form-control" name="title" value="{{old('title',$test->title)}}" placeholder="Title" required>
                                                    @error('title') <small class="text-danger">{{ $message }}</small> @enderror

                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="inputPassword4" class="form-label">Start Date</label>
                                                    <input type="date" class="form-control" name="start_date"     value="{{ old('start_date', isset($test->start_date) ? \Carbon\Carbon::parse($test->start_date)->format('Y-m-d') : '') }}"  placeholder="Meta Key" required>
                                                    @error('start_date') <small class="text-danger">{{ $message }}</small> @enderror

                                                </div>
                                            </div>

                                            <div class="row g-2">
    <div class="mb-3 col-md-6 custom" style="display:none">
        <label for="validity" class="form-label">Validity</label>
        <div class="input-group">
            <!-- Digit input -->
            <input type="number" 
                   min="1" 
                   class="form-control" 
                   name="validity" 
                   placeholder="Enter number">

            <!-- Unit select -->
            <select name="validity_type" class="form-select">
                <option value="days" {{$test->days == 'days' ? 'selected':''}}>Days</option>
                <option value="months" {{$test->days == 'months' ? 'selected':''}}>Months</option>
                <option value="years"{{$test->days == 'years' ? 'selected':''}} >Years</option>
            </select>
        </div>
        @error('validity_value') <small class="text-danger">{{ $message }}</small> @enderror
        @error('validity_unit') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

@php
    // Decode JSON to array (for multiple courses)
    $selectedCourses = json_decode($test->courses, true);
@endphp

<div class="mb-3 col-md-6">
    <label class="form-label">Select Courses</label>
    <select class="form-control select2" name="courses[]" multiple="multiple" required>
        @foreach($courses as $course)
            <option 
                value="{{ $course->id }}"
                @if( (is_array(old('courses')) && in_array($course->id, old('courses'))) 
                    || (is_array($selectedCourses) && in_array($course->id, $selectedCourses)) )
                    selected
                @endif
            >
                {{ $course->title }}
            </option>
        @endforeach
    </select>
    @error('courses') 
        <small class="text-danger">{{ $message }}</small> 
    @enderror
</div>

    <div class="mb-3 col-md-6">
    <label for="inputEmail4" class="form-label">Extend Type</label>
          <select name="extend_type" class="form-select"  id="extend">
          <option value="fixed" {{$test->extend_type == 'fixed' ? 'selected':'' }}>Fixed</option>
                <option value="custom" {{$test->extend_type == 'custom' ? 'selected':'' }}>Custom</option>
              
            </select>
    @error('extend') <small class="text-danger">{{ $message }}</small> @enderror
   </div>

    <div class="mb-3 col-md-6 custom" style="display:none">
    <label for="inputEmail4" class="form-label">MRP</label>
    <input type="text" class="form-control" name="mrp" value="{{old('mrp',$test->mrp)}}" placeholder="MRP">
    @error('mrp') <small class="text-danger">{{ $message }}</small> @enderror
   </div>

   <div class="mb-3 col-md-6 custom" style="display:none">
    <label for="inputEmail4" class="form-label">Price</label>
    <input type="text" class="form-control" name="price" value="{{old('price',$test->price)}}" placeholder="Price">
    @error('price') <small class="text-danger">{{ $message }}</small> @enderror
   </div>

   

   <div class="mb-3 col-md-2 fixed">
    <label for="inputEmail4" class="form-label">MRP for  30 days</label>
    <input type="text" class="form-control" name="mrp_one" value="{{old('mrp_one',$test->mrp_one)}}" placeholder="Mrp for 30 days">
    @error('mrp_one') <small class="text-danger">{{ $message }}</small> @enderror
   </div>

   <div class="mb-3 col-md-2 fixed">
    <label for="inputEmail4" class="form-label">Price for  30 days</label>
    <input type="text" class="form-control" name="price_one" value="{{old('price_one',$test->price_one)}}" placeholder="Price for 30 days">
    @error('price_one') <small class="text-danger">{{ $message }}</small> @enderror
   </div>

   <div class="mb-3 col-md-2 fixed">
    <label for="inputEmail4" class="form-label">Discount for  30 days</label>
    <input type="text" class="form-control" name="discount_one" value="{{old('discount_one',$test->discount_one)}}" placeholder="Discount for 30 days">
    @error('discount_one') <small class="text-danger">{{ $message }}</small> @enderror
   </div>

   


   <div class="mb-3 col-md-2 fixed">
    <label for="inputEmail4" class="form-label">MRP for  90 days</label>
    <input type="text" class="form-control" name="mrp_two" value="{{old('mrp_two',$test->mrp_two)}}" placeholder="Mrp for 90 days">
    @error('mrp_two') <small class="text-danger">{{ $message }}</small> @enderror
   </div>
   <div class="mb-3 col-md-2 fixed">
    <label for="inputEmail4" class="form-label">Price for  90 days</label>
    <input type="text" class="form-control" name="price_two" value="{{old('price_two',$test->price_two)}}" placeholder="Price for 90 days">
    @error('price_two') <small class="text-danger">{{ $message }}</small> @enderror
   </div>
   <div class="mb-3 col-md-2 fixed">
    <label for="inputEmail4" class="form-label">Discount for  90 days</label>
    <input type="text" class="form-control" name="discount_two" value="{{old('discount_two',$test->discount_two)}}" placeholder="Discount for 90 days">
    @error('discount_two') <small class="text-danger">{{ $message }}</small> @enderror
   </div>


   <div class="mb-3 col-md-2 fixed">
    <label for="inputEmail4" class="form-label">MRP for  180 days</label>
    <input type="text" class="form-control" name="mrp_three" value="{{old('mrp_three',$test->mrp_three)}}" placeholder="Mrp for 180 days" >
    @error('mrp_three') <small class="text-danger">{{ $message }}</small> @enderror
   </div>

   <div class="mb-3 col-md-2 fixed">
    <label for="inputEmail4" class="form-label">Price for  180 days</label>
    <input type="text" class="form-control" name="price_three" value="{{old('price_three',$test->price_three)}}" placeholder="Price for 180 days" >
    @error('price_three') <small class="text-danger">{{ $message }}</small> @enderror
   </div>

   <div class="mb-3 col-md-2 fixed">
    <label for="inputEmail4" class="form-label">Discount for  180 days</label>
    <input type="text" class="form-control" name="discount_three" value="{{old('discount_three',$test->discount_three)}}" placeholder="Discount for 180 days" >
    @error('discount_three') <small class="text-danger">{{ $message }}</small> @enderror
   </div>


   <div class="mb-3 col-md-2 fixed">
    <label for="inputEmail4" class="form-label">MRP for  270 days</label>
    <input type="text" class="form-control" name="mrp_four" value="{{old('mrp_four',$test->mrp_four)}}" placeholder="Mrp for 270 days" >
    @error('mrp_four') <small class="text-danger">{{ $message }}</small> @enderror
   </div>

   <div class="mb-3 col-md-2 fixed">
    <label for="inputEmail4" class="form-label">Price for  270 days</label>
    <input type="text" class="form-control" name="price_four" value="{{old('price_four',$test->price_four)}}" placeholder="Price for 270 days" >
    @error('price_four') <small class="text-danger">{{ $message }}</small> @enderror
   </div>

   <div class="mb-3 col-md-2 fixed">
    <label for="inputEmail4" class="form-label">Discount for  270 days</label>
    <input type="text" class="form-control" name="discount_four" value="{{old('discount_four',$test->discount_four)}}" placeholder="Discount for 270 days" >
    @error('discount_four') <small class="text-danger">{{ $message }}</small> @enderror
   </div>

   <div class="mb-3 col-md-2 fixed">
    <label for="inputEmail4" class="form-label">MRP for  360 days</label>
    <input type="text" class="form-control" name="mrp_five" value="{{old('mrp_five',$test->mrp_five)}}" placeholder="Price for 360 days">
    @error('mrp_five') <small class="text-danger">{{ $message }}</small> @enderror
   </div>

   <div class="mb-3 col-md-2 fixed">
    <label for="inputEmail4" class="form-label">Price for  360 days</label>
    <input type="text" class="form-control" name="price_five" value="{{old('price_five',$test->price_five)}}" placeholder="Price for 360 days">
    @error('price_five') <small class="text-danger">{{ $message }}</small> @enderror
   </div>

   <div class="mb-3 col-md-2 fixed">
    <label for="inputEmail4" class="form-label">Discount for  360 days</label>
    <input type="text" class="form-control" name="discount_five" value="{{old('discount_five',$test->discount_five)}}" placeholder="Discount for 360 days">
    @error('discount_five') <small class="text-danger">{{ $message }}</small> @enderror
   </div>



                                                      <div class="mb-3 col-md-6">
                                                    <label for="inputPassword4" class="form-label">Is_Active</label>
                                                    <select class="form-control" name="is_active" required>
                                                        <option value="1" {{$test->is_active ==1 ? 'selected':''}}>Yes</option>
                                                        <option value="0" {{$test->is_active ==0 ? 'selected':''}}>No</option>
                                                    </select>
                                                    @error('is_active') <small class="text-danger">{{ $message }}</small> @enderror

                                                </div>


                                                <div class="mb-3 col-md-6">
                                                    <label for="inputPassword4" class="form-label">Paid</label>
                                                    <select class="form-control" name="paid" required>
                                                        <option value="1" {{$test->paid ==1 ? 'selected':''}}>Yes</option>
                                                        <option value="0" {{$test->paid ==1 ? 'selected':''}}>No</option>
                                                    </select>
                                                    @error('free') <small class="text-danger">{{ $message }}</small> @enderror

                                                </div>

                                                <div class="mb-3 col-md-6">
                                                    <label for="inputPassword4" class="form-label">Coin Deduction Percentage</label>
                                                    <input type="text" class="form-control" name="coin_percentage" value="{{old('percentage',$test->coin_percentage)}}" placeholder="Coin Deduction Percentage" >

                                                    @error('coin_percentage') <small class="text-danger">{{ $message }}</small> @enderror

                                                </div>

                                                <div class="mb-3 col-md-12">
    <label for="inputEmail4" class="form-label">Description</label>
    <textarea type="text" class="form-control ckeditor" name="description" value="{{old('mrp_five')}}">{{$test->description}}</textarea>
    @error('description') <small class="text-danger">{{ $message }}</small> @enderror
   </div>

</div>


                                               
<button type="submit" class="btn btn-primary">Update</button>

                                            </div>

                                           

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
$("#extend").on('change',function(){
  
    if($(this).val() === 'custom'){
$(".custom").show();
$(".fixed").hide();
    }else{
        $(".custom").hide();
        $(".fixed").show();
    }
})

   if($("#extend").val() === 'custom'){
       console.log('test')
$(".custom").show();
$(".fixed").hide();
    }else{
        $(".custom").hide();
        $(".fixed").show();
    }
        </script>

       
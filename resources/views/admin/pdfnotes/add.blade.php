
       
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
                                       

                                        <form method="post" action="{{route('pdfnotes.store')}}" enctype="multipart/form-data">
                                            @csrf

                                            <div class="form-check">
  <input class="form-check-input" type="checkbox" id="check1" name="genral_package" value="yes" >
  <label class="form-check-label">General Package</label>
</div>
                                            <div class="row g-2 mt-2">
                                                <div class="mb-3 col-md-6">
                                                    <label for="inputEmail4" class="form-label">Title</label>
                                                    <input type="text" class="form-control" name="title" value="{{old('title')}}" placeholder="Title" required>
                                                    @error('title') <small class="text-danger">{{ $message }}</small> @enderror

                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="inputPassword4" class="form-label">Start Date</label>
                                                    <input type="date" class="form-control" name="start_date" value="{{old('start_date')}}" placeholder="Meta Key" required>
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
                <option value="days">Days</option>
                <option value="months">Months</option>
                <option value="years">Years</option>
            </select>
        </div>
        @error('validity_value') <small class="text-danger">{{ $message }}</small> @enderror
        @error('validity_unit') <small class="text-danger">{{ $message }}</small> @enderror
    </div>


    <div class="mb-3 col-md-6">
    <label class="form-label">Select Courses</label>
    <select class="form-control select2" name="courses[]" multiple="multiple" required>
        @foreach($courses as $course)
            <option value="{{ $course->id }}"
                {{ (is_array(old('courses')) && in_array($course->id, old('courses'))) ? 'selected' : '' }}>
                {{ $course->title }}
            </option>
        @endforeach
    </select>
    @error('batches') 
        <small class="text-danger">{{ $message }}</small> 
    @enderror
</div>

    <div class="mb-3 col-md-6">
    <label for="inputEmail4" class="form-label">Extend Type</label>
          <select name="extend_type" class="form-select"  id="extend">
          <option value="fixed">Fixed</option>
                <option value="custom">Custom</option>
              
            </select>
    @error('extend') <small class="text-danger">{{ $message }}</small> @enderror
   </div>

    <div class="mb-3 col-md-6 custom" style="display:none">
    <label for="inputEmail4" class="form-label">MRP</label>
    <input type="text" class="form-control" name="mrp" value="{{old('mrp')}}" placeholder="MRP">
    @error('mrp') <small class="text-danger">{{ $message }}</small> @enderror
   </div>

   <div class="mb-3 col-md-6 custom" style="display:none">
    <label for="inputEmail4" class="form-label">Price</label>
    <input type="text" class="form-control" name="price" value="{{old('price')}}" placeholder="Price">
    @error('price') <small class="text-danger">{{ $message }}</small> @enderror
   </div>

   

   <div class="mb-3 col-md-2 fixed">
    <label for="inputEmail4" class="form-label">MRP for  30 days</label>
    <input type="text" class="form-control" name="mrp_one" value="{{old('mrp_one')}}" placeholder="Mrp for 30 days">
    @error('mrp_one') <small class="text-danger">{{ $message }}</small> @enderror
   </div>

   <div class="mb-3 col-md-2 fixed">
    <label for="inputEmail4" class="form-label">Price for  30 days</label>
    <input type="text" class="form-control" name="price_one" value="{{old('price_one')}}" placeholder="Price for 30 days">
    @error('price_one') <small class="text-danger">{{ $message }}</small> @enderror
   </div>

   <div class="mb-3 col-md-2 fixed">
    <label for="inputEmail4" class="form-label">Discount for  30 days</label>
    <input type="text" class="form-control" name="discount_one" value="{{old('discount_one')}}" placeholder="Discount for 30 days">
    @error('discount_one') <small class="text-danger">{{ $message }}</small> @enderror
   </div>

   


   <div class="mb-3 col-md-2 fixed">
    <label for="inputEmail4" class="form-label">MRP for  90 days</label>
    <input type="text" class="form-control" name="mrp_two" value="{{old('mrp_two')}}" placeholder="Mrp for 90 days">
    @error('mrp_two') <small class="text-danger">{{ $message }}</small> @enderror
   </div>
   <div class="mb-3 col-md-2 fixed">
    <label for="inputEmail4" class="form-label">Price for  90 days</label>
    <input type="text" class="form-control" name="price_two" value="{{old('price_two')}}" placeholder="Price for 90 days">
    @error('price_two') <small class="text-danger">{{ $message }}</small> @enderror
   </div>
   <div class="mb-3 col-md-2 fixed">
    <label for="inputEmail4" class="form-label">Discount for  90 days</label>
    <input type="text" class="form-control" name="discount_two" value="{{old('discount_two')}}" placeholder="Discount for 90 days">
    @error('discount_two') <small class="text-danger">{{ $message }}</small> @enderror
   </div>


   <div class="mb-3 col-md-2 fixed">
    <label for="inputEmail4" class="form-label">MRP for  180 days</label>
    <input type="text" class="form-control" name="mrp_three" value="{{old('mrp_three')}}" placeholder="Mrp for 180 days" >
    @error('mrp_three') <small class="text-danger">{{ $message }}</small> @enderror
   </div>

   <div class="mb-3 col-md-2 fixed">
    <label for="inputEmail4" class="form-label">Price for  180 days</label>
    <input type="text" class="form-control" name="price_three" value="{{old('price_three')}}" placeholder="Price for 180 days" >
    @error('price_three') <small class="text-danger">{{ $message }}</small> @enderror
   </div>

   <div class="mb-3 col-md-2 fixed">
    <label for="inputEmail4" class="form-label">Discount for  180 days</label>
    <input type="text" class="form-control" name="discount_three" value="{{old('discount_three')}}" placeholder="Discount for 180 days" >
    @error('discount_three') <small class="text-danger">{{ $message }}</small> @enderror
   </div>


   <div class="mb-3 col-md-2 fixed">
    <label for="inputEmail4" class="form-label">MRP for  270 days</label>
    <input type="text" class="form-control" name="mrp_four" value="{{old('mrp_four')}}" placeholder="Mrp for 270 days" >
    @error('mrp_four') <small class="text-danger">{{ $message }}</small> @enderror
   </div>

   <div class="mb-3 col-md-2 fixed">
    <label for="inputEmail4" class="form-label">Price for  270 days</label>
    <input type="text" class="form-control" name="price_four" value="{{old('price_four')}}" placeholder="Price for 270 days" >
    @error('price_four') <small class="text-danger">{{ $message }}</small> @enderror
   </div>

   <div class="mb-3 col-md-2 fixed">
    <label for="inputEmail4" class="form-label">Discount for  270 days</label>
    <input type="text" class="form-control" name="discount_four" value="{{old('discount_four')}}" placeholder="Discount for 270 days" >
    @error('discount_four') <small class="text-danger">{{ $message }}</small> @enderror
   </div>

   <div class="mb-3 col-md-2 fixed">
    <label for="inputEmail4" class="form-label">MRP for  360 days</label>
    <input type="text" class="form-control" name="mrp_five" value="{{old('mrp_five')}}" placeholder="Price for 360 days">
    @error('mrp_five') <small class="text-danger">{{ $message }}</small> @enderror
   </div>

   <div class="mb-3 col-md-2 fixed">
    <label for="inputEmail4" class="form-label">Price for  360 days</label>
    <input type="text" class="form-control" name="price_five" value="{{old('price_five')}}" placeholder="Price for 360 days">
    @error('price_five') <small class="text-danger">{{ $message }}</small> @enderror
   </div>

   <div class="mb-3 col-md-2 fixed">
    <label for="inputEmail4" class="form-label">Discount for  360 days</label>
    <input type="text" class="form-control" name="discount_five" value="{{old('discount_five')}}" placeholder="Discount for 360 days">
    @error('discount_five') <small class="text-danger">{{ $message }}</small> @enderror
   </div>



                                                      <div class="mb-3 col-md-6">
                                                    <label for="inputPassword4" class="form-label">Is_Active</label>
                                                    <select class="form-control" name="is_active" required>
                                                        <option value="1">Yes</option>
                                                        <option value="0">No</option>
                                                    </select>
                                                    @error('is_active') <small class="text-danger">{{ $message }}</small> @enderror

                                                </div>


                                                <div class="mb-3 col-md-6">
                                                    <label for="inputPassword4" class="form-label">Paid</label>
                                                    <select class="form-control" name="paid" required>
                                                        <option value="1">Yes</option>
                                                        <option value="0">No</option>
                                                    </select>
                                                    @error('free') <small class="text-danger">{{ $message }}</small> @enderror

                                                </div>

                                                <div class="mb-3 col-md-6">
                                                    <label for="inputPassword4" class="form-label">Coin Deduction Percentage</label>
                                                    <input type="text" class="form-control" name="coin_percentage" value="{{old('percentage',0)}}" placeholder="Coin Deduction Percentage" >

                                                    @error('coin_percentage') <small class="text-danger">{{ $message }}</small> @enderror

                                                </div>

                                                <div class="mb-3 col-md-12">
    <label for="inputEmail4" class="form-label">Description</label>
    <textarea type="text" class="form-control ckeditor" name="description" value="{{old('mrp_five')}}"></textarea>
    @error('description') <small class="text-danger">{{ $message }}</small> @enderror
   </div>

</div>


                                               
<button type="submit" class="btn btn-primary">Add</button>

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
    console.log($(this).val())
    if($(this).val() === 'custom'){
$(".custom").show();
$(".fixed").hide();
    }else{
        $(".custom").hide();
        $(".fixed").show();
    }
})

        </script>

       
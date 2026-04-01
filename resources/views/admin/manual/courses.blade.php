@include('admin.layouts.header')

        <!-- Begin page -->
        <div class="wrapper">

            
            <!-- ========== Topbar Start ========== -->
            @include('admin.layouts.topbar')

            <!-- ========== Topbar End ========== -->

            @include('admin.layouts.sidebar')
  
      <!-- CONTENT -->
      <div class="content-page">
          <div class="content">
              <!-- Start Content-->
              <div class="container-fluid">
                  <!-- get table -->
                  <div class="row">
                      <div class="col-12">
                          <div class="card">
                              <div class="card-body">
  

                                  <div class="table-responsive">
                                      <table class="table mb-0">
                                         

<!-- CONTENT -->
<div class="container pb-5">

  <h3 class="fw-800 mb-4">
    List of <span style="color:#ff6a00">Courses</span>
  </h3>

  <div class="row g-4">

                @if(isset($courses) && $courses!='')
                @foreach($courses as $course)
    <!-- CARD 1 -->
    <div class="col-lg-3 col-md-4 col-sm-6">
      <div class="course-card bg-white p-3 shadow-sm h-100">
        <img src="{{asset($course->thumbnail??'frontend/img/logo.png')}}" class="course-thumb mb-3" width="300"> 
        <h6 class="fw-bold mb-1">{{$course->title}}</h6>
        <a href="{{url('admin/cources_type/'.$course->id)}}" class="btn btn-orange w-100 rounded-pill fw-bold">
          Continue / जारी रखें
        </a>
      </div>
    </div>
@endforeach
@endif 
  </div>
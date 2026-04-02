@extends('layouts.master')
@section('content')
   <!-- NAVBAR -->
<nav class="navbar bg-white shadow-sm py-3 mb-4">
  <div class="container d-flex justify-content-between align-items-center">
     <a href="{{ route('home') }}" class="text-decoration-none text-orange fw-bold">
      <i class="bi bi-arrow-left"></i> Back
    </a>
    <h4 class="fw-800 mb-0">My Classes</h4>
  </div>
</nav>

<!-- CONTENT -->
<div class="container pb-5">

  <h3 class="fw-800 mb-4">
    List of <span style="color:#ff6a00">Courses</span>
  </h3>

  <div class="row g-4">

                @if(isset($Courses) && $Courses!='')
                @foreach($Courses as $course)
    <!-- CARD 1 -->
    <div class="col-lg-3 col-md-4 col-sm-6">
      <div class="course-card bg-white p-3 shadow-sm h-100">
        <img src="{{$course->thumbnail??'frontend/images/course_thumb1.png'}}" class="course-thumb mb-3">
        <h6 class="fw-bold mb-1">{{$course->title}}</h6>

        <small class="text-muted d-block mb-3">Full syllabus batch</small>
        <!-- Description -->
            <div class="course-desc flex-grow-1">
                
                <div class="short-desc">
                    {!! Str::limit(strip_tags($course->description), 150) !!}
                </div>

                <div class="full-desc d-none">
                    {!! $course->description !!}
                </div>

                <a href="javascript:void(0)" 
                   class="toggle-btn text-primary">
                   Read More
                </a>

            </div>
        <a href="{{url('/cources_type/'.$course->id)}}" class="btn btn-orange w-100 rounded-pill fw-bold">
          Continue / जारी रखें
        </a>
      </div>
    </div>
@endforeach
@endif
@endsection    
@extends('layouts.master')
@section('content')
<nav class="navbar bg-white shadow-sm sticky-top">
  <div class="container d-flex justify-content-between align-items-center">
    <a href="batch-details.html" class="text-decoration-none fw-bold text-primary">
      <i class="bi bi-arrow-left"></i> Back
    </a>
    <span class="fw-bold">All Magazines</span>
    <div style="width:40px"></div>
  </div>
</nav>
<div class="container mt-4">

  <h5 class="fw-bold mb-3">Available Magazines</h5>
@if(isset($tests))
@foreach($tests as $cont)
<!-- Note Card -->
<div class="card border-0 shadow-sm mb-3" style="border-radius:16px;">
    <div class="card-body d-flex justify-content-between align-items-center">

        <div class="d-flex align-items-center gap-3">
            <div class="bg-danger bg-opacity-10 ">
<img src="{{ asset($cont->thumbnail ?? 'images/logo.png') }}" alt="{{ $cont->thumbnail }}" width="100" />            </div>

            <div>
                <h6 class="fw-bold mb-0">{{$cont->title}}</h6>
                <small class="text-muted">Part 1 – Fundamental Rights</small>
                 <!-- Description -->
            <div class="course-desc flex-grow-1">
                
                <div class="short-desc">
                    {!! Str::limit(strip_tags($cont->description), 150) !!}
                </div>

                <div class="full-desc d-none">
                    {!! $cont->description !!}
                </div>

                <a href="javascript:void(0)" 
                   class="toggle-btn text-primary">
                   Read More
                </a>

            </div>
            </div>
        </div>
        @if($cont->paid)
        <a href="{{url('/purchase/notes/'.$cont->id)}}" class="btn btn-dark rounded-pill px-4 "> Read </a>  
    @else
    @if(isset($cont->pdf_file))
        <a href="{{asset($cont->pdf_file)}}" class="btn btn-success rounded-pill px-4">
            Read
        </a>
        @else
        <a href="{{url('/magazine_show/'.$cont->id)}}" class="btn btn-success rounded-pill px-4"> Read </a>  
    @endif
    
    @endif
    </div>
   
</div>
@endforeach
@endif
</div>
<!-- Footer Start -->
@endsection
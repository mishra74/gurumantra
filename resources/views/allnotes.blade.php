@extends('layouts.master')
@section('content')
<!-- Services Start -->
<nav class="navbar bg-white shadow-sm sticky-top">
    <div class="container d-flex justify-content-between align-items-center">
        <a href="batch-details.html" class="text-decoration-none fw-bold text-primary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
        <span class="fw-bold">Notes Volume</span>
        <div style="width:40px"></div>
    </div>
</nav>

@if(isset($tests))
@foreach($tests as $cont)
<!-- Note Card -->
<div class="card border-0 shadow-sm mb-3" style="border-radius:16px;">
    <div class="card-body d-flex justify-content-between align-items-center">

        <div class="d-flex align-items-center gap-3">
            <div class="bg-danger bg-opacity-10 p-3 rounded-circle">
                <i class="bi bi-file-earmark-pdf text-danger fs-3"></i>
            </div>

            <div>
                <h6 class="fw-bold mb-0">{{$cont->title}}</h6>
                <small class="text-muted">Part 1 – Fundamental Rights</small>
            </div>
        </div>
        @if($hasPurchased)
@if(isset($cont->pdf_file))
        <a href="{{asset($cont->pdf_file)}}" class="btn btn-dark rounded-pill px-4">
            Read
        </a>
        @else
        <a href="{{url('/noteshow/'.$cont->id)}}" class="btn btn-dark rounded-pill px-4 "> Read </a>  
    @endif
    </div>
    @else
        <a href="{{url('/purchase/notes/'.$cont->id)}}" class="btn btn-dark rounded-pill px-4 "> Locked </a>  

    @endif

</div>
@endforeach
@endif
</div>
<!-- Footer Start -->
@endsection
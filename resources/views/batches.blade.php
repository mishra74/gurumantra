@extends('layouts.master')
@section('content')
<nav class="navbar navbar-light bg-white shadow-sm sticky-top">
    <div class="container d-flex justify-content-between align-items-center">
        <a href="batch-details.html" class="text-decoration-none text-orange fw-bold">
            <i class="bi bi-arrow-left"></i> Back
        </a>
        <span class="fw-bold">Batches</span>
        <div style="width: 40px;"></div>
    </div>
</nav>
<!-- Services Start -->
<div class="container mt-4">
    <h5 class="fw-bold mb-3 text-secondary">List of Test Series</h5>


    @if(isset($batches) && $batches!='')
    @foreach($batches as $batche)
    <div class="card p-3 module-card shadow-sm border-0 mb-3 d-flex flex-row justify-content-between align-items-center bg-white"
        style="border-radius: 15px;">

        <div class="d-flex align-items-center">
            <img src="{{asset($batche->thumbnail??'frontend/images/icons/test.png')}}" width="45" class="me-3" alt="">
            <div>
                <h6 class="fw-bold mb-0">{{$batche->title}}</h6>
            </div>
        </div>
        <a href="{{ route('batches.valume', $batche->id) }}" class="btn btn-orange btn-sm rounded-pill px-3">Continue / जारी रखें</a>
    </div>

@endforeach
@endif
</div>
@endsection
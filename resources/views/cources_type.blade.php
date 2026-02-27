@extends('layouts.master')
@section('content')
        <nav class="navbar navbar-light bg-white shadow-sm py-3 mb-5 sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-orange" href="online.html">
                <i class="bi bi-arrow-left"></i> Back
            </a>
            <h4 class="fw-800 mb-0">Course Content</h4>
        </div>
    </nav>

    <div class="container pb-5">
        <div class="row g-4">
            
            <div class="col-md-6 col-lg-3">
                <div class="test-card p-3 shadow-sm bg-white text-center h-100 rounded-4">
                    <img src="{{asset('frontend/images/icons/batch.png')}}" class="img-fluid rounded-3 mb-3" style="height: 100px; object-fit: contain;" alt="Batch">
                    <h6 class="fw-bold mb-3">Batches</h6>
                    <a href="{{route('batches.series')}}" class="btn btn-orange w-100 rounded-pill fw-bold py-2 small">Continue / जारी रखें</a>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="test-card p-3 shadow-sm bg-white text-center h-100 rounded-4">
                    <img src="{{asset('frontend/images/icons/test-vol.png')}}" class="img-fluid rounded-3 mb-3" style="height: 100px; object-fit: contain;" alt="Test Volume">
                    <h6 class="fw-bold mb-3">Test Volume</h6>
                    <a href="{{route('test.series')}}" class="btn btn-orange w-100 rounded-pill fw-bold py-2 small">Continue / जारी रखें</a>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="test-card p-3 shadow-sm bg-white text-center h-100 rounded-4">
                    <img src="{{asset('frontend/images/icons/library.png')}}" class="img-fluid rounded-3 mb-3" style="height: 100px; object-fit: contain;" alt="e-Library">
                    <h6 class="fw-bold mb-3">e-Library</h6>
                    <a href="{{route('notes.series')}}" class="btn btn-orange w-100 rounded-pill fw-bold py-2 small">Continue / जारी रखें</a>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="test-card p-3 shadow-sm bg-white text-center h-100 rounded-4">
                    <img src="{{asset('frontend/images/icons/store.png')}}" class="img-fluid rounded-3 mb-3" style="height: 100px; object-fit: contain;" alt="Knowledge Store">
                    <h6 class="fw-bold mb-3">Knowledge Store</h6>
                    <a href="#" class="btn btn-orange w-100 rounded-pill fw-bold py-2 small">Continue / जारी रखें</a>
                </div>
            </div>

        </div>
    </div>
 @endsection

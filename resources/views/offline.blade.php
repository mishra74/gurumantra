@extends('layouts.master')
@section('content')
    <div class="container vh-100 d-flex align-items-center justify-content-center text-center">
        <div class="premium-card p-5 shadow-lg" style="max-width: 600px; border-radius: 40px;">
            <h2 class="fw-800 text-orange mb-4">Offline Course</h2>
            <hr>
            <h4 class="fw-bold mb-3 mt-4">Coming Soon online Registration for Offline Class.</h4>
            <div class="bg-orange-soft p-4 rounded-4 mt-4">
                <p class="text-muted mb-1 fw-bold">Now Contact Us</p>
                <h2 class="fw-800 text-dark">6200013102</h2>
            </div>
            <a href="{{ route('home') }}" class="btn btn-dark mt-5 rounded-pill px-5 py-2 fw-bold">Back to Home</a>
        </div>
    </div>
    @endsection
@extends('layouts.master')
@section('content')
<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top py-2 shadow-sm">
      <div class="container">
         <a href="{{url('/student/category')}}" class="text-decoration-none text-orange fw-bold">
      <i class="bi bi-arrow-left"></i> Back
    </a>
      </div>
    </nav>

    <section class="container my-5">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
          <h3 class="fw-extrabold mb-0">Study <span class="text-orange">Material</span></h3>
          <p class="text-muted small">Select your preferred content to read or download</p>
        </div>
        <button class="btn btn-outline-dark rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#filterModal">
          <i class="bi bi-filter-right fs-5"></i> Filter
        </button>
      </div>

      <div class="row g-3">
              @foreach($allContent as $content)

        <div class="col-12">
          <div class="p-4 bg-white rounded-4 shadow-sm border-start border-success border-5 d-flex flex-md-row flex-column justify-content-between align-items-md-center">
            <div class="mb-3 mb-md-0">
              <span class="badge bg-success-soft text-success mb-1">FREE CONTENT</span>
              <h5 class="fw-bold mb-1">{{$content->title}} - {{$content->created_at}}</h5>
              <p class="text-muted small mb-0"><i class="bi bi-file-pdf me-1"></i> PDF Document </p>
            </div>
            <a href="{{asset($content->pdf)}}" target="_blank" class="btn btn-orange px-4 py-2 rounded-pill fw-bold">OPEN PDF →</a>
@if(!empty($content->content))
                                   
                                                   <a href="{{url('student/read_content/'.$content->id)}}" target="_blank" class="btn btn-orange px-4 py-2 rounded-pill fw-bold">OPEN Content →</a>

                                         
                                    
                                @endif
          </div>
        </div>
@endforeach
      
      </div>
    </section>

    <div class="modal fade" id="filterModal" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4">
          <div class="modal-header border-0">
            <h5 class="fw-bold">Filter By Category</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label fw-bold small">Month</label>
              <select class="form-select rounded-3">
                <option>February 2026</option>
                <option>January 2026</option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label fw-bold small">Language</label>
              <div class="d-flex gap-2">
                <input type="checkbox" class="btn-check" id="lang1" checked>
                <label class="btn btn-outline-orange btn-sm rounded-pill" for="lang1">Hindi</label>
                <input type="checkbox" class="btn-check" id="lang2">
                <label class="btn btn-outline-orange btn-sm rounded-pill" for="lang2">English</label>
              </div>
            </div>
            <button class="btn btn-orange w-100 rounded-pill py-2 mt-3 fw-bold">APPLY FILTERS</button>
          </div>
        </div>
      </div>
    </div>
    @endsection
@extends('layouts.master')
@section('content')
<!-- ===== TITLE ===== -->
<section class="container text-center ca-title">
  <h2>
    Current <span class="text-orange">Affairs</span>
  </h2>
  <p>
    Daily current affairs, mock tests, editorials & magazines  
    designed for UPSC & State PCS aspirants
  </p>
</section>

<!-- ===== CONTENT ===== -->
<section class="container pb-5">
  <div class="row g-4 justify-content-center">

    <!-- Daily CA -->
    <div class="col-md-3 col-sm-6">
      <a href="{{url('/student/day_type/1/1')}}" class="text-decoration-none">
        <div class="ca-card">
          <i class="bi bi-calendar-check"></i>
          <h6>Daily Current Affairs</h6>
        </div>
      </a>
    </div>

    <!-- Mock Test -->
    <div class="col-md-6">
      <a href="ca-content-list.html" class="text-decoration-none">
        <div class="ca-card ca-card-highlight">
          <div>
            <h5>Daily Mock Test</h5>
            <p>Practice questions with exam-level difficulty</p>
          </div>
          <i class="bi bi-arrow-right"></i>
        </div>
      </a>
    </div>

    <!-- Editorial -->
    <div class="col-md-3 col-sm-6">
      <a href="ca-content-list.html" class="text-decoration-none">
        <div class="ca-card">
          <i class="bi bi-journal-text"></i>
          <h6>Editorial</h6>
        </div>
      </a>
    </div>

    <!-- Magazine -->
    <div class="col-md-3 col-sm-6">
      <a href="ca-content-list.html" class="text-decoration-none">
        <div class="ca-card">
          <i class="bi bi-book"></i>
          <h6>Magazine</h6>
        </div>
      </a>
    </div>

  </div>
</section>
@endsection
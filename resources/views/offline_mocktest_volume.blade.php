@extends('layouts.master')
@section('content')
<nav class="navbar navbar-light bg-white shadow-sm sticky-top">
    <div class="container d-flex justify-content-between align-items-center">
        <a href="batch-details.html" class="text-decoration-none text-orange fw-bold">
            <i class="bi bi-arrow-left"></i> Back
        </a>
        <span class="fw-bold">Offline Mock Test Volume</span>
        <div style="width: 40px;"></div>
    </div>
</nav>
<!-- Services Start -->
<div class="container mt-4">
    <h5 class="fw-bold mb-3 text-secondary">List of Mock Test Series</h5>


    @if(isset($MockTestVolumes) && $MockTestVolumes!='')
    @foreach($MockTestVolumes as $test)
    <div class="card p-3 module-card shadow-sm border-0 mb-3 d-flex flex-row justify-content-between align-items-center bg-white"
        style="border-radius: 15px;">

        <div class="d-flex align-items-center">
            <img src="{{asset($test->thumbnail??'frontend/images/icons/test.png')}}" width="200" class="me-3" alt="">
            <div>
                <h6 class="fw-bold mb-0">{{$test->title}}</h6>
                <small class="text-muted">Total {{ optional($test->centerPrices->first())->total_seat }} Seats</small>
                 <!-- Description -->
          <p class="course-desc">
            <span class="short-desc">
              {{ \Illuminate\Support\Str::words(strip_tags($test->description), 20) }}
            </span>

            <span class="full-desc d-none">
              {{ strip_tags($test->description) }}
            </span>

            <a href="javascript:void(0)" class="read-more text-primary">... Read More</a>
          </p>
            </div>
        </div>
        <a href="{{ route('offline.mocktest', $test->id) }}" class="btn btn-orange btn-sm rounded-pill px-3">Continue / जारी रखें</a>
    </div>

@endforeach
@endif
</div>
@endsection
<script>
document.addEventListener("DOMContentLoaded", function () {

  document.querySelectorAll(".read-more").forEach(function(button){

      button.addEventListener("click", function(){

          let parent = this.closest(".course-desc");
          let shortText = parent.querySelector(".short-desc");
          let fullText = parent.querySelector(".full-desc");

          if(fullText.classList.contains("d-none")){
              shortText.classList.add("d-none");
              fullText.classList.remove("d-none");
              this.innerText = " Read Less";
          }else{
              shortText.classList.remove("d-none");
              fullText.classList.add("d-none");
              this.innerText = "... Read More";
          }

      });

  });

});
</script>
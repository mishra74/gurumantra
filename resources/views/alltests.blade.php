@extends('layouts.master')
@section('content')
        <div class="container mt-4">

  <h5 class="fw-bold mb-3">List of Test Sets</h5>

                

                @if(isset($tests) && $tests!='')
                @foreach($tests as $test)
                   <!-- Test Set Card -->
  <div class="card border-0 shadow-sm mb-3" style="border-radius:16px;">
    <div class="card-body">

      <div class="d-flex align-items-center gap-3">
        <!-- Thumbnail -->
        <img src="{{ asset($test->thumbnail ?? 'frontend/images/icons/test.png') }}" alt="Test Thumbnail"
             style="width:70px;height:70px;border-radius:12px;object-fit:cover;">

        <!-- Name -->
        <div class="flex-grow-1">
          <h6 class="fw-bold mb-1">{{ $test->title }}</h6>
          <small class="text-muted">{{ $test->questions_count }} Questions</small>
        </div>
        <!-- Description -->
            <div class="course-desc flex-grow-1">
                
                <div class="short-desc">
                    {!! Str::limit(strip_tags($test->description), 150) !!}
                </div>

                <div class="full-desc d-none">
                    {!! $test->description !!}
                </div>

                <a href="javascript:void(0)" 
                   class="toggle-btn text-primary">
                   Read More
                </a>

            </div>
      </div>
@if($test->live_class===1)
      <!-- Buttons -->
      <div class="d-flex gap-2 mt-3">
        <button class="btn btn-danger w-100" onclick="window.location.href='{{route('live.index',$test->id)}}'">
          Live
        </button>

        <button class="btn btn-success w-100" onclick="window.location.href='{{route('practise.index',$test->id)}}'">
          Practice
        </button>
@endif
        <button class="btn btn-primary w-100"
          onclick="window.location.href='#'">
          PDF Test
        </button>
      </div>

    </div>
  </div>
                    @endforeach
                    @endif
                    
         
</div>

<!-- Language Modal -->
<div class="modal fade" id="langModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow" style="border-radius:16px;">
      <div class="modal-body text-center p-4">
        <h6 class="fw-bold mb-3">Choose Language</h6>
        <button class="btn btn-outline-primary w-100 mb-2"
          onclick="goNext('hindi')">Hindi</button>
        <button class="btn btn-outline-primary w-100"
          onclick="goNext('english')">English</button>
      </div>
    </div>
  </div>
</div>
<script>
let mode = "";

function setMode(type) {
  mode = type;
}

function goNext(language) {
  if (mode === "live") {
    window.location.href = "live-test.html?lang=" + language;
  }
  if (mode === "practice") {
    window.location.href = "practice-test.html?lang=" + language;
  }
}
</script>
        <!-- Footer Start -->
 @endsection

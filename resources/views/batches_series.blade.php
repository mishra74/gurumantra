
    @extends('layouts.master')
    @section('content')
    <nav class="navbar navbar-light bg-white shadow-sm sticky-top">
  <div class="container d-flex justify-content-between align-items-center">
    <a href="batch-details.html" class="text-decoration-none text-orange fw-bold">
      <i class="bi bi-arrow-left"></i> Back
    </a>
    <span class="fw-bold">Batch Classes</span>
    <div style="width: 40px;"></div>
  </div>
</nav>

       
<div class="container mt-3">
@if(isset($classes) && $classes!='')
                @foreach($classes as $class)
  <!-- CARD 1 -->
  <div class="card p-4 shadow-sm border-0 mb-3" style="border-radius:15px;">
    <div class="d-flex gap-3 align-items-center">

      <img src="{{asset('frontend/images/course-bg.png')}}" style="width:80px;height:80px;border-radius:10px;object-fit:cover;">

      <div class="flex-grow-1">
        <h6 class="fw-bold mb-1">{{$class->title}}</h6>
        <p class="small text-muted mb-2">Topic: {{$class->topic}}</p>

        <div class="d-flex gap-2">
          <button class="btn btn-sm btn-orange rounded-pill px-3">
<a href="{{ route('zoom.join',11) }}" class="btn btn-primary">
Join Class
</a>          <button class="btn btn-sm btn-outline-dark rounded-pill px-3"><a href="{{route('previous.class',$class->id)}}" class="text-dark text-decoration-none">Previous Class</a></button>
        </div>
      </div>

      <div class="dropdown">
        <button class="btn btn-outline-secondary btn-sm rounded-pill px-3" data-bs-toggle="dropdown">
          More
        </button>
        <ul class="dropdown-menu dropdown-menu-end shadow border-0">
          <li><a class="dropdown-item" href="#">About Class</a></li>
          <li><a class="dropdown-item" href="#">About Teacher</a></li>
          <li><a class="dropdown-item" href="test-volume.html">Test Series</a></li>
          <li><a class="dropdown-item" href="notes-volume.html">Notes</a></li>
        </ul>
      </div>

    </div>
  </div>

 @endforeach
                    @endif
                    



</div>

                
               

        <!-- Footer Start -->
 @endsection

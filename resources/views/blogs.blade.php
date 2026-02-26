@extends('layouts.master')
@section('content')
<!-- HEADER -->
<section class="container mb-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h2 class=" mb-1">Knowledge hub</h2>
      <p class="text-muted mb-0">Latest articles & preparation strategies</p>
    </div>

    <button class="btn btn-dark rounded-pill px-4" data-bs-toggle="offcanvas" data-bs-target="#blogFilter">
      <i class="bi bi-funnel-fill me-1"></i>Filter
    </button>
  </div>

  <div class="row g-4">
    <!-- BLOG CARD 1 -->
     @foreach($blogs as $blog)
    <div class="col-lg-4 col-md-6">
      <div class="blog-card">
        <img src="{{ asset($blog->thumbnail) }}" alt="Blog">
        <div class="p-4">
          <span class="blog-tag">{{ $blog->category->title }}</span>
          <h5>{{ $blog->title }}</h5>
          <p>{!! Str::limit($blog->contents, 100) !!}</p>
          <a href="{{ route('blog.show', $blog->id) }}" class="btn btn-outline-orange w-100 rounded-pill mt-3">Read Article →</a>
        </div>
      </div>
    </div>
@endforeach
  </div>
</section>

<!-- FILTER OFFCANVAS -->
<div class="offcanvas offcanvas-end" id="blogFilter">
  <div class="offcanvas-header border-bottom">
    <h5 class="fw-bold">Filter Blogs</h5>
    <button class="btn-close" data-bs-dismiss="offcanvas"></button>
  </div>

  <div class="offcanvas-body">
    <!-- CATEGORIES -->
    <h6 class="fw-bold text-orange mb-3">Categories</h6>
    <div class="list-group mb-4">
      <button class="list-group-item">UPSC Preparation</button>
      <button class="list-group-item">BPSC Special</button>
      <button class="list-group-item">Other Exams</button>
    </div>

    <!-- SUB CATEGORIES -->
    <h6 class="fw-bold text-orange mb-3">Sub Categories</h6>
    <div class="d-flex flex-wrap gap-2">
      <button class="badge sub-cat rounded-pill px-3 py-2">Syllabus</button>
      <button class="badge sub-cat rounded-pill px-3 py-2">Toppers Talk</button>
      <button class="badge sub-cat rounded-pill px-3 py-2">Editorial</button>
      <button class="badge sub-cat rounded-pill px-3 py-2">Strategy</button>
      <button class="badge sub-cat rounded-pill px-3 py-2">Study Tips</button>
    </div>
  </div>
</div>

@endsection




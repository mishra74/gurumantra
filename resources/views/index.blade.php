  @extends('layouts.master')

  @section('content')
  <!-- Slider -->
  <section id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
          <div class="carousel-item active">
              <img src="{{ asset('frontend/images/slider/slider1.png') }}" class="d-block w-100 hero-img"
                  alt="Slide 1" />
          </div>
          <div class="carousel-item">
              <img src="{{ asset('frontend/images/slider/slider2.png') }}" class="d-block w-100 hero-img"
                  alt="Slide 2" />
          </div>
          <div class="carousel-item">
              <img src="{{ asset('frontend/images/slider/slider3.png') }}" class="d-block w-100 hero-img"
                  alt="Slide 3" />
          </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon bg-dark-50 rounded-circle"></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon bg-dark-50 rounded-circle"></span>
      </button>
  </section>

  <section class="gm-marquee">
      <div class="container">
          <div class="marquee-wrapper">
              <div class="marquee-content">
                  <span>🔥 UPSC 2026 Test Series Launched</span>
                  <span>📢 Daily Current Affairs – Updated Every Morning</span>
                  <span>🎯 Answer Writing Practice with Expert Evaluation</span>
                  <span>🎓 Scholarship Program – Register Now</span>
                  <span>💰 Earn Coins & Unlock Premium Content Free</span>
              </div>
          </div>
      </div>
  </section>
  <section class="container my-5 py-5" data-aos="fade-up">
      <div class="premium-card p-5">
          <div class="row align-items-center g-4">

              <!-- LEFT : SHARE & EARN -->
              <div class="col-md-6">
                  <div class="coin-card h-100">
                      <img src="{{ asset('frontend/images/icons/referral.png') }}" alt="Referral"
                          class="coin-icon mb-3" />
                      <h5 class="fw-semibold mb-2">Share & Earn Referral Code</h5>
                      <p class="text-muted small mb-4">
                          {{isset(Auth::user()->referral_code) && Auth::user()->referral_code !=''? Auth::user()->referral_code : ''}}
                      </p>
                      @if(Auth::user())
                      <button class="btn btn-orange w-100 rounded-pill fw-semibold" data-bs-toggle="modal"
                          data-bs-target="#shareReferral">

                          <i class="bi bi-share-fill me-2"></i> Share Now
                      </button>
                      @else
                      <button class="btn btn-orange w-100 rounded-pill fw-semibold">
                          <a href="{{ route('login') }}" class="text-white text-decoration-none">
                              <i class="bi bi-share-fill me-2"></i> Share Now
                          </a>
                      </button>
                      @endif
                  </div>
              </div>

              <!-- RIGHT : TOTAL COINS -->
              <div class="col-md-6">
                  <div class="coin-card h-100 text-center">
                      <img src="{{ asset('frontend/images/icons/coins.png') }}" alt="Coins" class="coin-icon mb-3" />
                      <h5 class="fw-semibold mb-1">Total Coins</h5>
                      <h2 class="fw-bold text-orange mb-0">
                          {{isset(Auth::user()->coins) && Auth::user()->coins !=''? Auth::user()->coins : ''}}</h2>
                      <p class="text-muted small">Available Balance</p>
                  </div>
              </div>
          </div>
      </div>
  </section>

  <section class="container my-5" data-aos="fade-up">
      <div class="course-choice-card">
          <div class="row align-items-center g-4">

              <!-- LEFT IMAGE -->
              <div class="col-md-5">
                  <div class="course-image"></div>
              </div>

              <!-- RIGHT CONTENT -->
              <div class="col-md-7">
                  <h3 class="fw-bold mb-1">
                      <span class="text-orange">Choose Your Learning Mode</span>
                  </h3>
                  <p class="text-muted mb-4">
                      Learn with India’s top mentors through classroom or online programs,
                      designed specially for serious UPSC & State PCS aspirants.
                  </p>

                  <div class="d-flex gap-3 flex-wrap">
                      <a href="{{ route('offline.classes') }}"
                          class="btn btn-orange px-4 py-2 rounded-pill fw-semibold">
                          🏫 Offline Courses
                      </a>
                      <a href="{{ route('courses') }}"
                          class="btn btn-outline-orange px-4 py-2 rounded-pill fw-semibold">
                          💻 Online Courses
                      </a>
                  </div>
              </div>

          </div>
      </div>
  </section>

  <!-- Scholarship  -->
  <section class="container my-5" data-aos="fade-up">
      <div class="row g-4 align-items-stretch">
          <div class="col-lg-8">
              <div class="p-4 bg-white rounded-4 shadow-sm border-start border-orange border-5 h-100">
                  <div class="d-flex align-items-center mb-3">
                      <div class="bg-orange-soft p-2 rounded-3 me-3">
                          <i class="bi bi-mortarboard-fill text-orange fs-3"></i>
                      </div>
                      <div>
                          <h4 class="fw-bold mb-0">Scholarship Register</h4>
                          <p class="text-muted small mb-0">
                              Enter details to verify and join the program
                          </p>
                      </div>
                  </div>
                  <form class="row g-2">
                      <div class="col-md-8">
                          <input type="text" class="form-control form-control-lg rounded-pill border-2"
                              placeholder="Email or Mobile Number" />
                      </div>
                      <div class="col-md-3">
                          <button type="submit" class="btn btn-orange w-100 btn-lg rounded-pill">
                              Verify Now
                          </button>
                      </div>
                  </form>
              </div>
          </div>
          <div class="col-lg-4">
              <div
                  class="p-4 bg-dark rounded-4 shadow-sm h-100 d-flex flex-column justify-content-center align-items-center text-center">
                  <i class="bi bi-pencil-square text-orange mb-2" style="font-size: 1.5rem"></i>
                  <h5 class="text-white mb-2">Answer Writing</h5>
                  <a href="answer-writing.html" class="btn btn-outline-orange w-75 rounded-pill py-2 fw-bold">
                      Start writing →
                  </a>
              </div>
          </div>
      </div>
  </section>

  <!-- Slider ads -->
  <section class="container my-5" data-aos="zoom-in">
      <div id="adSlider" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
              <div class="carousel-item active">
                  <div class="row g-4">
                      <div class="col-md-6 col-12">
                          <img src="{{ asset('frontend/images/ads/ad1.png') }}" class="ad-img shadow-sm w-100"
                              alt="Ad 1" />
                      </div>
                      <div class="col-md-6 d-none d-md-block">
                          <img src="{{ asset('frontend/images/ads/ad2.png') }}" class="ad-img shadow-sm w-100"
                              alt="Ad 2" />
                      </div>
                  </div>
              </div>
              <div class="carousel-item">
                  <div class="row g-4">
                      <div class="col-md-6 col-12">
                          <img src="{{ asset('frontend/images/ads/ad3.png') }}" class="ad-img shadow-sm w-100"
                              alt="Ad 3" />
                      </div>
                      <div class="col-md-6 d-none d-md-block">
                          <img src="{{ asset('frontend/images/ads/ad4.png') }}" class="ad-img shadow-sm w-100"
                              alt="Ad 4" />
                      </div>
                  </div>
              </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#adSlider" data-bs-slide="prev">
              <span class="carousel-control-prev-icon bg-orange rounded-circle" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#adSlider" data-bs-slide="next">
              <span class="carousel-control-next-icon bg-orange rounded-circle" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
          </button>
      </div>
  </section>

  <section class="container my-5" data-aos="fade-up">
      <div class="row g-4">

          <!-- Daily Current Affairs -->
          <div class="col-md-4">
              <a href="{{ route('dailyafairs.category') }}" class="text-decoration-none">
                  <div class="nav-tile p-4 d-flex align-items-center justify-content-between">
                      <div class="d-flex align-items-center">
                          <div class="bg-orange-soft p-3 rounded-circle me-3">
                              <i class="bi bi-newspaper text-orange fs-3"></i>
                          </div>
                          <h5 class="fw-bold mb-0 text-dark">Daily Current Affairs</h5>
                      </div>
                      <i class="bi bi-chevron-right fs-5 text-orange"></i>
                  </div>
              </a>
          </div>

          <!-- Our Blogs -->
          <div class="col-md-4">
              <a href="{{ route('blogs') }}" class="text-decoration-none">
                  <div class="nav-tile p-4 d-flex align-items-center justify-content-between border-dark-custom">
                      <div class="d-flex align-items-center">
                          <div class="bg-dark p-3 rounded-circle me-3">
                              <i class="bi bi-chat-left-dots text-white fs-3"></i>
                          </div>
                          <h5 class="fw-bold mb-0 text-dark">Our Blogs</h5>
                      </div>
                      <i class="bi bi-chevron-right fs-5 text-dark"></i>
                  </div>
              </a>
          </div>

          <!-- Dashboard -->
          <div class="col-md-4">
              <a href="{{ route('student.dashboard') }}" class="text-decoration-none">
                  <div class="nav-tile p-4 d-flex align-items-center justify-content-between border-primary-custom">
                      <div class="d-flex align-items-center">
                          <div class="bg-primary p-3 rounded-circle me-3">
                              <i class="bi bi-speedometer2 text-white fs-3"></i>
                          </div>
                          <h5 class="fw-bold mb-0 text-dark">Dashboard</h5>
                      </div>
                      <i class="bi bi-chevron-right fs-5 text-primary"></i>
                  </div>
              </a>
          </div>

      </div>
  </section>

  <!-- Test series -->
  <section class="container my-5 py-4" data-aos="fade-up">
      <div class="d-flex justify-content-between align-items-end mb-4">
          <h3 class="fw-semibold">
              Latest <span class="text-orange">Test Series</span>
          </h3>
          <a href="{{ route('courses') }}" class="text-orange fw-bold text-decoration-none">Explore All <i
                  class="bi bi-arrow-right"></i></a>
      </div>
      <div class="row g-4">
          @if(isset($latest_tests))
          @foreach($latest_tests as $test)
          <div class="col-md-4 d-none d-md-block extra-test">
              <div class="test-card p-4 text-center h-100 shadow-sm border">
                  <div class="test-icon-box mb-4">
                      <img src="{{ asset($test->thumbnail??'frontend/images/icons/test1.png') }}" alt="Test 1"
                          class="img-fluid" />
                  </div>
                  <h5 class=" mb-2">{{ $test->title }}</h5>
                  <button class="btn btn-outline-orange w-100 rounded-pill py-2 fw-bold">
                      Join Test
                  </button>
              </div>
          </div>
          @endforeach
          @endif

      </div>
  </section>
  <div class="modal fade" id="shareReferral" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
      aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h1 class="modal-title fs-5" id="staticBackdropLabel">Share Code & Earn</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <div class="social-share">
                      <a href="https://www.facebook.com/sharer/sharer.php?u={{ $url }}" target="_blank">
                          <i class="fab fa-facebook-f socialSize" style="color:blue"></i>
                      </a>

                      <a href="https://twitter.com/intent/tweet?url={{ $url }}" target="_blank">
                          <i class="fab fa-twitter socialSize" style="color:skyblue"></i>
                      </a>

                      <a href="https://www.linkedin.com/sharing/share-offsite?mini=true&url={{ $url }}" target="_blank">
                          <i class="fab fa-linkedin-in socialSize" style="color:blue"></i>
                      </a>


                      <a href="https://wa.me/?text={{ $url }}" target="_blank">
                          <i class="fab fa-whatsapp socialSize" style="color:green"></i>
                      </a>

                      <a href="https://www.reddit.com/submit?url={{ $url }}" target="_blank">
                          <i class="fab fa-reddit socialSize" style="color:red"></i>
                      </a>
                  </div>

              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>
          </div>
      </div>
  </div>
  @endsection
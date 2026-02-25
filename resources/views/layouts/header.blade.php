<!DOCTYPE html>
<html lang="en">

    <head>
        @yield('meta')
        <meta charset="utf-8">
        <title>GM Selection Hub</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet"> 
        
          <link href="https://gmselectionhub.com/frontend/img/ourcources.png" rel="icon">
  <link href="https://gmselectionhub.com/frontend/img/ourcources.png" rel="apple-touch-icon">
        
        <title>{{ $title ?? 'GM Code Lab' }}</title>
<meta name="description" content="GM Selection Hub">
<meta name="author" content="GM Code Lab">



        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link rel="stylesheet" href="{{asset('frontend/lib/animate/animate.min.css')}}"/>
        <link href="{{asset('frontend/lib/lightbox/css/lightbox.min.css')}}" rel="stylesheet">
        <link href="{{asset('frontend/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Customized Bootstrap Stylesheet -->
        <link href="{{asset('frontend/css/bootstrap.min.css')}}" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Template Stylesheet -->
        <link href="{{asset('frontend/css/style.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    </head>
    <style>
    .marquee-wrapper {
      overflow: hidden;
      white-space: nowrap;
    }

    .quote-slide {
      min-height: 160px;                 /* quotes images nahi hain, to height set kar li */
      display: flex; align-items: center; justify-content: center;
      padding: 2rem;
      background: rgb(29 109 156 / 83%);
      color:white;
    }

    .marquee-text {
      display: inline-block;
      padding-left: 100%;
      animation: marquee 20s linear infinite;
    }

    @keyframes marquee {
      0% { transform: translateX(0%); }
      100% { transform: translateX(-100%); }
    }
  </style>
    <body>

        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Topbar Start -->
        <div class="container-fluid topbar bg-light px-5 d-none d-lg-block">
            <div class="row gx-0 align-items-center">
                <div class="col-lg-8 text-center text-lg-start mb-2 mb-lg-0">
                    <div class="d-flex flex-wrap">
                        <a href="#" class="text-muted small me-4"><i class="fas fa-map-marker-alt text-primary me-2"></i>Find A Location</a>
                        <a href="tel:+01234567890" class="text-muted small me-4"><i class="fas fa-phone-alt text-primary me-2"></i>+01234567890</a>
                        <a href="mailto:example@gmail.com" class="text-muted small me-0"><i class="fas fa-envelope text-primary me-2"></i>Example@gmail.com</a>
                    </div>
                </div>
                <div class="col-lg-4 text-center text-lg-end">
                    <div class="d-inline-flex align-items-center" style="height: 45px;">
                        <a href="#"><small class="me-3 text-dark"><i class="fa fa-user text-primary me-2"></i>Register</small></a>
                        <a href="{{route('login')}}"><small class="me-3 text-dark"><i class="fa fa-sign-in-alt text-primary me-2"></i>Login</small></a>
                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle text-dark" data-bs-toggle="dropdown"><small><i class="fa fa-home text-primary me-2"></i> My Dashboard</small></a>
                            <div class="dropdown-menu rounded">
                                <a href="#" class="dropdown-item"><i class="fas fa-user-alt me-2"></i> My Profile</a>
                                <a href="#" class="dropdown-item"><i class="fas fa-comment-alt me-2"></i> Inbox</a>
                                <a href="#" class="dropdown-item"><i class="fas fa-bell me-2"></i> Notifications</a>
                                <a href="#" class="dropdown-item"><i class="fas fa-cog me-2"></i> Account Settings</a>
                                <a href="#" class="dropdown-item"><i class="fas fa-power-off me-2"></i> Log Out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Topbar End -->

        <!-- Navbar & Hero Start -->
        <div class="container-fluid position-relative p-0">
<nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0 sticky-top shadow-sm">
    <a href="{{url('/')}}" class="navbar-brand p-0">
        <img src="{{asset('frontend/img/logo.png')}}" alt="Logo">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" 
        aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto py-0">
            <a href="{{url('/')}}" class="nav-item nav-link active">Home</a>
            <a href="{{url('/cources')}}" class="nav-item nav-link">My Courses</a>
            <a href="{{url('/student/coins')}}" class="nav-item nav-link">Coins</a>
            <!--<a href="#" class="nav-item nav-link">Coupon</a>-->
            <!--<a href="contact.html" class="nav-item nav-link">Contact Us</a>-->
            @if(isset(Auth::user()->id))
            <a href="{{route('student.dashboard')}}" class="nav-item nav-link"><i class="fas fa-chart-pie"></i> Dashboard</a>
            @endif
        </div>
        @if(isset(Auth::user()->id))
         <a href="{{url('/logout')}}" class="btn btn-primary rounded-pill py-2 px-4 my-3 my-lg-0 ms-lg-3"><i class="fas fa-power-off me-2"></i> Log Out</a>
        @else
        <a href="{{route('login')}}" class="btn btn-primary rounded-pill py-2 px-4 my-3 my-lg-0 ms-lg-3">Get Started</a>
         @endif
    </div>
</nav>

            <!-- Carousel Start -->
            
            <!-- Carousel End -->
       
        </div>
        <!-- Navbar & Hero End -->
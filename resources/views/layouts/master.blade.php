<!DOCTYPE html>
<html lang="en">
 <head>
      @yield('meta')
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     <meta content="" name="keywords">
        <meta content="" name="description">
    <title>Guru Mantra</title>
   <link
      href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap"
      rel="stylesheet"
    />
     <!-- Libraries Stylesheet -->
        <link rel="stylesheet" href="{{ asset('frontend/bootstrap/lib/animate/animate.min.css') }}"/>
        <link href="{{ asset('frontend/bootstrap/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">
        <link href="{{ asset('frontend/bootstrap/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
        <!-- Customized Bootstrap Stylesheet -->
        <link href="{{ asset('frontend/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}" />
    <style>
      .socialSize{
    font-size: 28px;
    margin: 10px;
}
body {
    user-select: none;
    -webkit-user-select: none;
    -ms-user-select: none;
}
    </style>
  </head>

   
    <body oncontextmenu="return false;">
<div id="scrollBar"></div>
  {{-- Top Header --}}
    @include('layouts.header')

   

    {{-- Content Wrapper --}}
    <div class="page-wrapper">
        @yield('content')
        @include('layouts.footer')
    </div>
      
       <!-- Back to Top -->
        <a href="#" class="btn btn-primary btn-lg-square rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>   
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>

<script src="{{ asset('frontend/js/main.js') }}"></script>
<script>
  document.onkeydown = function(e) {
    if (e.ctrlKey && 
       (e.key === 'c' || e.key === 'u' || e.key === 's' || e.key === 'a')) {
        return false;
    }
};
document.addEventListener('copy', function(e) {
    e.preventDefault();
    alert('Copying is not allowed!');
});
</script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
$(document).ready(function () {

    $('.toggle-btn').click(function () {

        let parent = $(this).closest('.course-desc');

        parent.find('.short-desc').toggleClass('d-none');
        parent.find('.full-desc').toggleClass('d-none');

        let currentText = $(this).text().trim();

        console.log(currentText); // now shows correct text

        $(this).text(currentText === 'Read More' ? 'Read Less' : 'Read More');
    });

});
</script>
</body>
</html>             
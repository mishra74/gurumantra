 <!-- Footer Start -->
 <div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.2s">
            <div class="container py-5 border-start-0 border-end-0" style="border: 1px solid; border-color: rgb(255, 255, 255, 0.08);">
                <div class="row g-5">
                    <div class="col-md-6 col-lg-6 col-xl-4">
                        <div class="footer-item">
                            <a href="index.html" class="p-0">
                                <!-- <h4 class="text-white"><i class="fas fa-book me-3"></i>GM Success Hub</h4> -->
                                <img src="{{asset('frontend/img/logo.png')}}" alt="Logo" style="max-height: 78px;">
                            </a>
                            <!--<div class="d-flex">-->
                            <!--    <a href="#" class="bg-primary d-flex rounded align-items-center py-2 px-3 me-2">-->
                            <!--        <i class="fas fa-apple-alt text-white"></i>-->
                            <!--        <div class="ms-3">-->
                            <!--            <small class="text-white">Download on the</small>-->
                            <!--            <h6 class="text-white">App Store</h6>-->
                            <!--        </div>-->
                            <!--    </a>-->
                            <!--    <a href="#" class="bg-dark d-flex rounded align-items-center py-2 px-3 ms-2">-->
                            <!--        <i class="fas fa-play text-primary"></i>-->
                            <!--        <div class="ms-3">-->
                            <!--            <small class="text-white">Get it on</small>-->
                            <!--            <h6 class="text-white">Google Play</h6>-->
                            <!--        </div>-->
                            <!--    </a>-->
                            <!--</div>-->
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-2">
                        <div class="footer-item">
                            <h4 class="mb-4">Quick Links</h4>
                            <a href="{{url('student/register')}}"><i class="fas fa-angle-right me-2"></i> Register</a>
                            <a href="{{route('login')}}"><i class="fas fa-angle-right me-2"></i> Login</a>
                            <a href="{{url('/cources')}}"><i class="fas fa-angle-right me-2"></i> My Cources</a>

                            
                            
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="footer-item">
                            <h4 class="mb-4">Important Links</h4>
                             
                             <a href="{{url('/term_and_conditions')}}"><i class="fas fa-angle-right me-2"></i> Terms & Condition</a>
                            <a href="{{url('/privacy_policy')}}"><i class="fas fa-angle-right me-2"></i> Privacy Policy</a>
                            <a href="{{url('/refund_policy')}}"><i class="fas fa-angle-right me-2"></i> Refund Policy</a>
                            <!--<a href="#"><i class="fas fa-angle-right me-2"></i> Terms & Conditions</a>-->
                            <!--<a href="#"><i class="fas fa-angle-right me-2"></i> Disclaimer</a>-->
                            <!--<a href="#"><i class="fas fa-angle-right me-2"></i> Support</a>-->
                            <!--<a href="#"><i class="fas fa-angle-right me-2"></i> FAQ</a>-->
                            <!--<a href="#"><i class="fas fa-angle-right me-2"></i> Help</a> -->
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="footer-item">
                            <h4 class="mb-4">Contact Info</h4>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-map-marker-alt text-primary me-3"></i>
                                <p class="mb-0">Bihar,Patna</p>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="fa fa-phone text-primary me-3"></i>
                                <p class="mb-0">+91 6200-0131-02</p>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-envelope text-primary me-3"></i>
                                <p class="mb-0">info@gmselection.in</p>
                            </div>
                            <div class="d-flex align-items-center mb-4">
                                <i class="fab fa-firefox-browser text-primary me-3"></i>
                                <p class="mb-0">Gm Selection Hub</p>
                            </div>
                            <div class="d-flex">
                                <a class="btn btn-primary btn-sm-square rounded-circle me-3" href="#"><i class="fab fa-facebook-f text-white"></i></a>
                                <a class="btn btn-primary btn-sm-square rounded-circle me-3" href="#"><i class="fab fa-twitter text-white"></i></a>
                                <a class="btn btn-primary btn-sm-square rounded-circle me-3" href="#"><i class="fab fa-instagram text-white"></i></a>
                                <a class="btn btn-primary btn-sm-square rounded-circle me-0" href="#"><i class="fab fa-linkedin-in text-white"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->
        
        <!-- Copyright Start -->
        <div class="container-fluid copyright py-4">
            <div class="container">
                <div class="row g-4 align-items-center">
                    <div class="col-md-6 text-center text-md-start mb-md-0">
                    </div>
                    <div class="col-md-6 text-center text-md-end text-white">
                        <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                        <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                        <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                         Developed By <a class="border-bottom text-white" href="{{url('/')}}">GM CODE LAB</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Copyright End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-primary btn-lg-square rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>   

        
        <!-- JavaScript Libraries -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{asset('frontend/lib/wow/wow.min.js')}}"></script>
        <script src="{{asset('frontend/lib/easing/easing.min.js')}}"></script>
        <script src="{{asset('frontend/lib/waypoints/waypoints.min.js')}}"></script>
        <script src="{{asset('frontend/lib/counterup/counterup.min.js')}}"></script>
        <script src="{{asset('frontend/lib/lightbox/js/lightbox.min.js')}}"></script>
        <script src="{{asset('frontend/lib/owlcarousel/owl.carousel.min.js')}}"></script>
        
        <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

        <!-- Template Javascript -->
        <script src="{{asset('frontend/js/main.js')}}"></script>
    </body>

</html>
<!-- Bootstrap 5 JS (Bundle includes Popper) -->

<!-- Optional: JS init (agar aap programmatically control chahte ho) -->
<script>
  const myCarousel = document.querySelector('#quoteCarousel');
  // Auto-slide interval (ms). Comment out if you want manual only.
  new bootstrap.Carousel(myCarousel, { interval: 3000, ride: 'carousel' });
</script>



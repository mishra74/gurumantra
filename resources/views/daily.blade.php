
      
@include('layouts.header')
        <!-- Services Start -->
        <div class="container-fluid service py-5">
            <div class="container py-5">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                    <h4 class="text-primary">Our Daily Current Affair</h4>
                    <h4 class="display-6 mb-4">Two Type of Daily Current Affair Listed Here </h4>
                </div>
                <div class="row g-4">
                    <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="service-item">
                            <div class="service-img">
                                <img src="{{asset('frontend/img/day1.jpg')}}" class="img-fluid rounded-top w-100" alt="Image">
                            </div>
                            <div class="rounded-bottom p-4">
                                <a href="#" class="h4 d-inline-block mb-4">View and Read in PDF</a><br>
                                
                                <!--<a class="btn btn-primary rounded-pill py-2 px-4" href="{{url('/student/day_type/1')}}">Learn More</a>-->
                                                                <a class="btn btn-primary rounded-pill py-2 px-4" href="{{url('student/category')}}">Learn More</a>

                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.4s">
                        <div class="service-item">
                            <div class="service-img">
                                <img src="{{asset('frontend/img/day2.jpg')}}" class="img-fluid rounded-top w-100" alt="Image">
                            </div>
                            <div class="rounded-bottom p-4">
                                <a href="#" class="h4 d-inline-block mb-4">View and Read in Content</a><br>
                                     <a class="btn btn-primary rounded-pill py-2 px-4" href="{{url('student/category')}}">Learn More</a>

                                <!--<a class="btn btn-primary rounded-pill py-2 px-4" href="{{url('/student/day_type/2')}}">Learn More</a>-->
                            </div>
                        </div>
                    </div>
                    
                    
                </div>
            </div>
        </div>
        

        <!-- Footer Start -->
 @include('layouts.footer')


      
@include('layouts.header')
        <!-- Services Start -->
        <div class="container-fluid service py-5">
            <div class="container py-5">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                    <!--<h4 class="text-primary">Our Cources</h4>-->
                    <!--<h1 class="display-5 mb-4">See Your Best Cources </h1>-->
                </div>
                <div class="row g-4">
                    <div class="col-md-6 col-lg-3 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="service-item">
                            <div class="service-img">
                                <img src="{{asset('frontend/img/service-1.jpg')}}" class="img-fluid rounded-top w-100" alt="Image">
                            </div>
                            <div class="rounded-bottom p-4">
                                <a href="#" class="h4 d-inline-block mb-4"> Batches</a>

                                
                                <a class="btn btn-primary rounded-pill py-2 px-4" href="{{url('/batches_series')}}">Learn More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 wow fadeInUp" data-wow-delay="0.4s">
                        <div class="service-item">
                            <div class="service-img">
                                <img src="{{asset('frontend/img/service-2.jpg')}}" class="img-fluid rounded-top w-100" alt="Image">
                            </div>
                            <div class="rounded-bottom p-4">
                                <a href="#" class="h4 d-inline-block mb-4">Test Series</a><br>
                               
                                
                                <a class="btn btn-primary rounded-pill py-2 px-4" href="{{url('/test_series/')}}">Learn More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 wow fadeInUp" data-wow-delay="0.6s">
                        <div class="service-item">
                            <div class="service-img">
                                <img src="{{asset('frontend/img/service-3.jpg')}}" class="img-fluid rounded-top w-100" alt="Image">
                            </div>
                            <div class="rounded-bottom p-4">
                                <a href="#" class="h4 d-inline-block mb-4">Notes</a><br>
                                
                                <a class="btn btn-primary rounded-pill py-2 px-4" href="{{url('/notes')}}">Learn More</a>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-6 col-lg-3 wow fadeInUp" data-wow-delay="0.6s">
                        <div class="service-item">
                            <div class="service-img">
                                <img src="{{asset('frontend/img/service-3.jpg')}}" class="img-fluid rounded-top w-100" alt="Image">
                            </div>
                            <div class="rounded-bottom p-4">
                                <a href="#" class="h4 d-inline-block mb-4">Recording Store</a><br>
                                
                                <a class="btn btn-primary rounded-pill py-2 px-4" href="{{url('/recording_room')}}">Learn More</a>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        

        <!-- Footer Start -->
 @include('layouts.footer')

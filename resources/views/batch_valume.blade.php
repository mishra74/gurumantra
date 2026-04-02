
      
@include('layouts.header')
        <!-- Services Start -->
        <div class="container-fluid service py-5">
            <div class="container py-5">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                    <!--<h4 class="text-primary">Our Cources</h4>-->
                    <!--<h1 class="display-5 mb-4">See Your Best Cources </h1>-->
                </div>
                <div class="row g-4">

                @if(isset($batches) && $batches!='')
                @foreach($batches as $batch)
                    <div class="col-md-6 col-lg-3 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="service-item">
                            <div class="service-img">
                                <img src="{{asset('frontend/img/service-1.jpg')}}" class="img-fluid rounded-top w-100" alt="Image">
                            </div>
                            <div class="rounded-bottom p-4">
                                <a href="#" class="h4 d-inline-block mb-4"> {{$batch->title}}</a><br>
                                <!-- Description -->
            <div class="course-desc flex-grow-1">
                
                <div class="short-desc">
                    {!! Str::limit(strip_tags($batch->description), 150) !!}
                </div>

                <div class="full-desc d-none">
                    {!! $batch->description !!}
                </div>

                <a href="javascript:void(0)" 
                   class="toggle-btn text-primary">
                   Read More
                </a>

            </div>
                                <!--<a class="btn btn-primary rounded-pill py-2 px-4" href="{{url('/tests_valume/'.$batch->id)}}">Learn More</a>-->
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                    
                    
                </div>
            </div>
        </div>
        

        <!-- Footer Start -->
 @include('layouts.footer')

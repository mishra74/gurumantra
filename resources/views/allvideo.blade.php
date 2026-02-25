
      
@include('layouts.header')
        <!-- Services Start -->
        <div class="container-fluid service py-5">
            <div class="container py-5">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                    <h4 class="text-primary">Our Recordings</h4>
                    <h1 class="display-5 mb-4">See Your Recordings </h1>
                </div>
                <div class="row g-4">

                @if(isset($tests) && $tests!='')
                @foreach($tests as $test)
                    <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="service-item">
                            <div class="service-img">
                                <img src="{{asset('public/frontend/img/testData.jpg')}}" class="img-fluid rounded-top w-100" alt="Image">
                            </div>
                            <div class="rounded-bottom p-4">
                                <a href="#" class="h4 d-inline-block mb-4"> {{$test->title}}</a><br>
                                
                                 @if($hasPurchased ===false)
                                  <a class="btn btn-primary rounded-pill py-2 px-4" 
       href="{{ url('/purchase/video/'.$VideoVolumeId) }}">
        <i class="fa fa-lock"></i> Locked
    </a>
@else
                                <a class="btn btn-primary rounded-pill mt-1 px-2" href="{{url('/video/'.$test->id)}}"><i class="fa fa-eye"></i> View</a>
@endif
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

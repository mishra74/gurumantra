
      
@include('layouts.header')
        <!-- Services Start -->
        <div class="container-fluid service py-5">
            <div class="container py-5">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                    <h4 class="text-primary">Our Cources</h4>
                    <h1 class="display-5 mb-4">See Your Best Cources </h1>
                </div>
                <div class="row g-4">

                @if(isset($Courses) && $Courses!='')
                @foreach($Courses as $course)
                    <!--<div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.2s">-->
                    <!--    <div class="service-item">-->
                    <!--        <div class="service-img">-->
                    <!--            <img src="{{asset('frontend/img/service-1.jpg')}}" class="img-fluid rounded-top w-100" alt="Image">-->
                    <!--        </div>-->
                    <!--        <div class="rounded-bottom p-4">-->
                    <!--            <a href="#" class="h4 d-inline-block mb-4"> {{$course->title}}</a><br>-->
                                
                    <!--            <a class="btn btn-primary rounded-pill py-2 px-4" href="{{url('/cources_type/'.$course->id)}}">Learn More</a>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                    
                    
                    <div class="col-md-6 col-lg-3 wow fadeInUp" data-wow-delay="0.2s">
    <div class="service-item">
        <!-- Thumbnail banega yahan -->
        <div class="service-img d-flex align-items-center justify-content-between p-3"
             style="height: 272px; background: linear-gradient(135deg, #1e3c72, #2a5298); border-radius: 8px;">
            
            <!-- Title dynamic -->
            <h4 class="text-white fw-bold mb-0" style="font-family: 'Montserrat', sans-serif; 
                           font-weight: 800; 
                           font-size: 40px; 
                           line-height: 1.2; 
                           margin: 0;">{{$course->title}}</h4>

            <!-- Icon fix -->
            <i class="fa fa-book fa-3x text-white ms-3"></i>
        </div>

        <!-- Content -->
        <div class="rounded-bottom p-4">
            <a href="#" class="h4 d-inline-block mb-4"> {{$course->title}}</a><br>
            <a class="btn btn-primary rounded-pill py-2 px-4" href="{{url('/cources_type/'.$course->id)}}">Learn More</a>
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

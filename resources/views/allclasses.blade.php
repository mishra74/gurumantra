@php
$volumeId=session('volumeId');
@endphp
      
@include('layouts.header')
        <!-- Services Start -->
        <div class="container-fluid service py-5">
            <div class="container py-5">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                    <!--<h4 class="text-primary">Our Tests</h4>-->
                    <!--<h1 class="display-5 mb-4">See Your Tests </h1>-->
                </div>
                <div class="row g-4">
                @if(isset($classes) && $classes!='')
                
                @foreach($classes as $class)
                    <div class="col-md-6 col-lg-3 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="service-item">
                            <!--<div class="service-img">-->
                            <!--    <img src="{{asset('public/frontend/img/testData.jpg')}}" class="img-fluid rounded-top w-100" alt="Image">-->
                            <!--</div>-->
                             <!-- Thumbnail banega yahan -->
        <div class="service-img d-flex align-items-center justify-content-between p-3"
             style="height: 272px; background: linear-gradient(135deg, #1e3c72, #2a5298); border-radius: 8px;">
            
            <!-- Title dynamic -->
            <h4 class="text-white fw-bold mb-0" style="font-family: 'Montserrat', sans-serif; 
                           font-weight: 800; 
                           font-size: 40px; 
                           line-height: 1.2; 
                           margin: 0;">{{$class->title}}</h4>

            <!-- Icon fix -->
            <i class="fa fa-book fa-3x text-white ms-3"></i>
        </div>
                            <div class="rounded-bottom p-4">
                                <a href="#" class="h4 d-inline-block mb-4"> {{$class->title}}</a><br>
                                
                                
                                @if($class->live_class == 1)
                                <a class="btn btn-primary rounded-pill mt-1 px-2" href="#">Live Test</a>
                                @endif
                                 @if(!$OrderBatch)
<a href="{{ route('zoom.join',11) }}" class="btn btn-primary">
Join Classes now
</a>
                                <!-- <a class="btn btn-success rounded-pill mt-1 px-2" href="{{url('/purchase/class/'.$batche->id)}}">Join Now</a> -->
                                <a class="btn btn-warning rounded-pill mt-1 px-2" href="{{url('/purchase/class/'.$batche->id)}}">Previous</a>

                                @else
                                
<a href="{{ route('zoom.join',$class->id) }}" class="btn btn-primary">
Join Classes
</a><a class="btn btn-warning rounded-pill mt-1 px-2" href="{{url('/liveclass/'.$class->id.'/'.$volumeId)}}">Previous</a>
                                @endif
                                <!-- <a class="btn btn-warning rounded-pill mt-1 px-2" href="{{url('/practice/'.$class->id)}}">Practice Test</a> -->
                                
                                
                                
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

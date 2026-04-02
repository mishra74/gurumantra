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
                    <div class="service-img">
                        <img src="{{asset('public/frontend/img/testData.jpg')}}" class="img-fluid rounded-top w-100"
                            alt="Image">
                    </div>
                    <!-- Thumbnail banega yahan -->

                    <div class="rounded-bottom p-4">
                        <a href="#" class="h4 d-inline-block mb-4"> {{$class->title}}</a><br>
 <!-- Description -->
            <div class="course-desc flex-grow-1">
                
                <div class="short-desc">
                    {!! Str::limit(strip_tags($class->description), 150) !!}
                </div>

                <div class="full-desc d-none">
                    {!! $class->description !!}
                </div>

                <a href="javascript:void(0)" 
                   class="toggle-btn text-primary">
                   Read More
                </a>

            </div>

                        @if($class->live_class == 1)
                        <a class="btn btn-primary rounded-pill mt-1 px-2" href="#">Live Test</a>
                        @endif
                        @if(!$OrderBatch)
                        <a href="{{ route('zoom.join',11) }}" class="btn btn-primary">
                            Join Classes now
                        </a>
                        <!-- <a class="btn btn-success rounded-pill mt-1 px-2" href="{{url('/purchase/class/'.$batche->id)}}">Join Now</a> -->
                        <a class="btn btn-warning rounded-pill mt-1 px-2"
                            href="{{url('/purchase/class/'.$batche->id)}}">Previous</a>

                        @else

                        <a href="{{ route('zoom.join',$class->id) }}" class="btn btn-primary">
                            Join Classes
                        </a><a class="btn btn-warning rounded-pill mt-1 px-2"
                            href="{{url('/liveclass/'.$class->id.'/'.$volumeId)}}">Previous</a>
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
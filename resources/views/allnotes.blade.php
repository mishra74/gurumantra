
      
@include('layouts.header')
        <!-- Services Start -->
        <div class="container-fluid service py-5">
            <div class="container py-5">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                    <!--<h4 class="text-primary">Our Daily Current Affair Content</h4>-->
                    <!--<h4 class="display-6 mb-4">All Content Listed Here</h4>-->
                </div>
                <div class="row g-4">
                
                    @if(isset($tests))
                    @foreach($tests as $cont)
                    <div class="col-md-6 col-lg-3 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="service-item">
                            <div class="service-img">
                                <div class="service-img d-flex align-items-center justify-content-between p-3"
             style="height: 272px; background: linear-gradient(135deg, #1e3c72, #2a5298); border-radius: 8px;">
            
            <!-- Title dynamic -->
            <h4 class="text-white fw-bold mb-0" style="font-family: 'Montserrat', sans-serif; 
                           font-weight: 800; 
                           font-size: 40px; 
                           line-height: 1.2; 
                           margin: 0;">{{$cont->title}}</h4>

            <!-- Icon fix -->
            <i class="fa fa-book fa-3x text-white ms-3"></i>
        </div>
                            </div>
                            <div class="rounded-bottom p-4">
                                <a href="#" class="h4 d-inline-block mb-1">{{$cont->title}} </a><br>
                                <!-- <span class="mb-4">{{$cont->sub_title}}</span><br><br> -->
                                 @if($hasPurchased ===false)
    <a class="btn btn-primary rounded-pill py-2 px-4" 
       href="{{ url('/purchase/notes/'.$volume_id) }}">
        <i class="fa fa-lock"></i> Locked
    </a>
@else
                                @if($cont->pdf_file_question !='')
                                <a class="btn btn-primary rounded-pill py-2 px-4" href="{{ asset('storage/app/public/' . $cont->pdf_file_question)}}"><i class="fa fa-eye"></i> View</a>
                                <!-- <a href="{{ asset('storage/app/public/' . $cont->pdf_file_question)}}" class="h4 d-inline-block mb-1" download><i class="fa fa-download text-success"></i></a><br> -->
                                @endif

                                @if($cont->pdf_enter_question !='')
                                
                              
    <a class="btn btn-primary rounded-pill py-2 px-4" 
       href="{{ url('noteshow/'.$cont->id) }}">
        <i class="fa fa-eye"></i> View
    </a>


                                @endif
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

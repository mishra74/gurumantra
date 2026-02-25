
      
@include('layouts.header')
        <!-- Services Start -->
        <div class="container-fluid service py-5">
            <div class="container py-5">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                    <h4 class="text-primary">Our Daily Current Affair Content</h4>
                    <h4 class="display-6 mb-4">All Content Listed Here</h4>
                </div>
                <div class="row g-4">
                    @if(isset($allContent))
                    @foreach($allContent as $cont)
                    <div class="col-md-6 col-lg-3 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="service-item">
                            <div class="service-img">
                                <img src="{{ asset('storage/app/public/' . $cont->thumbnail)}}" class="img-fluid rounded-top w-100" alt="Image">
                            </div>
                           
                            <div class="mt-auto">
                                {{-- PDF --}}
                                @if(!empty($cont->pdf))
                                    <a class="btn btn-outline-primary btn-sm mb-2"
                                       href="{{ asset('storage/app/public/' . $cont->pdf)}}"
                                       target="_blank">
                                        <i class="fa fa-eye"></i> View PDF
                                    </a>

                                    <a href="{{ asset('storage/app/public/' . $cont->pdf)}}"
                                       download
                                       class="btn btn-outline-success btn-sm mb-2">
                                        <i class="fa fa-download"></i> Download
                                    </a>
                                @endif

                                {{-- Content --}}
                                @if(!empty($cont->content))
                                    <a class="btn btn-primary btn-sm w-100"
                                       href="{{url('student/read_content/'.$cont->id)}}">
                                         Read Content
                                    </a>
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

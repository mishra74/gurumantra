
      
@include('layouts.header')
        <!-- Services Start -->
        <div class="container-fluid service py-5">
            <div class="container py-5">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                    <!--<h4 class="text-primary">Our Tests</h4>-->
                    <!--<h1 class="display-5 mb-4">See Your Tests </h1>-->
                </div>
                <div class="row g-4">

                @if(isset($pdf) && $pdf!='')
                
                    <div class="col-6 col-md-4 col-lg-3 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="service-item">
                             <div class="service-img d-flex align-items-center justify-content-between p-3"
             style="height: 272px; background: linear-gradient(135deg, #1e3c72, #2a5298); border-radius: 8px;">
            
            <!-- Title dynamic -->
            <h4 class="text-white fw-bold mb-0" style="font-family: 'Montserrat', sans-serif; 
                           font-weight: 800; 
                           font-size: 40px; 
                           line-height: 1.2; 
                           margin: 0;">{{$pdf->title}}</h4>

            <!-- Icon fix -->
            <i class="fa fa-book fa-3x text-white ms-3"></i>
        </div>
                            <div class="rounded-bottom p-4">
                                @if($pdf->pdf_file_question !='')
                                <a href="{{ asset('storage/app/' . $pdf->pdf_file_question)}}" class="h4 d-inline-block mb-4">  <span class="badge bg-danger">Question</span></a><br>
                                @else
                                <a href="{{url('pdfcontent/'.$pdf->id)}}" class="h4 d-inline-block mb-4">  <span class="badge bg-danger">Question</span></a><br>
                                @endif
                               
                                <!-- <a href="{{asset('frontend/img/omrsheet.pdf')}}" download><button class="btn btn-primary">Download OMR Sheet</button></a> -->
                                
                                
                               

                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-md-4 col-lg-3 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="service-item">
                             <div class="service-img d-flex align-items-center justify-content-between p-3"
             style="height: 272px; background: linear-gradient(135deg, #1e3c72, #2a5298); border-radius: 8px;">
            
            <!-- Title dynamic -->
            <h4 class="text-white fw-bold mb-0" style="font-family: 'Montserrat', sans-serif; 
                           font-weight: 800; 
                           font-size: 40px; 
                           line-height: 1.2; 
                           margin: 0;">{{$pdf->title}}</h4>

            <!-- Icon fix -->
            <i class="fa fa-book fa-3x text-white ms-3"></i>
        </div>
                            <div class="rounded-bottom p-4">
                            @if($pdf->pdf_file_answer !='')
 
                            @if(!$hasPurchased)
                           
                            <a href="{{url('purchase/test/'.$pdf->id)}}" class="h4 d-inline-block mb-4">  <span class="badge bg-success">Answer</span></a><br>
                            @else
                            <a href="{{ asset('storage/' . $pdf->pdf_file_answer)}}" class="h4 d-inline-block mb-4">  <span class="badge bg-success">Answer</span></a><br>
                            @endif


                            @else
 
@if(!$hasPurchased)
                            
                            <a href="{{url('purchase/test/'.$pdf->id)}}" class="h4 d-inline-block mb-4">  <span class="badge bg-success">Answer</span></a><br>
                            @else
                            <a href="{{url('pdfanswer/'.$pdf->id)}}" class="h4 d-inline-block mb-4">  <span class="badge bg-success">Answer</span></a><br>

                            @endif
                            
                            @endif
                                <a href="{{asset('frontend/img/omrsheet.pdf')}}" download style="color:blue">Download OMR Sheet</a>
                               

                            </div>
                        </div>
                    </div>
                 
                    @endif
                    
                    
                </div>
            </div>
        </div>
        

        <!-- Footer Start -->
 @include('layouts.footer')

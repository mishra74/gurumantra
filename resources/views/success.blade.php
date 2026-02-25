
      
@include('layouts.header')
        <!-- Services Start -->
         @php
         if(session('type')==="Notes"){
         $lastData = \App\Models\PurchasedModel::where('user_id', Auth::id())
         ->select('orderd.*','pdfnotes.start_date','pdfnotes.id','pdfnotes.title as testname')
         ->leftJoin('pdfnotes','pdfnotes.id','=','orderd.notes_volume')
            ->latest();
         }else if(session('type')==="Batch"){
         $lastData = \App\Models\PurchasedModel::where('user_id', Auth::id())
         ->select('orderd.*','batches.start_date','batches.id','batches.title as testname')
         ->leftJoin('batches','batches.id','=','orderd.batch_volume')
            ->latest()   
            ->first();
         }
         else{
         $lastData = \App\Models\PurchasedModel::where('user_id', Auth::id())
         ->select('orderd.*','tests.start_date','tests.id','tests.title as testname')
         ->leftJoin('tests','tests.id','=','orderd.test_volume')
            ->latest()   
            ->first();}
         @endphp
        <div class="container-fluid service py-5">
            <div class="container py-5">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                    <h5 class="display-8 mb-4 text-success">Congratulation Your Order Purchased successfully</h5>
                          <ul>
                            <li><b class="text-primary">Order ID:</b>  {{$lastData->order_number}}</li>
                            <li><b class="text-primary">Available Coins:</b> <i class="fa fa-rupee"></i> {{Auth::user()->coins}}</li>
                            <li><b class="text-primary">Start Date From:</b> {{$lastData->start_date}}</li>
                            @if(session('type')==="Notes")
                            <li><b class="text-primary">Notes Name:</b> {{$lastData->testname}}</li>
                         @elseif(session('type')==="Tests")
                                                     <li><b class="text-primary">Test Name:</b> {{$lastData->testname}}</li>

                         @elseif(session('type')==="Batch")
                                                     <li><b class="text-primary">Batch Name:</b> {{$lastData->testname}}</li>

                         @else
                                                     <li><b class="text-primary">Recording Name:</b> {{$lastData->testname}}</li>

                         @endif
                        </ul>
                        <a href="{{url('/cources')}}" class="btn btn-primary">Return to Cources</a>
                </div>
               
            </div>
        </div>
        

        <!-- Footer Start -->
 @include('layouts.footer')

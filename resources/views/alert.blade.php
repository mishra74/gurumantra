
      
@include('layouts.header')
        <!-- Services Start -->
         @php
         $lastData = \App\Models\PurchasedModel::where('user_id', Auth::id())
         ->select('orderd.*','tests.start_date','tests.id','tests.title as testname')
         ->leftJoin('tests','tests.id','=','orderd.test_volume')
         ->where('tests.id',$id)
            ->latest()   
            ->first();
         @endphp
        <div class="container-fluid service py-5">
            <div class="container py-5">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                    <h6 class="display-8 mb-4 text-success"><span class="text-danger">Thank You!</span><br> You Have Already Purchased This Test Series Please Wait Till Start Date</h6>
                          <ul>
                            <li><b class="text-primary">Order ID:</b>  {{$lastData->order_number}}</li>
                            <li><b class="text-primary">Available Coins:</b> <i class="fa fa-rupee"></i> {{Auth::user()->coins}}</li>
                            <li><b class="text-primary">Start Date From:</b> {{$lastData->start_date}}</li>
                            <li><b class="text-primary">Test Name:</b> {{$lastData->testname}}</li>
                         
                        </ul>
                        <a href="{{url('/cources')}}" class="btn btn-success"><i class="fa fa-angle-double-left	
"></i> Return to Cources</a>

                </div>
               
            </div>
        </div>
        

        <!-- Footer Start -->
 @include('layouts.footer')

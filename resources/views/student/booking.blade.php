@include('student.layouts.header')
@include('student.layouts.sidebar')

            <!-- ========== Left Sidebar Start ========== -->
            
            <!-- ========== Left Sidebar End ========== -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Attex</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                            <li class="breadcrumb-item active">All Bookings</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">All Booking</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">


                                        <div class="table-responsive-sm">
                                            <table class="table table-centered mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Title</th>
                                                        <th>Price</th>
                                                        <th>Order ID</th>
                                                        <th>Order Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                              <tbody>
@if(isset($orders) && count($orders) > 0)
    @foreach($orders as $key=>$order)
        <tr>
            <td>{{ $key+1 }}</td>

            <td>
                {{ $order->test_title 
                    ?? $order->notes_title 
                    ?? $order->batch_title 
                    ?? 'N/A' }}
            </td>

            <td>₹{{ number_format($order->price,2) }}</td>

            <td>{{ $order->order_number }}</td>

            <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y') }}</td>
            
            <td>
    @if($order->test_volume)
        <a href="{{ url('/tests_valume/'.$order->test_volume) }}">View</a>

    @elseif($order->notes_volume)
        <a href="{{ url('/notes_valume/'.$order->notes_volume) }}">View</a>

    @elseif($order->batch_volume)
        <a href="{{ url('/batch_volume/'.$order->batch_volume) }}">View</a>

    @else
        <a href="#">Deleted</a>
    @endif
</td>

        </tr>
    @endforeach
@else
    <tr>
        <td colspan="5" class="text-center">No Orders Found</td>
    </tr>
@endif
</tbody>

                                            </table>
                                        </div> <!-- end table-responsive-->  

                                    </div> <!-- end card body-->
                                </div> <!-- end card -->
                            </div><!-- end col-->

                          
                        </div>
                        <!-- end row-->

                        
                        
                    </div> <!-- container -->

                </div> <!-- content -->

               
            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

        </div>
        <!-- END wrapper -->

        @include('student.layouts.footer')

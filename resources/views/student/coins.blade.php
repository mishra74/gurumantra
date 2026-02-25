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
                                                        <th>User Name</th>
                                                        <th>Registration Date</th>
                                                        <th>Email</th>
                                                        <th>Available Coins</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                               
                                                    <tr>
                                                        <td>1</td>
                                                        <td>{{Auth::user()->name}}</td>
                                                        <td>{{Auth::user()->created_at}}</td>
                                                        <td>{{Auth::user()->email}}</td>
                                                        <td>{{Auth::user()->coins}}</td>
                                                    </tr>
                                                  
                                                   
                                                </tbody>
                                            </table>
                                        </div> <!-- end table-responsive-->  

                                    </div> <!-- end card body-->
                                </div> <!-- end card -->
                            </div><!-- end col-->

                          <div class="row mt-4">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">

                <h4 class="header-title mb-3">Coins Usage History</h4>

                <div class="table-responsive-sm">
                    <table class="table table-centered mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Used For</th>
                                <th>Coins Used</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>

                        @forelse($usecoins as $key => $coin)
                            <tr>
                                <td>{{ $key + 1 }}</td>

                                <td>
                                    @if($coin->test_title)
                                        Test: {{ $coin->test_title }}

                                    @elseif($coin->notes_title)
                                        Notes: {{ $coin->notes_title }}

                                    @elseif($coin->batch_title)
                                        Batch: {{ $coin->batch_title }}

                                    @else
                                        N/A
                                    @endif
                                </td>

                                <td>
                                    <span class="badge bg-danger">
                                        - {{ $coin->coinsuse }}
                                    </span>
                                </td>

                                <td>{{ $coin->created_at->format('d M Y h:i A') }}</td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="4" class="text-center">
                                    No Coins Used Yet
                                </td>
                            </tr>
                        @endforelse

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

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

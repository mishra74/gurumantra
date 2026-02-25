@include('admin.layouts.header')

        <!-- Begin page -->
        <div class="wrapper">

            
            <!-- ========== Topbar Start ========== -->
            @include('admin.layouts.topbar')

            <!-- ========== Topbar End ========== -->

            @include('admin.layouts.sidebar')

            <!-- ========== Left Sidebar End ========== -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        <!-- get table -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="header-title">{{$page}}</h4>
                                        

                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Email</th>
                                                        <th scope="col">Phone</th>
                                                        <th scope="col">Coins</th>
                                                        <th scope="col">Is_active</th>
                                                      
                                                    </tr>
                                                </thead>
                                               <tbody>
                                                @if(isset($student))
                                                @foreach($student as $key => $st)
                                                <tr>
                                                    <td>{{$key +  1}}</td>
                                                    <td>{{$st->name}}</td>
                                                    <td>{{$st->email}}</td>
                                                    <td>{{$st->phone}}</td>
                                                    <td>{{$st->coins}}</td>
                                                 
                                                    <td><span class="badge {{$st->is_active == 1 ? 'bg-success' : 'bg-danger'}}">{{$st->is_active == 1 ? 'YES' : 'No'}}</span>

                                                    </td>
                                                </tr>
                                                @endforeach
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

        @include('admin.layouts.footer')

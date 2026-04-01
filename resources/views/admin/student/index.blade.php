@include('admin.layouts.header')
<style>
    .addcourse{
        position: relative;
        border: 2px solid #000;
        border-radius: 50%;
        padding: 2px 6px;
        font-size: 12px;
        color: #000;
        text-decoration: none;
        margin-left: 5px;
    }
    </style>
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
                                                        <th scope="col">Create Date</th>
                                                        <th scope="col">Is_active</th>
                                                      <th>Action</th>
                                                    </tr>
                                                </thead>
                                               <tbody>
                                                @if(isset($student))
                                                @foreach($student as $key => $st)
                                                <tr>
                                                    <td>{{$key +  1}}<a href="{{route('admin.maual.course',$st->id)}}" class="addcourse"><i class="fa fa-plus"></i></a></td>
                                                    <td>{{$st->name}}</td>
                                                    <td>{{$st->email}}</td>
                                                    <td>{{$st->phone}}</td>
                                                    <td>{{$st->coins}}</td>
                                                    <td>{{date('d M Y',strtotime($st->created_at))}}</td>
                                                    <td><span class="badge {{$st->is_active == 1 ? 'bg-success' : 'bg-danger'}}">{{$st->is_active == 1 ? 'YES' : 'No'}}</span>

                                                    </td>
                                                    <td>
                                                        <a href="{{ url('/admin/payment/history/'.$st->id) }}" class="btn btn-sm btn-outline-primary">Payment History</a>
                                                        <a href="{{ url('/admin/coin/history/.'.$st->id) }}" class="btn btn-sm btn-outline-danger">Coins History</a>
                                                        <a href="{{ url('/admin/coupon/history/'.$st->id) }}" class="btn btn-sm btn-outline-secondary">Coupons History</a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @endif


                                               </tbody>
                                            </table>
                                            {{$student->links()}}
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

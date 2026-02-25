@include('admin.layouts.header')

<!-- Begin page -->
<div class="wrapper">
    @include('admin.layouts.topbar')
    @include('admin.layouts.sidebar')

    <div class="content-page">
        <div class="content">
            <!-- Start Content-->
            <div class="container-fluid">
                <!-- get table -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <a href="{{ url('admin/test_creates/add') }}" class="btn btn-primary mb-3">
                                    <i class="fa fa-plus"></i> Add
                                </a>

                                <h4 class="header-title">{{ $page }}</h4>

                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Title</th>
                                                <th scope="col">Section</th>
                                                <th scope="col">Type</th>
                                                <th scope="col">Is_active</th>
                                                <th scope="col">Created_at</th>       
                                                <th scope="col">Updated_at</th>                                                
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(isset($create_test) )
                                            @foreach($create_test as $key=>$create)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$create->title}}</td>
                                                <td><a class="btn btn-primary" href="{{url('admin/section/'.$create->id)}}"><i class="fa fa-plus"></i></a></td>


                                                <td>
    @if($create->live_class)
        <span class="badge bg-danger">Deleted</span>
    @else
        <span class="badge {{ $create->is_active==1 ? 'bg-success' : 'bg-danger' }}">
            {{ $create->is_active ? 'Active' : 'Inactive' }}
        </span>
    @endif
</td>
                                               
                                        <td>
    @if($create->live_class == 1)
        <span class="badge bg-warning">Live + Practice</span>
    @else
        <span class="badge bg-danger">
           Only Practice
        </span>
    @endif
</td>



                                                <td>{{$create->created_at}}</td>
                                                <td>{{$create->updated_at}}</td>
                                                <td>
                                                        <a href="{{ url('admin/test_creates/edit/'.$create->id) }}">
                                                            <i class="fa fa-edit text-success"></i>
                                                        </a>
                                                        <a href="{{ url('admin/test_creates/delete/'.$create->id) }}">
                                                            <i class="fa fa-trash text-danger"></i>
                                                        </a>
                                                        <a href="{{ url('admin/test_creates/restore/'.$create->id) }}">
                                                            <i class="fa fa-undo text-warning"></i>
                                                        </a>
                                                        <a href="{{ url('admin/test_creates/toggle/'.$create->id) }}">
                                                            <i class="fa {{$create->is_active == 1 ? 'fa-toggle-on' : 'fa-toggle-off'}} text-info"></i>
                                                        </a>
                                                    </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                            
                                        </tbody>
                                    </table>
                                    {{ $create_test->links() }}
                                </div> <!-- end table-responsive -->

                            </div> <!-- end card body -->
                        </div> <!-- end card -->
                    </div><!-- end col-->
                </div>
            </div> <!-- container -->
        </div> <!-- content -->
    </div>
    <!-- End Page content -->
</div>
<!-- END wrapper -->

@include('admin.layouts.footer')

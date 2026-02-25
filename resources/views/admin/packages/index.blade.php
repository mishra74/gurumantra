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

                                <a href="{{ route('add.packages') }}" class="btn btn-primary mb-3">
                                    <i class="fa fa-plus"></i> Add
                                </a>

                               

                                <h4 class="header-title">{{ $page }}</h4>

                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Type</th>
                                                <th scope="col">CourceType</th>
                                                <th scope="col">MRP</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Discount</th> 
                                                <th scope="col">ExpireAt</th>
                                                <th scope="col">IsActive</th>
                                                <th scope="col">CreatedAt</th>
                                                <th scope="col">UpdatedAt</th>
                                              
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($packages as $key => $package)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>

                                                    <td>{{ $package->package_name }}</td>
                                                    <td>{{$package->package_type }}</td>
                                                    <td>{{ $package->course_type}}</td>
                                                    <td>{{ $package->mrp}}</td>
                                                    <td>{{ $package->price}}</td>
                                                    <td>{{ $package->discount}}</td>
                                                    <td>{{ $package->expire_at}}</td>
                                                    <td>
    @if($package->deleted_at)
        <span class="badge bg-danger">Deleted</span>
    @else
        <span class="badge {{ $package->is_active==1 ? 'bg-success' : 'bg-danger' }}">
            {{ $package->is_active ? 'Active' : 'Inactive' }}
        </span>
    @endif
</td>
                                                    
                                                    <td>{{ $package->created_at->format('d-m-Y H:i') }}</td>
                                                    <td>{{ $package->updated_at->format('d-m-Y H:i') }}</td>
                                                    
                                                    <td>
                                                        <a href="{{ url('admin/packages/edit/'.$package->id) }}">
                                                            <i class="fa fa-edit text-success"></i>
                                                        </a>
                                                        <a href="{{ url('admin/packages/delete/'.$package->id) }}">
                                                            <i class="fa fa-trash text-danger"></i>
                                                        </a>
                                                        <a href="{{ url('admin/packages/restore/'.$package->id) }}">
                                                            <i class="fa fa-undo text-warning"></i>
                                                        </a>
                                                        <a href="{{ url('admin/packages/toggle/'.$package->id) }}">
                                                            <i class="fa {{$package->is_active == 1 ? 'fa-toggle-on' : 'fa-toggle-off'}} text-info"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                     {{ $packages->links() }}
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

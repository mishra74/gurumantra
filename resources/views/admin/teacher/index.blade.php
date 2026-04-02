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

                                <a href="{{ route('add.teacher') }}" class="btn btn-primary mb-3">
                                    <i class="fa fa-plus"></i> Add
                                </a>

                                <a href="{{ route('class.all') }}" class="btn btn-danger mb-3">
                                    <i class="fa fa-angle-double-left"></i> Back
                                </a>

                                <h4 class="header-title">{{ $page }}</h4>

                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Phone</th>
                                                <th scope="col">Is Active</th>
                                               
                                                <th scope="col">Created At</th>
                                                <th scope="col">Updated At</th>
                                              
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($teacher as $key => $teache)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>

                                                    <td>{{ $teache->name }}</td>
                                                    <td>{!! $teache->email !!}</td>
                                                    <td>{!! $teache->phone !!}</td>
                                                    <td>
    @if($teache->deleted_at)
        <span class="badge bg-danger">Deleted</span>
    @else
        <span class="badge {{ $teache->is_active==1 ? 'bg-success' : 'bg-danger' }}">
            {{ $teache->is_active ? 'Active' : 'Inactive' }}
        </span>
    @endif
</td>
                                                    
                                                    <td>{{ $teache->created_at->format('d-m-Y H:i') }}</td>
                                                    <td>{{ $teache->updated_at->format('d-m-Y H:i') }}</td>
                                                    
                                                    <td>
                                                        <a href="{{ url('admin/teacher/edit/'.$teache->id) }}">
                                                            <i class="fa fa-edit text-success"></i>
                                                        </a>
                                                        <a href="{{ url('admin/teacher/delete/'.$teache->id) }}">
                                                            <i class="fa fa-trash text-danger"></i>
                                                        </a>
                                                        <a href="{{ url('admin/teacher/restore/'.$teache->id) }}">
                                                            <i class="fa fa-undo text-warning"></i>
                                                        </a>
                                                        <a href="{{ url('admin/teacher/toggle/'.$teache->id) }}">
                                                            <i class="fa {{$teache->is_active == 1 ? 'fa-toggle-on' : 'fa-toggle-off'}} text-info"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $teacher->links() }}
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

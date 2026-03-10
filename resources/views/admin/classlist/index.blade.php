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

                                <a href="{{ route('add.classlist', $class_room_id) }}" class="btn btn-primary mb-3">
                                    <i class="fa fa-plus"></i> Add
                                </a>

                                <h4 class="header-title">{{ $page }}</h4>

                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Title</th>
                                                <th scope="col">Is Active</th>
                                                <th scope="col">Created At</th>
                                                <th scope="col">Updated At</th>
                                              
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($classes as $key => $classe)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>

                                                    <td>{{ $classe->title }}</td>
                                                    <td>
    @if($classe->deleted_at)
        <span class="badge bg-danger">Deleted</span>
    @else
        <span class="badge {{ $classe->is_active==1 ? 'bg-success' : 'bg-danger' }}">
            {{ $classe->is_active ? 'Active' : 'Inactive' }}
        </span>
    @endif
</td>
                                                   
                                                    <td>{{ $classe->created_at->format('d-m-Y H:i') }}</td>
                                                    <td>{{ $classe->updated_at->format('d-m-Y H:i') }}</td>
                                                    
                                                    <td>
                                                        <a href="{{ $classe->start_url }}" class="btn btn-sm btn-success" target="_blank">
                                                            Start Class
                                                        </a>
                                                        <a href="{{ url('admin/class/edit/'.$classe->id) }}">
                                                            <i class="fa fa-edit text-success"></i>
                                                        </a>
                                                         @if($classe->deleted_at)
    <a href="{{ route('class.delete.permanent', $classe->id) }}"
       onclick="return confirm('Delete permanently?')">
        <i class="fa fa-trash text-danger"></i>
    </a>
@else
    <a href="{{ url('admin/class/delete/'.$classe->id) }}"
       onclick="return confirm('Move to trash?')">
        <i class="fa fa-trash text-danger"></i>
    </a>
@endif
                                                        <a href="{{ url('admin/class/restore/'.$classe->id) }}">
                                                            <i class="fa fa-undo text-warning"></i>
                                                        </a>
                                                        <a href="{{ url('admin/class/toggle/'.$classe->id) }}">
                                                            <i class="fa {{$classe->is_active == 1 ? 'fa-toggle-on' : 'fa-toggle-off'}} text-info"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $classes->links() }}
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

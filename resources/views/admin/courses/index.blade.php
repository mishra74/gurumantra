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

                                <a href="{{ route('add.courses') }}" class="btn btn-primary mb-3">
                                    <i class="fa fa-plus"></i> Add
                                </a>

                                <h4 class="header-title">{{ $page }}</h4>

                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Batches</th>
                                                <th scope="col">Title</th>
                                                <th scope="col">Description</th>
                                                <th scope="col">Is Active</th>
                                                <!--<th scope="col">Meta Key</th>-->
                                                <!--<th scope="col">Meta Description</th>-->
                                                <th scope="col">Created At</th>
                                                <th scope="col">Updated At</th>
                                              
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($courses as $key => $course)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td><a class="btn btn-primary" href="{{url('cource/batch/'.$course->id)}}"><i class="fa fa-plus"></i></a></td>

                                                    <td>{{ $course->title }}</td>
                                                    <td>{!! $course->description !!}</td>
                                                    <td>
    @if($course->deleted_at)
        <span class="badge bg-danger">Deleted</span>
    @else
        <span class="badge {{ $course->is_active==1 ? 'bg-success' : 'bg-danger' }}">
            {{ $course->is_active ? 'Active' : 'Inactive' }}
        </span>
    @endif
</td>
                                                    <!--<td>{{ $course->meta_key }}</td>-->
                                                    <!--<td>{!! $course->meta_description !!}</td>-->
                                                    <td>{{ $course->created_at->format('d-m-Y H:i') }}</td>
                                                    <td>{{ $course->updated_at->format('d-m-Y H:i') }}</td>
                                                    
                                                    <td>
                                                        <a href="{{ url('admin/courses/edit/'.$course->id) }}">
                                                            <i class="fa fa-edit text-success"></i>
                                                        @if($course->deleted_at)
    <a href="{{ route('courses.delete.permanent', $course->id) }}"
       onclick="return confirm('Delete permanently?')">
        <i class="fa fa-trash text-danger"></i>
    </a>
@else
    <a href="{{ url('admin/courses/delete/'.$course->id) }}"
       onclick="return confirm('Move to trash?')">
        <i class="fa fa-trash text-danger"></i>
    </a>
@endif

                                                        <a href="{{ url('admin/courses/restore/'.$course->id) }}">
                                                            <i class="fa fa-undo text-warning"></i>
                                                        </a>
                                                        <a href="{{ url('admin/courses/toggle/'.$course->id) }}">
                                                            <i class="fa {{$course->is_active == 1 ? 'fa-toggle-on' : 'fa-toggle-off'}} text-info"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $courses->links() }}
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

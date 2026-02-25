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

                                <a href="{{ url('admin/recording/add') }}" class="btn btn-primary mb-3">
                                    <i class="fa fa-plus"></i> Add
                                </a>
                              

                                <h4 class="header-title">{{ $page }}</h4>

                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Test</th>
                                                <th scope="col">Title</th>
                                                <th scope="col">Description</th>
                                                <th scope="col">Package</th>
                                                <th scope="col">Start_Date</th>
                                                <th scope="col">Validity</th>

                                                <th scope="col">IsActive</th>
                                                <th scope="col">CreatedAt</th>
                                                <th scope="col">UpdatedAt</th>
                                              
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($video as $key => $tes)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td><a class="btn btn-primary" href="{{url('admin/recording_create/'.$tes->id)}}"><i class="fa fa-plus"></i></a></td>


                                                    <td>{{ $tes->title }}</td>
                                                    <td>{!! $tes->description !!}</td>
                                                    <td>{!! $tes->mrp !!}</td>
                                                    <td>{!! $tes->start_date !!}</td>
                                                    <td>{!! $tes->validity !!}</td>
                                                    <td>
    @if($tes->deleted_at)
        <span class="badge bg-danger">Deleted</span>
    @else
        <span class="badge {{ $tes->is_active==1 ? 'bg-success' : 'bg-danger' }}">
            {{ $tes->is_active ? 'Active' : 'Inactive' }}
        </span>
    @endif
</td>
                                                   
                                                    <td>{{ $tes->created_at->format('d-m-Y H:i') }}</td>
                                                    <td>{{ $tes->updated_at->format('d-m-Y H:i') }}</td>
                                                    
                                                    <td>
                                                        <a href="{{ url('admin/recording/edit/'.$tes->id) }}">
                                                            <i class="fa fa-edit text-success"></i>
                                                        </a>
                                                       @if($tes->deleted_at)
    <a href="{{ route('recording.delete.permanent', $tes->id) }}"
       onclick="return confirm('Delete permanently?')">
        <i class="fa fa-trash text-danger"></i>
    </a>
@else
    <a href="{{ url('admin/recording/delete/'.$tes->id) }}"
       onclick="return confirm('Move to trash?')">
        <i class="fa fa-trash text-danger"></i>
    </a>
@endif
                                                        <a href="{{ url('admin/recording/restore/'.$tes->id) }}">
                                                            <i class="fa fa-undo text-warning"></i>
                                                        </a>
                                                        <a href="{{ url('admin/recording/toggle/'.$tes->id) }}">
                                                            <i class="fa {{$tes->is_active == 1 ? 'fa-toggle-on' : 'fa-toggle-off'}} text-info"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    
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

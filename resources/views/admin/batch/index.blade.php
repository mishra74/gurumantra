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

                                <a href="{{ route('add.batch') }}" class="btn btn-primary mb-3">
                                    <i class="fa fa-plus"></i> Add
                                </a>
                                <a href="{{ route('all.courses') }}" class="btn btn-danger mb-3">
                                    <i class="fa fa-angle-double-left"></i> Back
                                </a>

                                <h4 class="header-title">{{ $page }}</h4>

                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Title</th>
                                                <th scope="col">Description</th>
                                                <th scope="col">Package</th>
                                                <th scope="col">Start_Date</th>
                                                

                                                <th scope="col">IsActive</th>
                                                <th scope="col">CreatedAt</th>
                                                <th scope="col">UpdatedAt</th>
                                              
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($batches as $key => $batch)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>

                                                    <td>{{ $batch->title }}</td>
                                                    <td>{!! $batch->description !!}</td>
                                                    <td>{!! $batch->mrp !!}</td>
                                                    <td>{!! $batch->start_date !!}</td>
                                                   
                                                    <td>
    @if($batch->deleted_at)
        <span class="badge bg-danger">Deleted</span>
    @else
        <span class="badge {{ $batch->is_active==1 ? 'bg-success' : 'bg-danger' }}">
            {{ $batch->is_active ? 'Active' : 'Inactive' }}
        </span>
    @endif
</td>
                                                   
                                                    <td>{{ $batch->created_at->format('d-m-Y H:i') }}</td>
                                                    <td>{{ $batch->updated_at->format('d-m-Y H:i') }}</td>
                                                    
                                                    <td>
                                                        <a href="{{ url('admin/batch/edit/'.$batch->id) }}">
                                                            <i class="fa fa-edit text-success"></i>
                                                        </a>
                                                         @if($batch->deleted_at)
    <a href="{{ route('batch.delete.permanent', $batch->id) }}"
       onclick="return confirm('Delete permanently?')">
        <i class="fa fa-trash text-danger"></i>
    </a>
@else
    <a href="{{ url('admin/batch/delete/'.$batch->id) }}"
       onclick="return confirm('Move to trash?')">
        <i class="fa fa-trash text-danger"></i>
    </a>
@endif
                                                        
                                                        <a href="{{ url('admin/batch/restore/'.$batch->id) }}">
                                                            <i class="fa fa-undo text-warning"></i>
                                                        </a>
                                                        <a href="{{ url('admin/batch/toggle/'.$batch->id) }}">
                                                            <i class="fa {{$batch->is_active == 1 ? 'fa-toggle-on' : 'fa-toggle-off'}} text-info"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $batches->links() }}
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

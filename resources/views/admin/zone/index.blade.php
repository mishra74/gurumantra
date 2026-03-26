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

                                <a href="{{ route('add.zone') }}" class="btn btn-primary mb-3">
                                    <i class="fa fa-plus"></i> Add
                                </a>

                                <h4 class="header-title">{{ $page }}</h4>

                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Title</th>
                                                <th scope="col">Center Add</th>
                                                <th scope="col">Is_active</th>
                                                <th scope="col">Created_at</th>       
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(isset($zones) )
                                            @foreach($zones as $key=>$zone)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$zone->title}}</td>
                                               <td><a href="{{route('all.center',$zone->id)}}">Add</a></td>
                                                <td>
    @if($zone->deleted_at)
        <span class="badge bg-danger">Deleted</span>
    @else
        <span class="badge {{ $zone->is_active==1 ? 'bg-success' : 'bg-danger' }}">
            {{ $zone->is_active ? 'Active' : 'Inactive' }}
        </span>
    @endif
</td>
                                                <td>{{$zone->created_at}}</td>
                                                <td>{{$zone->updated_at}}</td>
                                                <td>
                                                        <a href="{{ url('admin/zone/edit/'.$zone->id) }}">
                                                            <i class="fa fa-edit text-success"></i>
                                                        </a>
                                                        <a href="{{ url('admin/zone/delete/'.$zone->id) }}">
                                                            <i class="fa fa-trash text-danger"></i>
                                                        </a>
                                                       
                                                        <a href="{{ url('admin/zone/toggle/'.$zone->id) }}">
                                                            <i class="fa {{$zone->is_active == 1 ? 'fa-toggle-on' : 'fa-toggle-off'}} text-info"></i>
                                                        </a>
                                                    </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                            
                                        </tbody>
                                    </table>
    {{ $zones->links() }}
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

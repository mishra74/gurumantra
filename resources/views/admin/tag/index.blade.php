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

                                <a href="{{ route('add.tags') }}" class="btn btn-primary mb-3">
                                    <i class="fa fa-plus"></i> Add
                                </a>

                                <h4 class="header-title">{{ $page }}</h4>

                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Question Tag</th>
                                                <th scope="col">Question Add</th>
                                                <th scope="col">Total Question</th>
                                               
                                                <th scope="col">Is_active</th>
                                                <th scope="col">Created_at</th>       
                                                <th scope="col">Updated_at</th>                                                
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(isset($tags) )
                                            @foreach($tags as $key=>$tag)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$tag->name}}</td>
                                                <td><a class="btn btn-primary" href="{{url('questions_bank/all/'.$tag->id)}}"><i class="fa fa-plus"></i></a></td>

                                                <td>0</td>
                                               
                                                <td>
    @if($tag->deleted_at)
        <span class="badge bg-danger">Deleted</span>
    @else
        <span class="badge {{ $tag->is_active==1 ? 'bg-success' : 'bg-danger' }}">
            {{ $tag->is_active ? 'Active' : 'Inactive' }}
        </span>
    @endif
</td>
                                                <td>{{$tag->created_at}}</td>
                                                <td>{{$tag->updated_at}}</td>
                                                <td>
                                                        <a href="{{ url('admin/tag/edit/'.$tag->id) }}">
                                                            <i class="fa fa-edit text-success"></i>
                                                        </a>
                                                        <a href="{{ url('admin/tag/delete/'.$tag->id) }}">
                                                            <i class="fa fa-trash text-danger"></i>
                                                        </a>
                                                        <a href="{{ url('admin/tag/restore/'.$tag->id) }}">
                                                            <i class="fa fa-undo text-warning"></i>
                                                        </a>
                                                        <a href="{{ url('admin/tag/toggle/'.$tag->id) }}">
                                                            <i class="fa {{$tag->is_active == 1 ? 'fa-toggle-on' : 'fa-toggle-off'}} text-info"></i>
                                                        </a>
                                                    </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                            
                                        </tbody>
                                    </table>
    {{ $tags->links() }}
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

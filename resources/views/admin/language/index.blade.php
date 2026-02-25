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

                                <a href="{{ route('add.language') }}" class="btn btn-primary mb-3">
                                    <i class="fa fa-plus"></i> Add
                                </a>

                                <h4 class="header-title">{{ $page }}</h4>

                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Language</th>
                                                <th scope="col">Created_at</th>       
                                                <th scope="col">Updated_at</th>                                                
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(isset($languages) )
                                            @foreach($languages as $key=>$tag)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$tag->name}}</td>


                                                
                                                <td>{{$tag->created_at}}</td>
                                                <td>{{$tag->updated_at}}</td>
                                                <td>
                                                        <a href="{{ url('admin/language/edit/'.$tag->id) }}">
                                                            <i class="fa fa-edit text-success"></i>
                                                        </a>
                                                        <a href="{{ url('admin/language/delete/'.$tag->id) }}">
                                                            <i class="fa fa-trash text-danger"></i>
                                                        </a>
                                                        <!--<a href="{{ url('admin/language/restore/'.$tag->id) }}">-->
                                                        <!--    <i class="fa fa-undo text-warning"></i>-->
                                                        <!--</a>-->
                                                        <!--<a href="{{ url('admin/language/toggle/'.$tag->id) }}">-->
                                                        <!--    <i class="fa {{$tag->is_active == 1 ? 'fa-toggle-on' : 'fa-toggle-off'}} text-info"></i>-->
                                                        <!--</a>-->
                                                    </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                            
                                        </tbody>
                                    </table>
    {{ $languages->links() }}
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

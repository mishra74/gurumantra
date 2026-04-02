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

                                <a href="{{ route('add.questionbank') }}" class="btn btn-primary mb-3">
                                    <i class="fa fa-plus"></i> Add
                                </a>

                                <h4 class="header-title">{{ $page }}</h4>

                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Question Bank</th>
                                                <th scope="col">Marks</th>
                                                <th scope="col">Negatiev_Marks</th>
                                                <th scope="col">TotalOptions</th>
                                                <th scope="col">Is_active</th>
                                                <th scope="col">Created_at</th>       
                                                <th scope="col">Updated_at</th>                                                
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(isset($question) )
                                            @foreach($question as $key=>$quest)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{!!$quest->question!!}</td>
                                                <td>{{$quest->marks}}</td>
                                                <td>{{$quest->negative_marks}}</td>
                                                <td>{{$quest->total_options}}</td>
                                              
                                                <td>
    @if($quest->deleted_at)
        <span class="badge bg-danger">Deleted</span>
    @else
        <span class="badge {{ $quest->is_active==1 ? 'bg-success' : 'bg-danger' }}">
            {{ $quest->is_active ? 'Active' : 'Inactive' }}
        </span>
    @endif
</td>
                                                <td>{{$quest->created_at}}</td>
                                                <td>{{$quest->updated_at}}</td>
                                                <td>
                                                        <a href="{{ url('admin/questions/edit/'.$quest->id) }}">
                                                            <i class="fa fa-edit text-success"></i>
                                                        </a>
                                                        <a href="{{ url('admin/questions/delete/'.$quest->id) }}">
                                                            <i class="fa fa-trash text-danger"></i>
                                                        </a>
                                                        <a href="{{ url('admin/questions/restore/'.$quest->id) }}">
                                                            <i class="fa fa-undo text-warning"></i>
                                                        </a>
                                                        <a href="{{ url('admin/questions/toggle/'.$quest->id) }}">
                                                            <i class="fa {{$quest->is_active == 1 ? 'fa-toggle-on' : 'fa-toggle-off'}} text-info"></i>
                                                        </a>
                                                    </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                            
                                        </tbody>
                                    </table>
                                    {{ $question->links() }}
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

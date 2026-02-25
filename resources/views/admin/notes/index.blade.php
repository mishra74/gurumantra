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

                                    <a href="{{route('add.notes')}}" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> Add</a>

                                        <h4 class="header-title">{{$page}}</h4>
                                        

                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Title</th>
                                                        <th scope="col">SubTitle</th>
                                                        <th scope="col">PDF</th>
                                                        <th scope="col">Content</th>
                                                        <th scope="col">Is_active</th>
                                                        <th scope="col">Created_at</th>
                                                        <th scope="col">Updated_at</th>
                                                        <th scope="col">Action</th>
                                                      
                                                    </tr>
                                                </thead>
                                               <tbody>

                                               @if(isset($dailycurrent))
                                               @foreach($dailycurrent as $key => $daily)
                                               <tr>
                                                        <td>{{$key  + 1}}</td>
                                                        <td>{{$daily->title}}</td>
                                                        <td>{{$daily->sub_title}}</td>
                                                        <td><a href="{{ asset('storage/app/public/' . $daily->pdf)}}" target="_blank"><i class="fa fa-eye"></i></a></td>
<td>
    <i class="fa fa-eye text-primary"
       style="cursor:pointer"
       data-content="{!! htmlspecialchars($daily->content, ENT_QUOTES, 'UTF-8') !!}"
       onclick="texteditcall(this)">
    </i>
</td>


                                                        
                                                        <td><span class="badge {{$daily->is_active == 1 ? 'bg-success' : 'bg-danger'}}">{{$daily->is_active == 1 ? 'YES' : 'No'}}</span>

                                                        <td>{{$daily->created_at}}</td>
                                                        <td>{{$daily->updated_at}}</td>
                                                        <td><a href="{{url('admin/notes/edit/'.$daily->id)}}"><i class="fa fa-edit text-success"></i></a> <a href="{{url('admin/notes/delete/'.$daily->id)}}"><i class="fa fa-trash text-danger"></i></a></td>
                                                    </tr>
                                               @endforeach
                                               @endif
                                                

                                               </tbody>
                                            </table>
                                            

                                        </div> <!-- end table-responsive-->

                                    </div> <!-- end card body-->
                                </div> <!-- end card -->
                            </div><!-- end col-->
                        </div>
                       
                    </div> <!-- container -->

                </div> <!-- content -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

        </div>
        <!-- Content Preview Modal -->
<div class="modal fade" id="contentModal" tabindex="-1" aria-labelledby="contentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-scrollable">
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title" id="contentModalLabel">Content Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <textarea class="ckeditor" id="textedi"></textarea>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Close
                </button>
            </div>

        </div>
    </div>
</div>

        <!-- END wrapper -->
     <script>
function texteditcall(el) {
    let content = el.getAttribute('data-content');

    let modal = new bootstrap.Modal(document.getElementById('contentModal'));
    modal.show();

    if (CKEDITOR.instances.textedi) {
        CKEDITOR.instances.textedi.setData(content);
    } else {
        CKEDITOR.replace('textedi');
        CKEDITOR.instances.textedi.setData(content);
    }
}
</script>




        @include('admin.layouts.footer')

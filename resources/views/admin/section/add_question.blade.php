
       
       <!-- Begin page -->
       @include('admin.layouts.header')

        <div class="wrapper">

        @include('admin.layouts.topbar')
        @include('admin.layouts.sidebar')
            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Live Classes</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Add Teacher</a></li>
                                            <li class="breadcrumb-item active">{{$page}}</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">{{$page}}</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        

                        <!-- final Form row -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                        <form method="post" action="{{route('section.store')}}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row g-2">
                                                <div class="mb-3 col-md-6">
                                                    <label for="inputEmail4" class="form-label">Question Bank</label>
                                                    <select class="form-control" name="question_id" id="questionSelect">
    <option>--select option--</option>
    @if(isset($QuestionBank))
    @foreach($QuestionBank as $Question)
        <option value="{{ $Question->id }}">{{ $Question->name }}</option>
    @endforeach
    @endif
</select>
                                                    @error('question_id') <small class="text-danger">{{ $message }}</small> @enderror

                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label for="inputPassword4" class="form-label">Question Tag</label>
                                                    <select class="form-control" name="question_id">
                                                    <option>--select option</option>
                                                    @if(isset($QuestionBank))
                                                    @foreach($QuestionBank as $Question)
                                                    <option>{{$Question->name}}</option>
                                                    @endforeach
                                                    @endif
                                                    </select>
                                                    @error('marks') <small class="text-danger">{{ $message }}</small> @enderror

                                                </div>

                                                <div id="questionDetails" class="mt-3"></div>


                                            </div>
                                                 <button type="submit" class="btn btn-primary">Add</button> 
                                            </div>
                                        </form>   

                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->
                        
                    </div> <!-- container -->

                </div> <!-- content -->

             
                

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

        </div>
        <!-- END wrapper -->

        
        @include('admin.layouts.footer')
        <script>
$(document).on('change', '#questionSelect', function() {
    let questionId = $(this).val();

    if(questionId) {
        $.ajax({
    url: "{{ url('admin/get-question') }}/" + questionId,
    type: "GET",
    success: function(res) {
        if(res.status) {
            let html = `
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Question</th>
                            <th>Marks</th>
                            <th>Total Options</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
            `;

            res.data.forEach(q => {
                html += `<tr>
                        <td>${q.id}</td>
                        <td>${q.question}</td>
                        <td>${q.marks}</td>
                        <td>${q.total_options}</td>
                        <td>
                            <button type="button" class="btn btn-success btn-sm addQuestion" data-id="${q.id}">Add</button>
                        </td>
                    </tr>`;
            });

            html += `</tbody></table>`;
            $('#questionDetails').html(html);
        } else {
            $('#questionDetails').html('<p class="text-danger">No data found</p>');
        }
    }
});

    }
});



$(document).on('click', '.addQuestion', function() {
    let questionId = $(this).data('id');

    $.ajax({
        url: "{{ route('question.add') }}",
        type: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            question_id: questionId
        },
        success: function(res) {
            console.log("questionId=",res);
            if (res.status) {
                alert(res.message);
                // Optionally, remove row from table after adding
                $(`button[data-id="${questionId}"]`).closest('tr').remove();
            } else {
                alert(res.message);
            }
        },
        error: function(xhr) {
            alert('Error occurred while adding question');
        }
    });
});

</script>

       
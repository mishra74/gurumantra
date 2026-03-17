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
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">My Courses</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Add Courses</a></li>
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
                                <h4 class="header-title">{{$page}}</h4>


                                <form method="post" action="{{ route('classlist.store') }}">
                                    @csrf

                                    <div class="row g-2">

                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Title</label>
                                            <input type="text" class="form-control" name="title"
                                                value="{{old('title')}}" required>
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Class Time</label>
                                            <input type="time" class="form-control" name="time" value="{{old('time')}}"
                                                required>
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Start Date</label>
                                            <input type="date" class="form-control" name="start_date"
                                                value="{{old('start_date')}}" required>
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <input type="hidden" name="class_room_id" value="{{$class_room_id}}">
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Live By</label>

                                            <select name="liveBy" id="liveBy" class="form-control">
                                                <option value="zoom">Zoom</option>
                                                <option value="youtube">You Tube</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label">Is Active</label>
                                            <select class="form-control" name="is_active">
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-md-6 youtube" style="display:none">
    <label class="form-label">Embed YouTube URL</label>
    <input type="text" class="form-control" name="embedUrl" id="embedUrl"
        value="{{old('embedUrl')}}">
</div>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Create Class</button>

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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {

        function toggleYoutubeField() {
            let liveBy = $('#liveBy').val();

            if (liveBy === 'youtube') {
                $('.youtube').show();
                $('#embedUrl').attr('required', true);
            } else {
                $('.youtube').hide();
                $('#embedUrl').removeAttr('required');
            }
        }

        // On change
        $('#liveBy').on('change', function () {
            toggleYoutubeField();
        });

        // On page load (for old values)
        toggleYoutubeField();
    });
</script>

@include('admin.layouts.footer')
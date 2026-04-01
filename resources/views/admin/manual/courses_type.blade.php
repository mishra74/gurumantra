
<style>
    .course_type{
        margin-left: 100px;
    }
    </style>

    

@include('admin.layouts.header')

        <!-- Begin page -->
        <div class="wrapper">

            
            <!-- ========== Topbar Start ========== -->
            @include('admin.layouts.topbar')

            <!-- ========== Topbar End ========== -->

            @include('admin.layouts.sidebar')
  
    <div class="container pb-5 course_type" >
        <div class="row g-4">
            <div class="col-md-6 col-lg-2">
            </div>
            <div class="col-md-6 col-lg-2">
                <div class="test-card p-3 shadow-sm bg-white text-center h-60 rounded-4">
                    <img src="{{asset('frontend/images/icons/batch.png')}}" class="img-fluid rounded-3 mb-2"
                        style="height: 100px; object-fit: contain;" alt="Batch">
                    <h6 class="fw-bold mb-3">Batches</h6>
                    <a href="{{route('admin.batches.series')}}"
                        class="btn btn-orange w-100 rounded-pill fw-bold py-2 small">Continue / जारी रखें</a>
                </div>
            </div>

            <div class="col-md-6 col-lg-2">
                <div class="test-card p-3 shadow-sm bg-white text-center h-60 rounded-4">
                    <img src="{{asset('frontend/images/icons/test-vol.png')}}" class="img-fluid rounded-3 mb-2"
                        style="height: 100px; object-fit: contain;" alt="Test Volume">
                    <h6 class="fw-bold mb-3">Test Volume</h6>
                    <a href="{{route('admin.test.series')}}"
                        class="btn btn-orange w-100 rounded-pill fw-bold py-2 small">Continue / जारी रखें</a>
                </div>
            </div>

            <div class="col-md-6 col-lg-2">
                <div class="test-card p-3 shadow-sm bg-white text-center h-60 rounded-4">
                    <img src="{{asset('frontend/images/icons/library.png')}}" class="img-fluid rounded-3 mb-2"
                        style="height: 100px; object-fit: contain;" alt="e-Library">
                    <h6 class="fw-bold mb-3">e-Library</h6>
                    <a href="{{route('admin.notes.series')}}"
                        class="btn btn-orange w-100 rounded-pill fw-bold py-2 small">Continue / जारी रखें</a>
                </div>
            </div>

            <div class="col-md-6 col-lg-2">
                <div class="test-card p-3 shadow-sm bg-white text-center h-100 rounded-4">
                    <img src="{{asset('frontend/images/icons/store.png')}}" class="img-fluid rounded-3 mb-3"
                        style="height: 100px; object-fit: contain;" alt="Knowledge Store">
                    <h6 class="fw-bold mb-3">Knowledge Store</h6>
                    <a href="{{route('admin.recode.series')}}" class="btn btn-orange w-100 rounded-pill fw-bold py-2 small">Continue / जारी रखें</a>
                </div>
            </div>

        </div>
    </div>
        </div>
  
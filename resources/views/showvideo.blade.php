
      
@include('layouts.header')
        <!-- Services Start -->
        <div class="container-fluid py-5">
    <div class="container">
        <div class="row">
            <!-- Left Side: Video Section -->
            <div class="col-md-6">
                <div class="video-container">
                    <video controls class="w-100 rounded shadow">
                        <source src="{{ asset('storage/videos/sample.mp4') }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>

            <!-- Right Side: Tabs Section -->
            <div class="col-md-6">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="comment-tab" data-bs-toggle="tab" data-bs-target="#comment" type="button" role="tab">Post Comment</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pdf-tab" data-bs-toggle="tab" data-bs-target="#pdf" type="button" role="tab">PDF</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="content-tab" data-bs-toggle="tab" data-bs-target="#content" type="button" role="tab">Content</button>
                    </li>
                </ul>

                <div class="tab-content p-3 border border-top-0 rounded-bottom shadow-sm" id="myTabContent">
                    <!-- Post Comment Tab -->
                    <div class="tab-pane fade show active" id="comment" role="tabpanel">
                        <form action="{{ url('comment/store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <textarea name="comment" class="form-control" rows="4" placeholder="Write your comment..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit Comment</button>
                        </form>
                    </div>

                    <!-- PDF Tab -->
                    <div class="tab-pane fade" id="pdf" role="tabpanel">
                        @if($pdf->pdf_file_question !='')
                            <a href="{{ asset('storage/' . $pdf->pdf_file_question)}}" target="_blank" class="btn btn-danger">View Question PDF</a>
                        @endif

                      
                    </div>

                    <!-- Content Tab -->
                    <div class="tab-pane fade" id="content" role="tabpanel">
                        <p>{{ $pdf->description ?? 'No content available.' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


        <!-- Footer Start -->
 @include('layouts.footer')

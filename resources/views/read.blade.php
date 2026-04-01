@include('layouts.header')

@section('meta')
<meta property="og:type" content="article">
<meta property="og:title" content="{{ $content->title }}">
<meta property="og:description" content="{{ Str::limit(strip_tags($content->content), 150) }}">
<meta property="og:image" content="{{ $thumbnail }}">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:site_name" content="Your Website Name">

<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
@endsection

<style>
/* ===== Watermark Styling ===== */
.content-wrapper {
    position: relative;
    padding: 30px;
}

.watermark {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) rotate(-25deg);
    opacity: 0.07;
    pointer-events: none;
    text-align: center;
    z-index: 0;
}

.watermark img {
    width: 250px;
    margin-bottom: 10px;
}

.watermark-text {
    font-size: 28px;
    font-weight: bold;
    color: #000;
}

.content-inner {
    position: relative;
    z-index: 1;
}

/* ===== Social Share ===== */
.social-share {
    display: flex;
    justify-content: center;
    gap: 20px;
    flex-wrap: wrap;
    margin-top: 15px;
}

.social-share a {
    color: #444;
    transition: 0.3s;
}

.social-share a:hover {
    color: #0d6efd;
}

.socialSize {
    font-size: 45px;
}
</style>

<!-- ===== Content Section ===== -->
<div class="container-fluid feature py-5">
    <div class="container py-5">
        <div class="content-wrapper">

            <!-- Watermark -->
            <div class="watermark">
                                <div class="watermark-text">{{ url('/') }}</div>

                <img src="{{ asset('frontend/images/logo.png') }}" alt="Logo">
            </div>

            <!-- Main Content -->
            <div class="content-inner text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                <h4 class="text-primary">Read Content</h4>
                <h1 class="display-5 mb-1 text-capitalize">{{ $content->title }}</h1>
                <h4 class="text-capitalize text-gray">{{ $content->sub_title }}</h4>

                <div class="mb-3 text-start">
                    {!! $content->content !!}
                </div>

                <a href="javascript:void(0)">
                    <i class="fa fa-share" data-bs-toggle="modal" data-bs-target="#staticBackdrop"> Share</i>
                </a>
            </div>

        </div>
    </div>
</div>

@include('layouts.footer')

<!-- ===== Share Modal ===== -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title">Share</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <div class="social-share">

                    <!-- Facebook -->
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank">
                        <i class="fab fa-facebook-f socialSize" style="color:blue"></i>
                    </a>

                    <!-- Twitter -->
                    <a href="https://twitter.com/intent/tweet?text={{ $content->title }}&url={{ urlencode(url()->current()) }}" target="_blank">
                        <i class="fab fa-twitter socialSize" style="color:skyblue"></i>
                    </a>

                    <!-- LinkedIn -->
                    <a href="https://www.linkedin.com/sharing/share-offsite?mini=true&url={{ url()->current() }}" target="_blank">
                        <i class="fab fa-linkedin-in socialSize" style="color:blue"></i>
                    </a>

                    <!-- WhatsApp -->
                    <a href="https://wa.me/?text={{ urlencode($content->title . ' ' . url()->current()) }}" target="_blank">
                        <i class="fab fa-whatsapp socialSize" style="color:green"></i>
                    </a>

                    <!-- Reddit -->
                    <a href="https://www.reddit.com/submit?url={{ url()->current() }}" target="_blank">
                        <i class="fab fa-reddit socialSize" style="color:red"></i>
                    </a>

                </div>

                <!-- Copy Link -->
                <div style="display:flex; gap:10px; align-items:center; margin-top:15px;">
                    <input type="text" id="link" class="form-control" readonly>
                    <button class="btn btn-success" onclick="copyLink()">Copy</button>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<!-- ===== Scripts ===== -->
<script>
    document.getElementById('link').value = window.location.href;

    function copyLink() {
        navigator.clipboard.writeText(window.location.href)
            .then(() => alert("Link copied!"))
            .catch(() => alert("Copy failed"));
    }
</script>
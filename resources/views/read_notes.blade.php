@extends('layouts.master')

@section('content')

<style>
/* ===== Full Page Watermark ===== */
.content-wrapper {
    position: relative;
    padding: 30px;
    overflow: hidden;
}

/* Repeating watermark layer */
.watermark {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;

    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;

    opacity: 0.08;
    pointer-events: none;
    z-index: 0;
}

/* Each watermark item */
.watermark-item {
    width:fit-content;
    margin: 40px;
    text-align: center;
    transform: rotate(-25deg);
}

.watermark-item img {
    width: 120px;
    margin-bottom: 5px;
}

.watermark-text {
    font-size: 14px;
    font-weight: bold;
    color: #000;
}

/* Content above watermark */
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
.heading-notes{
    position: fixed;
    top: 120px;
    left: 30%;
    z-index: 100;
}
.heading-notes img{
    left: 50%;
}
</style>

<!-- ===== Content Section ===== -->
<div class="container-fluid feature py-5">
    <div class="container py-5">
        <div class="heading-notes">
            <!-- <img src="{{ asset('frontend/images/logo.png') }}" alt="Logo" width="100"> -->
 <h1 class="display-5 mb-1 text-capitalize " style="background-color: #fff;">{{ $content->title }}</h1></div>
        <div class="content-wrapper">

            <!-- Watermark -->

            <!-- Watermark -->
<div class="watermark">

    @for($i = 0; $i < 20; $i++)
        <div class="watermark-item">
            <div class="watermark-text">{{ url('/') }}</div>
        </div>
    @endfor
</div>

            <!-- Main Content -->
            <div class="content-inner text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                                                
                <h4 class="text-primary">Read Content</h4>
               
                <h4 class="text-capitalize text-gray">{{ $content->sub_title }}</h4>

                <div class="mb-3 text-start">
                    {!! $content->pdf_enter_question !!}
                </div>

                <a href="javascript:void(0)">
                    <i class="fa fa-share" data-bs-toggle="modal" data-bs-target="#staticBackdrop"> Share</i>
                </a>
                                <img src="{{ asset('frontend/images/logo.png') }}" alt="Logo" width="100">

            </div>

        </div>
    </div>
</div>

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
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ $url }}" target="_blank">
                        <i class="fab fa-facebook-f socialSize" style="color:blue"></i>
                    </a>

                    <!-- Twitter -->
                    <a href="https://twitter.com/intent/tweet?text={{ $title }}&url={{ $url }}" target="_blank">
                        <i class="fab fa-twitter socialSize" style="color:skyblue"></i>
                    </a>

                    <!-- LinkedIn -->
                    <a href="https://www.linkedin.com/sharing/share-offsite?mini=true&url={{ $url }}" target="_blank">
                        <i class="fab fa-linkedin-in socialSize" style="color:blue"></i>
                    </a>

                    <!-- WhatsApp -->
                    <a href="https://wa.me/?text={{ urlencode($title . ' ' . $url) }}" target="_blank">
                        <i class="fab fa-whatsapp socialSize" style="color:green"></i>
                    </a>

                    <!-- Reddit -->
                    <a href="https://www.reddit.com/submit?url={{ $url }}" target="_blank">
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

@endsection
@include('layouts.header')
<style>

.social-share {
    display: flex;
    justify-content: center;
    gap: 20px; /* icons ke beech gap */
    flex-wrap: wrap; /* chhoti screen pe line break ho jaye */
    margin-top: 15px;
}

.social-share a {
    color: #444; /* default icon color */
    transition: 0.3s;
}

.social-share a:hover {
    color: #0d6efd; /* hover pe bootstrap primary color */
}

.socialSize {
    font-size: 45px;
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

</style>        
<div class="watermark">

    @for($i = 0; $i < 20; $i++)
        <div class="watermark-item">
            <div class="watermark-text">{{ url('/') }}</div>
        </div>
    @endfor
</div>
<div class="container-fluid feature py-5">
            <div class="container py-5">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                    <h4 class="text-primary">Read Content</h4>
                    <h1 class="display-5 mb-1 text-capitalize">{{$content->title}}</h1>
                    <h4 class="text-capitalize text-gray">{{$content->sub_title}}</h4>
                    <p class="mb-0 text-capitalize">{!!$content->pdf_enter_question!!}</p>
                    <a href="javascript:void(0)"><i class="fa fa-share" data-bs-toggle="modal" data-bs-target="#staticBackdrop"> Share</i></a>
                </div>
                
            </div>
        </div>

        @include('layouts.footer')

        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Share Buttons</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="social-share">
    <a href="https://www.facebook.com/sharer/sharer.php?u={{ $url }}" target="_blank">
    <i class="fab fa-facebook-f socialSize" style="color:blue"></i> 
    </a>

    <a href="https://twitter.com/intent/tweet?text={{ $title }}&url={{ $url }}" target="_blank">
    <i class="fab fa-twitter socialSize" style="color:skyblue"></i> 
    </a>

    <a href="https://www.linkedin.com/sharing/share-offsite?mini=true&url={{ $url }}" target="_blank">
    <i class="fab fa-linkedin-in socialSize" style="color:blue"></i> 
    </a>

    
    <a href="https://wa.me/?text={{ $url }}" target="_blank">
    <i class="fab fa-whatsapp socialSize" style="color:green"></i> 
    </a>

    <a href="https://www.reddit.com/submit?url={{ $url }}" target="_blank">
    <i class="fab fa-reddit socialSize" style="color:red"></i> 
    </a>
</div>
<div style="display:flex; gap:10px; align-items:center;">
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
<script>
    document.getElementById('link').value = window.location.href;

    function copyLink() {
        navigator.clipboard.writeText(window.location.href)
            .then(() => alert("Link copied!"))
            .catch(() => alert("Copy failed"));
    }
</script>

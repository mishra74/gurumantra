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

</style>        

     <div class="container-fluid feature py-5">
            <div class="container py-5">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                    <h4 class="text-primary">Read Question Carefully</h4>
                    <h1 class="display-5 mb-1 text-capitalize">{{$pdf->title}}</h1>
                    
                    <p class="mb-0 text-capitalize">{!!$pdf->pdf_enter_question!!}</p>
                </div>
                
            </div>
        </div>

        @include('layouts.footer')

       {{--<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>--}} 

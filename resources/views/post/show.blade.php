@php
    $url = urlencode(url()->current());
    $title = urlencode($post->content);
@endphp

<div class="social-share">
    <a href="https://www.facebook.com/sharer/sharer.php?u={{ $url }}" target="_blank">
        Facebook
    </a>

    <a href="https://twitter.com/intent/tweet?text={{ $title }}&url={{ $url }}" target="_blank">
        Twitter
    </a>

    <a href="https://www.linkedin.com/sharing/share-offsite?mini=true&url={{ $url }}" target="_blank">
        LinkedIn
    </a>

    
    <a href="https://wa.me/?text={{ $url }}" target="_blank">
        WhatsApp
    </a>

    <a href="https://www.reddit.com/submit?url={{ $url }}" target="_blank">
        Reddit
    </a>
</div>

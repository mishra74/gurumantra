@extends('layouts.master')
@section('content')

<div class="container mt-4">
    <div class="row">
        <div class="col-12">

            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h4 class="mb-1">Live Class</h4>
                    <p class="text-muted mb-0 small">Welcome, <strong>{{ $username }}</strong></p>
                </div>

                @if($embedUrl)
                <!-- Quality Selector -->
                <select id="quality" class="form-select form-select-sm" style="width:auto;">
                    <option value="auto">Auto</option>
                    <option value="hd1080">1080p</option>
                    <option value="hd720">720p</option>
                    <option value="large">480p</option>
                    <option value="medium">360p</option>
                </select>
                @endif
            </div>

            @if($embedUrl)
            <div class="card shadow-sm">
                <div class="card-body p-2">

                    <!-- Video -->
                    <div class="video-container" style="max-width:800px;margin:auto;">
                        <div style="position:relative;padding-bottom:56.25%;height:0;">
                           
                                <iframe id="youtube-player" src="https://www.youtube.com/embed/{{ $embedUrl }}?
modestbranding=1
&rel=0
&controls=1
&iv_load_policy=3
&disablekb=1
&playsinline=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen
                                    style="position:absolute;top:0;left:0;width:100%;height:100%;">
                                </iframe>
                            


                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="d-flex justify-content-between mt-2">
                        <span class="badge bg-danger">● LIVE</span>

                        <div>
                            <button onclick="reloadPlayer()" class="btn btn-sm btn-light">Reload</button>
                        </div>
                    </div>

                </div>
            </div>
            @endif

        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
let player;
let playerReady = false;

// Load API
function loadYouTubeAPI() {
    if (window.YT && YT.Player) {
        initPlayer();
        return;
    }

    let tag = document.createElement('script');
    tag.src = "https://www.youtube.com/iframe_api";
    document.body.appendChild(tag);
}

// Ready
window.onYouTubeIframeAPIReady = function() {
    initPlayer();
};

function initPlayer() {
    if (!document.getElementById('youtube-player')) return;

    player = new YT.Player('youtube-player', {
        events: {
            onReady: function() {
                playerReady = true;
            }
        }
    });
}

// Quality change
document.addEventListener('DOMContentLoaded', function() {
    const quality = document.getElementById('quality');

    if (quality) {
        quality.addEventListener('change', function() {
            if (!playerReady) return;

            let q = this.value;

            if (q !== 'auto') {
                try {
                    player.setPlaybackQuality(q);
                } catch (e) {
                    console.log('Quality not supported');
                }
            }
        });
    }

    loadYouTubeAPI();
});

// Reload
function reloadPlayer() {
    if (player && player.loadVideoById) {
        player.loadVideoById('{{ $embedUrl }}');
    }
}

// Disable right click
document.addEventListener('contextmenu', function(e) {
    if (e.target.closest('#youtube-player')) {
        e.preventDefault();
    }
});
</script>
@endpush


@push('styles')
<style>
/* Slightly hide top bar */
.ytp-chrome-top {
    display: none !important;
}

/* Reduce branding visibility */
.ytp-watermark {
    opacity: 0.3 !important;
}

/* LIVE animation */
.badge.bg-danger {
    animation: pulse 1.5s infinite;
}

@keyframes pulse {
    0% {
        opacity: 1;
    }

    50% {
        opacity: 0.5;
    }

    100% {
        opacity: 1;
    }
}

.video-container iframe {
    transform: scale(1.08);
    /* zoom in */
    transform-origin: center;
}

.top-mask {
    position: absolute;
    top: 0;
    right: 0;
    width: 120px;
    height: 50px;
    z-index: 5;
    background: #000;
    /* same as video bg */
}

.video-container::after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 40px;
    background: #000;
    z-index: 5;
}
</style>
@endpush
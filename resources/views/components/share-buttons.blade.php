<div class="d-flex flex-wrap gap-2 mt-3">

    <!-- Facebook -->
    @php $fb = $share->facebook()->getRawLinks(); @endphp
    @if(isset($fb[0]))
        <a href="{{ $fb[0] }}" target="_blank" class="btn btn-primary">
            <i class="fab fa-facebook-f"></i> Facebook
        </a>
    @endif

    <!-- Twitter -->
    @php $tw = $share->twitter()->getRawLinks(); @endphp
    @if(isset($tw[0]))
        <a href="{{ $tw[0] }}" target="_blank" class="btn btn-info text-white">
            <i class="fab fa-twitter"></i> Twitter
        </a>
    @endif

    <!-- LinkedIn -->
    @php $ln = $share->linkedin()->getRawLinks(); @endphp
    @if(isset($ln[0]))
        <a href="{{ $ln[0] }}" target="_blank" class="btn btn-secondary">
            <i class="fab fa-linkedin-in"></i> LinkedIn
        </a>
    @endif

    <!-- WhatsApp -->
    @php $wa = $share->whatsapp()->getRawLinks(); @endphp
    @if(isset($wa[0]))
        <a href="{{ $wa[0] }}" target="_blank" class="btn btn-success">
            <i class="fab fa-whatsapp"></i> WhatsApp
        </a>
    @endif

    <!-- Reddit -->
    @php $rd = $share->reddit()->getRawLinks(); @endphp
    @if(isset($rd[0]))
        <a href="{{ $rd[0] }}" target="_blank" class="btn btn-danger">
            <i class="fab fa-reddit"></i> Reddit
        </a>
    @endif

</div>

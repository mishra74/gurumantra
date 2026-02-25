<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Live Test Result</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
</head>
<body>

<section class="hero-section d-flex align-items-center justify-content-center text-center" style="min-height:100vh;">
    <div class="container">
        <div class="hero-card p-5 shadow-lg bg-white rounded">

            <h1 class="fw-bold mb-3">Live Test Result</h1>

            @if($remainingSeconds > 0)

                <p class="text-success fw-bold">
                    ⏳ Result available for:
                    <span id="countdown"></span>
                </p>

               <form method="POST" action="{{ route('live.result') }}" class="mt-3">
    @csrf
    <button type="submit"
            class="btn btn-primary btn-lg px-5">
        View Result
    </button>
</form>

            @else

                <div class="alert alert-danger mt-3">
                    ⏰ Result time is over. You can no longer access this result.
                </div>

            @endif

        </div>
    </div>
</section>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

@if($remainingSeconds > 0)
<script>
    let seconds = {{ (int) $remainingSeconds }};

    function updateCountdown() {
        if (seconds <= 0) {
            location.reload();
            return;
        }

        let hours = Math.floor(seconds / 3600);
        let minutes = Math.floor((seconds % 3600) / 60);
        let secs = seconds % 60;

        // Add leading zero
        hours = hours.toString().padStart(2, '0');
        minutes = minutes.toString().padStart(2, '0');
        secs = secs.toString().padStart(2, '0');

        document.getElementById('countdown').innerHTML =
            hours + " : " + minutes + " : " + secs;

        seconds--;
    }

    setInterval(updateCountdown, 1000);
    updateCountdown();
</script>
@endif

</body>
</html>
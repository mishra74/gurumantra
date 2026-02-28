@extends('layouts.master')
<link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
        <style>
        body {
            font-family: sans-serif;
            background-color: #f8f9fa;
        }

        .card {
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        }

        #startTestBtn {
            background: linear-gradient(135deg, #dc3f3f, #ff7a18);
            border: none;
            color: white;
            font-weight: 600;
            padding: 12px;
            border-radius: 10px;
        }

        #startTestBtn:disabled {
            opacity: 0.5;
        }

        .combo-indicator {
            width: 18px;
            height: 18px;
            background: purple;
            border-radius: 50%;
            display: inline-block;
            position: relative;
            margin-right: 8px;
        }

        .combo-indicator::after {
            content: "";
            width: 7px;
            height: 7px;
            background: #28a745;
            position: absolute;
            bottom: -3px;
            right: -3px;
            border-radius: 2px;
        }
    </style>

@section('content')


<div class="container py-5">
    <div class="card p-4">

        <!-- ENGLISH INSTRUCTIONS (VISIBLE) -->
        <div id="instructions-en">
            <h3 class="fw-bold mb-4 text-center">General Instructions</h3>

            <p>1. Total Duration of Demo Test -1 is <strong>60 mins</strong>.</p>
            <p>2. The countdown timer will show remaining time.</p>

            <h5 class="mt-4">Question Status:</h5>
            <ul>
                <li><span class="badge rounded-circle bg-secondary">&nbsp;&nbsp;</span> Not visited</li>
                <li><span class="badge rounded-circle bg-danger">&nbsp;&nbsp;</span> Not answered</li>
                <li><span class="badge rounded-circle bg-success">&nbsp;&nbsp;</span> Answered</li>
                <li><span class="badge rounded-circle" style="background: purple;">&nbsp;&nbsp;</span> Marked for review</li>
                <li>
                    <span class="combo-indicator"></span>
                    Answered & Marked for review
                </li>
            </ul>

            <div class="form-check mt-4">
                <input class="form-check-input" type="checkbox" id="termsCheck">
                <label class="form-check-label">
                    I have read and understood the instructions.
                </label>
            </div>
        </div>

        <!-- Countdown Section -->
        @if($remainingSeconds > 0)
        <div class="alert alert-info text-center mt-4">
            🕒 Test will start at:
            <strong>{{ $startDateTime->format('d M Y h:i A') }}</strong>
            <br>
            ⏳ Starts in:
            <span id="countdown" class="fw-bold text-danger"></span>
        </div>
        @endif

        <button class="btn mt-4 w-100" id="startTestBtn" disabled>
            Start Test
        </button>

    </div>
</div>

<form id="startTestForm" action="{{ route('live.start') }}" method="POST" style="display:none;">
    @csrf
</form>

<script>
    const remainingSeconds = {{ $remainingSeconds ?? 0 }};
    const startTestBtn = document.getElementById('startTestBtn');
    const checkbox = document.getElementById('termsCheck');

    let seconds = remainingSeconds;

    function enableButtonIfReady() {
        if (seconds <= 0 && checkbox.checked) {
            startTestBtn.disabled = false;
        } else {
            startTestBtn.disabled = true;
        }
    }

    function updateCountdown() {
        if (seconds <= 0) {
            document.getElementById('countdown').innerHTML = "00 : 00 : 00";
            enableButtonIfReady();
            return;
        }

        let hours = Math.floor(seconds / 3600);
        let minutes = Math.floor((seconds % 3600) / 60);
        let secs = seconds % 60;

        hours = hours.toString().padStart(2, '0');
        minutes = minutes.toString().padStart(2, '0');
        secs = secs.toString().padStart(2, '0');

        document.getElementById('countdown').innerHTML =
            hours + " : " + minutes + " : " + secs;

        seconds--;
        enableButtonIfReady();
    }

    if (seconds > 0) {
        setInterval(updateCountdown, 1000);
        updateCountdown();
    } else {
        enableButtonIfReady();
    }

    checkbox.addEventListener('change', enableButtonIfReady);

    startTestBtn.addEventListener('click', function () {
        document.getElementById('startTestForm').submit();
    });
</script>
@endsection

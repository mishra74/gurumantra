
@extends('layouts.master')
<link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
@section('content')

<section class="hero-section d-flex align-items-center justify-content-center text-center">
    <div class="container">
        <div class="hero-card p-5 shadow-lg">
            <h1 class="fw-bold mb-3">Live Test & Practice Set</h1>
            <p class="text-muted mb-4">
                Practice real exam level questions with timer, marking system & detailed analysis.
            </p>

            <button class="btn btn-primary btn-lg px-5"
                data-bs-toggle="modal"
                data-bs-target="#languageModal">
                Start Live Test
            </button>
        </div>
    </div>
</section>

<!-- Language Selection Modal -->
<div class="modal fade" id="languageModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-4">

            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">Select Language</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <form id="languageForm"
                      method="POST"
                      action="{{ route('live.instructions') }}">
@csrf
                    <select class="form-select mb-4"
                            name="lang"
                            id="languageSelect"
                            required>
                        <option value="" disabled selected>
                            Choose Language
                        </option>
                        <option value="english">English</option>
                        <option value="hindi">Hindi</option>
                    </select>

                    <button type="submit"
                            class="btn btn-success w-100">
                        Next
                    </button>

                </form>

            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<!-- Bootstrap JS -->

    <!-- Custom JS -->
    <script src="assets/js/main.js"></script>
@endsection
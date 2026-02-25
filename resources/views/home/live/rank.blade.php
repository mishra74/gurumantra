<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Test Result</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<body>

<div class="container py-5">

    <div class="card shadow-lg p-4">

        <h3 class="text-center fw-bold mb-4">Test Result Summary</h3>

        <!-- Student Details -->
        <div class="row mb-4">
            <div class="col-md-6">
                <p><strong>Name:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Mobile:</strong> {{ $user->phone ?? 'N/A' }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Test Name:</strong> {{ $data->exam_type }}</p>
                <p><strong>Date:</strong> {{ $data->created_at->format('d M Y') }}</p>
                <p><strong>Total Questions:</strong> {{ $data->total_questions }}</p>
            </div>
        </div>

        <!-- Score Section -->
        <div class="row text-center mb-4">

            <div class="col-md-3 col-6 mb-3">
                <div class="bg-success text-white p-3 rounded">
                    <h5>Correct</h5>
                    <h4>{{ $data->correct }}</h4>
                </div>
            </div>

            <div class="col-md-3 col-6 mb-3">
                <div class="bg-danger text-white p-3 rounded">
                    <h5>Wrong</h5>
                    <h4>{{ $data->incorrect }}</h4>
                </div>
            </div>

            <div class="col-md-3 col-6 mb-3">
                <div class="bg-warning text-dark p-3 rounded">
                    <h5>Percentage</h5>
                    <h4>{{ number_format($data->percentage,1) }}%</h4>
                </div>
            </div>

            <div class="col-md-3 col-6 mb-3">
                <div class="bg-primary text-white p-3 rounded">
                    <h5>Final Score</h5>
                    <h4>{{ $data->correct }}/{{ $data->total_questions }}</h4>
                </div>
                <!-- Chart -->

<button class="btn btn-dark mt-3" id="answerDetailBtn">
    View Answer Details
</button>

            </div>

        </div>

        <!-- Chart -->
        <div class="mb-4">
    <canvas id="resultChart"></canvas>
</div>
<!-- Answer Review Section -->
<div id="answerReview" class="mt-4 d-none">
    <h5 class="mb-3">Answer Review</h5>
    <div id="reviewContainer"></div>
</div>

        <div class="text-center">
            <a href="{{ url('/') }}" class="btn btn-outline-primary">
                Take Test Again
            </a>
        </div>

    </div>

</div>

<script>

const data = @json($data);

const quiz = data.questions || [];
const answers = data.answers || [];

const correct = parseInt(data.correct);
const wrong = parseInt(data.incorrect);
const total = parseInt(data.total_questions);

/* ============================
   BAR CHART
============================ */

const ctx = document.getElementById('resultChart').getContext('2d');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Correct', 'Wrong'],
        datasets: [{
            label: 'Result Overview',
            data: [correct, wrong],
            backgroundColor: ['#198754', '#dc3545'],
            borderRadius: 5
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
                precision: 0
            }
        },
        plugins: {
            legend: {
                display: false
            }
        }
    }
});

/* ============================
   QUESTION REVIEW
============================ */

let reviewHTML = "";

quiz.forEach((q, i) => {

    let status = "";
    let badgeClass = "";

    if (answers[i] !== null && (answers[i] + 1) == q.correct_answer) {
        status = "Correct";
        badgeClass = "success";
    } 
    else if (answers[i] !== null) {
        status = "Wrong";
        badgeClass = "danger";
    } 
    else {
        status = "Not Attempted";
        badgeClass = "secondary";
    }

    reviewHTML += `
    <div class="card mb-3 p-3 shadow-sm">
        <div class="d-flex justify-content-between">
            <b>Q${i+1}. ${q.question}</b>
            <span class="badge bg-${badgeClass}">${status}</span>
        </div>
        <div class="mt-2">
            <small><strong>Your Answer:</strong> 
                ${answers[i] !== null 
                    ? q.options[answers[i]] 
                    : "Not Attempted"}
            </small><br>
            <small><strong>Correct Answer:</strong> 
                ${q.options[q.correct_answer - 1]}
            </small>
        </div>
    </div>
    `;
});

document.getElementById("reviewContainer").innerHTML = reviewHTML;

/* ============================
   TOGGLE BUTTON
============================ */

document.getElementById("answerDetailBtn")
.addEventListener("click", function() {

    const section = document.getElementById("answerReview");

    if (section.classList.contains("d-none")) {
        section.classList.remove("d-none");
        this.innerText = "Hide Answer Details";
    } else {
        section.classList.add("d-none");
        this.innerText = "View Answer Details";
    }
});

</script>
</body>
</html>
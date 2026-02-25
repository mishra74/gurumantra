<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Test Result</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
body { background:#f8f9fa; }
.card { border-radius:15px; }
.rank-badge {
    font-size:28px;
    font-weight:bold;
}
</style>
</head>
<body>

<div class="container py-5">

<div class="card shadow-lg p-4">

<h3 class="text-center fw-bold mb-4">Test Result Summary</h3>

<!-- Student Info -->
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

<!-- Score Cards -->
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
</div>

</div>

<!-- Rank Section -->
<div class="row text-center mb-4">

<div class="col-md-4 col-6 mb-3">
<div class="bg-dark text-white p-3 rounded">
<h5>Your Rank</h5>
<div class="rank-badge">#{{ $rank }}</div>
</div>
</div>

<div class="col-md-4 col-6 mb-3">
<div class="bg-info text-white p-3 rounded">
<h5>Total Students</h5>
<h4>{{ $totalStudents }}</h4>
</div>
</div>

<div class="col-md-4 col-12 mb-3">
<div class="bg-warning text-dark p-3 rounded">
<h5>Top Score</h5>
<h4>{{ number_format($topScore,1) }}%</h4>
</div>
</div>

</div>

<!-- Chart -->
<div class="mb-4">
<canvas id="resultChart"></canvas>
</div>

<!-- Leaderboard -->
<div class="mt-5">
<h4 class="fw-bold mb-3 text-center">Leaderboard</h4>

<div class="table-responsive">
<table class="table table-bordered table-striped text-center">
<thead class="table-dark">
<tr>
<th>Rank</th>
<!--<th>Name</th>-->
<th>Score</th>
<th>Percentage</th>
</tr>
</thead>
<tbody>
@foreach($allResults as $index => $result)
<tr @if($result->id == $data->id) class="table-success fw-bold" @endif>
<td>{{ $index + 1 }}</td>
<!--<td>{{ $result->user->name ?? 'N/A' }}</td>-->
<td>{{ $result->correct }}/{{ $result->total_questions }}</td>
<td>{{ number_format($result->percentage,1) }}%</td>
</tr>
@endforeach
</tbody>
</table>
</div>
</div>

<!-- Answer Review -->
<div class="mt-4">
<button class="btn btn-dark mb-3" id="answerDetailBtn">
View Answer Details
</button> 
<div class="text-center mt-3">
    <a href="{{ route('result.download', $data->id) }}" 
       class="btn btn-danger">
        Download Result PDF
    </a>
</div>

<div id="answerReview" class="d-none">
<h5>Answer Review</h5>
<div id="reviewContainer"></div>
</div>
</div>

<div class="text-center mt-4">
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

/* CHART */

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
scales: { y: { beginAtZero: true } },
plugins: { legend: { display: false } }
}
});

/* ANSWER REVIEW */

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
${answers[i] !== null ? q.options[answers[i]] : "Not Attempted"}
</small><br>
<small><strong>Correct Answer:</strong> 
${q.options[q.correct_answer - 1]}
</small>
</div>
</div>
`;
});

document.getElementById("reviewContainer").innerHTML = reviewHTML;

/* TOGGLE */

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
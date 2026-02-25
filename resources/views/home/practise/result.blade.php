<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Test Result</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body class="bg-light">

<div class="container mt-5">
    <div class="card p-4 shadow-lg rounded-4">

        <h3 class="text-center mb-4">Test Result</h3>

        <div id="resultData"></div>

        <a href="{{ url('/') }}" class="btn btn-primary mt-4">
            Go Home
        </a>

    </div>
</div>

<script>

const data = @json($data);

const quiz = data.questions;
const answers = data.answers;

let correct = parseInt(data.correct);
let wrong = parseInt(data.wrong);
let attempted = parseInt(data.attempted);
let total = parseInt(data.total);

const percentage = total > 0 
    ? ((correct / total) * 100).toFixed(1)
    : 0;

let reviewHTML = "";

/* ===== Question Review ===== */

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
    <div class="card mb-3 p-3">
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

/* ===== Summary Section ===== */

document.getElementById("resultData").innerHTML = `
<div class="mb-4">
    <div>Total Questions: <b>${total}</b></div>
    <div>Attempted: <b>${attempted}</b></div>
    <div>Correct: <b class="text-success">${correct}</b></div>
    <div>Wrong: <b class="text-danger">${wrong}</b></div>
    <div>Score: <b>${correct}/${total}</b></div>
    <div>Percentage: <b>${percentage}%</b></div>
</div>
<hr>
${reviewHTML}
`;

</script>

</body>
</html>
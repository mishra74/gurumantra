<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Practice</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<!-- FIXED CSS PATH -->
<link rel="stylesheet" href="/assets/css/style.css">
<style>
    /* Hide radio */
input[type="radio"] {
    display: none;
}

/* Default option style */
.option-label {
    cursor: pointer;
    transition: 0.2s;
}

/* Selected before submit */
.option-selected {
    border: 2px solid #0d6efd !important;
    background-color: #e7f1ff;
}

/* Correct answer */
.option-correct {
    border: 2px solid #198754 !important;
    background-color: #d1e7dd;
}

/* Wrong answer */
.option-wrong {
    border: 2px solid #dc3545 !important;
    background-color: #f8d7da;
}
</style>
</head>

<body class="bg-light">

<div class="container mt-5">
<div class="practice-card">

<div class="d-flex justify-content-between mb-3">
    <h5 class="fw-bold text-primary">Practice Set</h5>
    <span id="questionNumber"></span>
</div>

<h5 id="questionText" class="mb-4"></h5>

<div id="optionsBox"></div>

<div class="mt-4 action-buttons">

  <button class="btn btn-outline-secondary" onclick="prev()">Previous</button>
  <button class="btn btn-primary" onclick="next()">Next</button>
  <button class="btn btn-success" onclick="submitTest()">Submit</button>

</div>

<div class="mt-3">
<button class="btn btn-link p-0"
data-bs-toggle="collapse" data-bs-target="#hintBox">
Show Hint
</button>
<div id="hintBox" class="collapse alert alert-info mt-2"></div>
</div>

</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
let questions = [];
let currentQuestion = 0;
let userAnswers = [];

const questionText = document.getElementById("questionText");
const questionNumber = document.getElementById("questionNumber");
const optionsBox = document.getElementById("optionsBox");

/* ---------------- FETCH QUESTIONS ---------------- */

function fetchQuestions(tileId) {

    fetch(`/student/get-question/${tileId}`)
        .then(res => res.json())
        .then(response => {

            if (!response.status) {
                alert("No questions found");
                return;
            }

            questions = response.data;
            userAnswers = new Array(questions.length).fill(null);

            loadQuestion();
        })
        .catch(error => console.error("Error:", error));
}

/* ---------------- LOAD QUESTION ---------------- */

function loadQuestion() {

    const q = questions[currentQuestion];
    if (!q) return;

    questionNumber.innerText =
        `Question ${currentQuestion + 1} of ${questions.length}`;

    questionText.innerHTML = q.question;

    optionsBox.innerHTML = "";

    q.options.forEach((option, i) => {

        const div = document.createElement("div");
        div.classList.add("mb-2");

        const label = document.createElement("label");
        label.className = "p-3 border rounded w-100 d-block option-label";

        label.innerHTML = option;

        // If already selected
        if (userAnswers[currentQuestion] === i) {
            label.classList.add("option-selected");
        }

        label.onclick = () => selectOption(i);

        div.appendChild(label);
        optionsBox.appendChild(div);
    });

    document.getElementById("hintBox").innerHTML = q.hint || "";
}

/* ---------------- SELECT OPTION ---------------- */

function selectOption(i) {

    userAnswers[currentQuestion] = i;
    loadQuestion();

    const correctIndex = questions[currentQuestion].correct_answer - 1;
    const labels = document.querySelectorAll(".option-label");

    labels.forEach((label, index) => {

        if (index === correctIndex) {
            label.classList.add("option-correct");
        }

        if (index === i && i !== correctIndex) {
            label.classList.add("option-wrong");
        }
    });
}

/* ---------------- NAVIGATION ---------------- */

function next() {
    if (currentQuestion < questions.length - 1) {
        currentQuestion++;
        loadQuestion();
    }
}

function prev() {
    if (currentQuestion > 0) {
        currentQuestion--;
        loadQuestion();
    }
}

/* ---------------- SUBMIT ---------------- */

function submitTest() {

    let correct = 0;
    let wrong = 0;

    questions.forEach((q, i) => {
        if (userAnswers[i] !== null) {
            if ((userAnswers[i] + 1) == q.correct_answer) {
                correct++;
            } else {
                wrong++;
            }
        }
    });

    let total = questions.length;
    let attempted = userAnswers.filter(a => a !== null).length;

    const form = document.createElement("form");
    form.method = "POST";
    form.action = "{{ route('practise.result') }}";

    const csrf = document.createElement("input");
    csrf.type = "hidden";
    csrf.name = "_token";
    csrf.value = "{{ csrf_token() }}";
    form.appendChild(csrf);

    const fields = {
        questions: JSON.stringify(questions),
        answers: JSON.stringify(userAnswers),
        correct: correct,
        wrong: wrong,
        attempted: attempted,
        total: total
    };

    for (let key in fields) {
        let input = document.createElement("input");
        input.type = "hidden";
        input.name = key;
        input.value = fields[key];
        form.appendChild(input);
    }

    document.body.appendChild(form);
    form.submit();
}

/* ---------------- PAGE LOAD ---------------- */

document.addEventListener("DOMContentLoaded", function () {

    const params = new URLSearchParams(window.location.search);
    const tileId = params.get("tile") || 3;

    fetchQuestions(tileId);
});

/* ---------------- SUBMIT ---------------- */

// function submitTest() {

//     let correct = 0;
//     let wrong = 0;

//     questions.forEach((q, i) => {
//         if (userAnswers[i] !== null) {
//             if ((userAnswers[i] + 1) == q.correct_answer) {
//                 correct++;
//             } else {
//                 wrong++;
//             }
//         }
//     });

//     let total = questions.length;
//     let attempted = userAnswers.filter(a => a !== null).length;

//     // Create form dynamically
//     const form = document.createElement("form");
//     form.method = "POST";
//     form.action = "{{ route('practise.result') }}";

//     // CSRF
//     const csrf = document.createElement("input");
//     csrf.type = "hidden";
//     csrf.name = "_token";
//     csrf.value = "{{ csrf_token() }}";
//     form.appendChild(csrf);

//     // Append Data
//     const fields = {
//         questions: JSON.stringify(questions),
//         answers: JSON.stringify(userAnswers),
//         correct: correct,
//         wrong: wrong,
//         attempted: attempted,
//         total: total
//     };

//     for (let key in fields) {
//         let input = document.createElement("input");
//         input.type = "hidden";
//         input.name = key;
//         input.value = fields[key];
//         form.appendChild(input);
//     }

//     document.body.appendChild(form);
//     form.submit();
// }
// document.addEventListener("DOMContentLoaded", function () {

//     const params = new URLSearchParams(window.location.search);
//     const tileId = params.get("tile") || 3;

//     fetchQuestions(tileId);
// });
</script>

</body>
</html>

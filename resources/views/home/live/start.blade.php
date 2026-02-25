<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Live Test | Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">

<style>:root {
  --primary: #dc3f3f;
  --primary-dark: #b92e2e;
  --glass: rgba(255, 255, 255, 0.85);
}

body {
  font-family: "Segoe UI", sans-serif;
  background-color: var(--bg-light);
}

.hero-section {
  min-height: 100vh;
  background: linear-gradient(135deg, #ff6a6a, #ffb199);
  animation: gradientMove 6s ease infinite;
}

.card-body {
    position: relative;
    z-index: 1;
    overflow: hidden;
}

.card-body::before {
    content: "";
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    
    width: 200px;   /* Adjust size */
    height: 200px;  /* Adjust size */
    
    background: url({{asset("frontend/img/logo.png")}}) no-repeat center;
    background-size: contain;
    
    opacity: 0.08;   /* Watermark transparency */
    pointer-events: none;
    
    z-index: -1;
}
.hero-card {
  background: var(--glass);
  backdrop-filter: blur(10px);
  border-radius: 20px;
  max-width: 520px;
  margin: auto;
  box-shadow: 0 25px 60px rgba(0,0,0,0.25);
  animation: floatIn 0.8s ease;
}

.hero-card h1 {
  font-size: 34px;
  font-weight: 800;
}
.btn-primary {
  background: linear-gradient(135deg, #dc3f3f, #ff6a6a);
  border: none;
  border-radius: 30px;
  font-weight: 600;
  transition: 0.3s;
}

.btn-primary:hover {
  transform: translateY(-3px);
  box-shadow: 0 10px 25px rgba(220,63,63,0.6);
}
.modal-content {
  border-radius: 20px;
  box-shadow: 0 20px 40px rgba(0,0,0,0.2);
}
/* Animations */
@keyframes floatIn {
  from {
    opacity: 0;
    transform: translateY(40px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes gradientMove {
  0% { background-position: 0% 50%; }
  100% { background-position: 100% 50%; }
}
.instruction-card {
  border-radius: 15px;
}

.list-group-item {
  border: none;
  padding: 10px 0;
}

.btn:disabled {
  background-color: #ccc;
  cursor: not-allowed;
}
.top-bar {
  background: #fff;
  border-radius: 10px;
}

.question-card, .palette-card {
  border-radius: 12px;
}

.palette-btn {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  border: none;
  background-color: #e0e0e0;
}

.palette-btn.answered {
  background-color: #28a745;
  color: #fff;
}

.palette-btn.review {
  background-color: purple;
  color: #fff;
}
.result-card {
  border-radius: 15px;
}

.score-box {
  transition: 0.3s ease;
}

.score-box:hover {
  transform: translateY(-5px);
}
.card {
    border: none;
}

.card h5 {
    color: #0d6efd;
}

.bg-purple {
    background-color: purple;
}
/* Desktop default */
.btn-icon {
  display: none;
}

/* Mobile only */
@media (max-width: 768px) {
  .btn-text {
    display: none !important;
  }

  .btn-icon {
    display: inline-block !important;
    font-size: 22px;
  }

  .nav-btn {
    width: 46px;
    height: 46px;
    padding: 0;
  }
}
:root {
  --primary-blue: #1e2a78;
  --success-green: #28a745;
  --bg-body: #f0f2f5;
  --border-color: #dee2e6;
}

body {
  background-color: var(--bg-body);
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

/* Header Like Gurumantra */
.exam-header {
  background-color: var(--primary-blue);
  box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.timer-box {
  font-size: 1.1rem;
  font-weight: 600;
  background: rgba(255,255,255,0.1);
  padding: 4px 12px;
  border-radius: 4px;
}

/* Palette Styling */
.palette-btn {
  width: 38px;
  height: 38px;
  border-radius: 50%;
  border: 1px solid #ccc;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 14px;
  background: #fff;
  transition: 0.2s;
}

.palette-btn.answered { background: var(--success-green); color: white; border-color: var(--success-green); }
.palette-btn.review { background: #6f42c1; color: white; border-color: #6f42c1; }
.palette-btn.active { border: 2px solid var(--primary-blue); font-weight: bold; }

.legend-box {
  width: 15px; height: 15px; border-radius: 50%; background: #fff; border: 1px solid #ccc; display: inline-block;
}
.legend-box.answered { background: var(--success-green); }
.legend-box.review { background: #6f42c1; }

/* Desktop: Hide Icons if you only want text, or keep both. 
   Currently both are visible on desktop. */
.nav-btn i { font-size: 14px; }

/* ===========================================
   RESPONSIVE LOGIC (Mobile Only)
   =========================================== */
@media (max-width: 768px) {
  /* Hide Text, Show Only Icons */
  .btn-text {
    display: none !important;
  }
  
  .nav-btn {
    width: 45px;
    height: 45px;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50% !important; /* Circular buttons on mobile */
  }

  .nav-btn i {
    font-size: 18px;
    margin: 0;
  }

  .exam-header h6 {
    font-size: 14px;
  }

  .card-header {
    font-size: 13px;
  }
}

/* Color Variables */
:root {
    --primary-blue: #2c3e8c;
    --btn-purple: #6f42c1;
    --btn-dark-purple: #5227a1;
    --not-visited: #e0e0e0;
    --answered: #28a745;
    --not-answered: #dc3545;
}

/* Layout Tweaks */
.exam-header { background-color: var(--primary-blue); height: 50px; }
.main-question-card .card-header { background-color: #e9ecef; color: #1e2a78; border-bottom: 2px solid #cbd5e0; }
.marks-badge { background: #fff; padding: 2px 10px; border-radius: 4px; font-size: 0.85rem; box-shadow: inset 0 0 2px rgba(0,0,0,0.1); }

/* Palette Grid */
.palette-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 8px;
}
.q-circle {
    width: 35px; height: 35px; border-radius: 50%;
    background: var(--not-visited); display: flex;
    align-items: center; justify-content: center;
    font-size: 0.85rem; cursor: pointer; border: 1px solid #ccc;
}
.q-circle.answered { background: var(--answered); color: white; border: none; }
.q-circle.not-answered { background: var(--not-answered); color: white; border: none; }

/* Legend Styles */
.legend-box {
    width: 24px; height: 24px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    color: white; font-size: 10px; font-weight: bold;
}
.legend-box.gray { background: #e0e0e0; color: #666; }
.legend-box.green { background: var(--answered); }
.legend-box.red { background: var(--not-answered); }
.legend-box.purple { background: var(--btn-purple); }
.legend-box.purple-dot { background: var(--btn-purple); position: relative; }
.legend-box.purple-dot::after { 
    content: ''; position: absolute; bottom: 2px; right: 2px; 
    width: 6px; height: 6px; background: #00ff00; border-radius: 50%; 
}
.tiny-text { font-size: 11px; color: #444; }

/* Custom Buttons */
.btn-purple { background: var(--btn-purple); color: white; }
.btn-dark-purple { background: var(--btn-dark-purple); color: white; }
.btn-primary-outline { border: 1px solid var(--primary-blue); color: var(--primary-blue); }

/* RESPONSIVE: Mobile Icon Only View */
@media (max-width: 768px) {
    .btn-text { display: none !important; }
    .nav-btn {
        width: 42px; height: 42px; padding: 0;
        display: inline-flex; align-items: center; justify-content: center;
        border-radius: 50% !important;
    }
    .nav-btn i { font-size: 18px; margin: 0; }
    .palette-grid { grid-template-columns: repeat(6, 1fr); }
}

/* Palette Colors based on Image Legend */

/* Gray: Not Visited */
.q-circle.not-visited { background-color: #e0e0e0; color: #666; }

/* Red: Visited but Not Answered */
.q-circle.not-answered { background-color: #dc3545; color: white; border: none; }

/* Green: Answered */
.q-circle.answered { background-color: #28a745; color: white; border: none; }

/* Purple: Mark for Review (No Answer) */
.q-circle.review { background-color: #6f42c1; color: white; border: none; }

/* Green & Purple: Save & Mark for Review */
.q-circle.save-mark-review {
    background-color: #6f42c1; /* Purple Base */
    color: white;
    position: relative;
}
/* Adding the Green Dot for 'Answered + Marked' logic */
.q-circle.save-mark-review::after {
    content: '';
    position: absolute;
    bottom: 2px;
    right: 2px;
    width: 8px;
    height: 8px;
    background-color: #28a745; /* Green Dot */
    border-radius: 50%;
    border: 1px solid white;
}

.q-circle.active { border: 2px solid #2c3e8c !important; font-weight: bold; }

/* Mobile View Fix */
@media (max-width: 768px) {
    /* Button ke andar ka text hide karne ke liye */
    .btn span {
        display: none !important;
    }

    /* Buttons ko icon ke hisaab se chota aur adjust karne ke liye */
    .btn {
        padding: 8px 12px !important;
        min-width: 40px;
        margin: 2px !important;
    }

    /* Icons ka margin hatane ke liye */
    .btn i {
        margin: 0 !important;
    }
}

/* ===========================================
   BUTTON HOVER FIX (Anti-White Wash)
   =========================================== */

/* 1. Previous Button - Blue Outline to Light Gray */
#prevBtn:hover, .btn-primary-outline:hover {
    background-color: #f0f2f5 !important;
    color: var(--primary-blue) !important;
    border-color: var(--primary-blue) !important;
}

/* 2. Save & Next - Red to Dark Red */
#nextBtn:hover, .btn-danger:hover {
    background-color: #b92e2e !important; /* Darker Red */
    color: white !important;
    border-color: #b92e2e !important;
}

/* 3. Mark for Review - Purple to Dark Purple */
#markReviewBtn:hover, .btn-purple:hover {
    background-color: #5a32a3 !important; /* Darker Purple */
    color: white !important;
    border-color: #5a32a3 !important;
}

/* 4. Save & Mark for Review - Darkest Purple */
#saveMarkReviewBtn:hover, .btn-dark-purple:hover {
    background-color: #3d1d7a !important; /* Deep Dark Purple */
    color: white !important;
    border-color: #3d1d7a !important;
}

/* 5. Clear/Erase Button - Outline to Light Red */
#eraseBtn:hover {
    background-color: #f67a1c !important;
    color: #000000 !important;
    border-color: #dc3545 !important;
}

/* Common transition for smooth hover */
.btn {
    transition: all 0.3s ease !important;
}
/* ===========================================
   PREVIOUS & NEXT BUTTONS (Blue Theme) 
   =========================================== */

#prevBtn, #nextBtn {
    background-color: var(--primary-blue) !important; /* Dono hamesha blue rahenge */
    color: white !important;
    border: 2px solid var(--primary-blue) !important;
    padding: 8px 20px;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

/* Hover effect: Jab mouse le jayenge toh white nahi hoga, dark blue hoga */
#prevBtn:hover, #nextBtn:hover {
    background-color: #1a255d !important; /* Darker blue shade */
    color: white !important;
    border-color: #1a255d !important;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(44, 62, 140, 0.3);
}

/* Disabled state (agar button kaam na kar rha ho) */
#prevBtn:disabled, #nextBtn:disabled {
    background-color: #ccc !important;
    border-color: #ccc !important;
    cursor: not-allowed;
    transform: none;
}
</style>

</head>
<body>

<div class="test-ui-wrapper">

 <header class="exam-header d-flex justify-content-between align-items-center px-4 py-2 text-white">
        <div class="test-title-area">
            <h6 class="mb-0">Test: {{$live_test->title}}</h6>
        </div>
        <div class="timer-area d-flex align-items-center gap-2">
            <button class="btn btn-sm btn-outline-light me-2" data-bs-toggle="modal" data-bs-target="#chartModal">
                <i class="fa-solid fa-chart-pie"></i> Chart
            </button>
            
            <span class="timer-box"><i class="fa-regular fa-clock"></i> <span id="timer">{{$remainingSeconds}}</span></span>
            <button class="btn btn-success btn-sm px-3 fw-bold" id="submitBtnTop">Submit Test</button>
        </div>
    </header>

<div class="container-fluid py-3">
<div class="row">

<div class="col-lg-9">
<div class="card shadow-sm main-question-card">

                    <div class="card-header d-flex justify-content-between">
    <span id="questionNumber">Q1</span>
    <span id="negative" >Marks: {{$section->marks??1}} | Negative: {{$section->negative_marks??"0.5"}}</span>
</div>

                                <div class="card-body" style="min-height:300px;">
    <h5 id="questionText"></h5>
    <div id="optionsContainer"></div>
</div>

                            <div class="card-footer bg-white p-3">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                            <div class="d-flex gap-2">
                                <button class="btn btn-primary-outline nav-btn" id="prevBtn">
                                    <i class="fa-solid fa-chevron-left"></i> <span class="btn-text">Previous</span>
                                </button>
                                <button class="btn btn-outline-danger nav-btn" id="eraseBtn">
                                    <i class="fa-solid fa-eraser"></i> <span class="btn-text">Erase</span>
                                </button>
                                  <button class="btn btn-primary nav-btn" id="nextBtn">
                                    <span class="btn-text">Next</span> <i class="fa-solid fa-chevron-right"></i>
                                </button>
                               
                            </div>
                            
                            <div class="d-flex gap-2">
                               <!--<button class="btn btn-outline-secondary nav-btn" id="reportBtn">-->
                               <!--     <i class="fa-solid fa-flag"></i> <span class="btn-text">Report</span>-->
                               <!-- </button>-->
                                <button class="btn btn-purple nav-btn" id="markReviewBtn">
                                    <i class="fa-solid fa-thumbtack"></i> <span class="btn-text">Mark for Review</span>
                                </button>
                                <button class="btn btn-dark-purple nav-btn" id="saveMarkReviewBtn">
                                    <i class="fa-solid fa-floppy-disk"></i> <span class="btn-text">Save & Mark for Review</span>
                                </button>
                            </div>
                        </div>
                    </div>
</div>
</div>
<div class="col-lg-3 col-md-12">
                <div class="card shadow-sm palette-card">
                    <div class="card-header bg-white">
                        <h6 class="mb-0 fw-bold text-success">Demo Test</h6>
                    </div>
                    <div class="card-body">
                        <div id="paletteContainer" class="palette-grid mb-4">
                            </div>
                        
                        <hr>
                        
<h6 class="fw-bold small mb-3">Legenda And State</h6>
<div class="row g-2 legend-grid">
    <div class="col-6 d-flex align-items-center mb-2">
        <span class="legend-box gray" id="countNotVisited">0</span>
        <span class="ms-2 tiny-text">Not Visited</span>
    </div>

    <div class="col-6 d-flex align-items-center mb-2">
        <span class="legend-box green" id="countAnswered">0</span>
        <span class="ms-2 tiny-text">Answered</span>
    </div>

    <div class="col-6 d-flex align-items-center mb-2">
        <span class="legend-box red" id="countNotAnswered">0</span>
        <span class="ms-2 tiny-text">Not Answered</span>
    </div>

    <div class="col-6 d-flex align-items-center mb-2">
        <span class="legend-box purple" id="countReview">0</span>
        <span class="ms-2 tiny-text">Mark for Review</span>
    </div>

    <div class="col-12 d-flex align-items-center">
        <span class="legend-box purple-dot" id="countSaveReview">0</span>
        <span class="ms-2 tiny-text">Save and Mark for Review</span>
    </div>
</div>                    </div>
                </div>
            </div>

</div>
</div>
</div>
<div class="modal fade" id="chartModal" tabindex="-1" aria-labelledby="chartModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg border-0" style="border-radius: 15px;">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold" id="chartModalLabel">Attempt Summary</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center p-4">
                <div style="height: 300px; position: relative;">
                    <canvas id="progressChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>

/* ===== VARIABLES ===== */

let questions = [];
let currentIndex = 0;
let userAnswers = [];
let visited = [];
let reviewMarked = [];
let saveAndReview = [];

const questionText = document.getElementById("questionText");
const optionsContainer = document.getElementById("optionsContainer");
const questionNumber = document.getElementById("questionNumber");
const paletteContainer = document.getElementById("paletteContainer");
const eraseBtn = document.getElementById("eraseBtn");
const markReviewBtn = document.getElementById("markReviewBtn");
const saveMarkReviewBtn = document.getElementById("saveMarkReviewBtn");



/* ===== FETCH QUESTIONS ===== */

function fetchQuestionsFromDB(testId){


    fetch(`/student/get-question/${testId}`)
    .then(res => res.json())
    .then(response => {

        if(!response.status){
            alert("No questions found");
            return;
        }

        questions = response.data;

        userAnswers = new Array(questions.length).fill(null);
        visited = new Array(questions.length).fill(false);
reviewMarked = new Array(questions.length).fill(false);
saveAndReview = new Array(questions.length).fill(false);

        createPalette();
        loadQuestion(0);
    })
    .catch(err => console.error(err));
}

/* ===== LOAD QUESTION ===== */

function loadQuestion(index){

    currentIndex = index;
    visited[index] = true;

    const q = questions[index];

    questionNumber.innerText = `Q${index+1}`;
    questionText.innerHTML = q.question;

    optionsContainer.innerHTML = "";
    q.options.forEach((option,i)=>{

       const div = document.createElement("div");
        div.classList.add("option-wrapper", "mb-2");
        div.innerHTML = `
            <label class="d-flex align-items-center p-2 border rounded cursor-pointer option-label ${userAnswers[index] === i ? 'selected-option' : ''}">
                <input type="radio" name="option" value="${i}" class="me-3" ${userAnswers[index] === i ? "checked" : ""}>
                <span>${option}</span>
            </label>
        `;
        div.onclick = () => {
            userAnswers[index] = i;
            loadQuestion(index);
            updateLegendCounts();
        };
        optionsContainer.appendChild(div);
        
    });
 
    updatePalette();
    updateLegendCounts();
}

/* ===== PALETTE ===== */

function createPalette(){

    paletteContainer.innerHTML="";

    questions.forEach((_,i)=>{

        const btn=document.createElement("div");
        btn.className="q-circle not-visited";
        btn.innerText=i+1;

        btn.onclick=()=> loadQuestion(i);

        paletteContainer.appendChild(btn);
    });
}

function updatePalette(){

    const buttons=document.querySelectorAll(".q-circle");

    buttons.forEach((btn,i)=>{

        btn.classList.remove(
            "answered",
            "not-answered",
            "not-visited",
            "review",
            "save-mark-review",
            "active"
        );

        if(!visited[i]){
            btn.classList.add("not-visited");
        }
        else if(saveAndReview[i]){
            btn.classList.add("save-mark-review");
        }
        else if(reviewMarked[i]){
            btn.classList.add("review");
        }
        else if(userAnswers[i]==null){
            btn.classList.add("not-answered");
        }
        else{
            btn.classList.add("answered");
        }

        if(i===currentIndex){
            btn.classList.add("active");
        }

    });
}

/* ===== NAVIGATION ===== */

document.getElementById("nextBtn").addEventListener("click",()=>{
    if(currentIndex < questions.length-1){
        loadQuestion(currentIndex+1);
    }
});

document.getElementById("prevBtn").addEventListener("click",()=>{
    if(currentIndex>0){
        loadQuestion(currentIndex-1);
    }
});
// eraseBtn.addEventListener("click", () => {
//     userAnswers[currentQuestion] = null;
//     reviewMarked[currentQuestion] = false;
//     saveAndReview[currentQuestion] = false;
//     eraseBtn.addEventListener("click", () => {
//     userAnswers[currentIndex] = null;
//     loadQuestion(currentIndex);
// });
//});
eraseBtn.addEventListener("click", () => {
    userAnswers[currentIndex] = null;
    loadQuestion(currentIndex);
});
markReviewBtn.addEventListener("click", () => {
    reviewMarked[currentIndex] = true;
    saveAndReview[currentIndex] = false;
    moveToNext();
});
saveMarkReviewBtn.addEventListener("click", () => {

    if(userAnswers[currentIndex] !== null){

        saveAndReview[currentIndex] = true;
        reviewMarked[currentIndex] = false;
        moveToNext();

    } else {
        alert("Please select an option first!");
    }

});
/* ===== SUBMIT ===== */
function moveToNext() {
    if (currentIndex < questions.length - 1) {
        currentIndex++;
        loadQuestion(currentIndex);
    } else {
        updatePalette();
    }
}


  
document.getElementById("submitBtnTop").addEventListener("click",()=> {

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
    form.action = "{{ route('live.result') }}";

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
});


/* ===== TIMER ===== */

let timeLeft = 60*60;

setInterval(()=>{
    if(timeLeft<=0){
        document.getElementById("submitBtnTop").click();
        return;
    }

    let mins=Math.floor(timeLeft/60);
    let secs=timeLeft%60;

    document.getElementById("timer").innerText =
        `${mins}:${secs<10?"0":""}${secs}`;

    timeLeft--;
},1000);

/* ===== INIT ===== */

document.addEventListener("DOMContentLoaded",()=>{
    const testId = 1;   // change dynamically
    fetchQuestionsFromDB(testId);
});
let progressChartInstance = null;

const chartModalElement = document.getElementById("chartModal");

if (chartModalElement) {
    chartModalElement.addEventListener("shown.bs.modal", function () {

        const attempted = userAnswers.filter(a => a !== null).length;
        const unattempted = questions.length - attempted;

        renderChart(attempted, unattempted);
    });
}
function updateLegendCounts() {

    let notVisited = 0;
    let answered = 0;
    let notAnswered = 0;
    let review = 0;
    let saveReview = 0;

    for (let i = 0; i < questions.length; i++) {

        if (!visited[i]) {
            notVisited++;
        }
        else if (saveAndReview[i]) {
            saveReview++;
        }
        else if (reviewMarked[i]) {
            review++;
        }
        else if (userAnswers[i] !== null) {
            answered++;
        }
        else {
            notAnswered++;
        }
    }

    document.getElementById("countNotVisited").innerText = notVisited;
    document.getElementById("countAnswered").innerText = answered;
    document.getElementById("countNotAnswered").innerText = notAnswered;
    document.getElementById("countReview").innerText = review;
    document.getElementById("countSaveReview").innerText = saveReview;
}
function renderChart(attempted, unattempted) {

    const ctx = document.getElementById("progressChart");
    if (!ctx) return;

    // Destroy old instance safely
    if (progressChartInstance) {
        progressChartInstance.destroy();
    }

    progressChartInstance = new Chart(ctx, {
        type: "doughnut",
        data: {
            labels: ["Attempted", "Unattempted"],
            datasets: [{
                data: [attempted, unattempted],
                backgroundColor: ["#28a745", "#dc3545"],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: "bottom"
                }
            }
        }
    });
}
</script>

</body>
</html>

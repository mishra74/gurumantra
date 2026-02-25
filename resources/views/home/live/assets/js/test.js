let currentQuestion = 0;
let userAnswers = new Array(questions.length).fill(null);
let reviewMarked = new Array(questions.length).fill(false);
let saveAndReview = new Array(questions.length).fill(false);
let visited = new Array(questions.length).fill(false);

// Element Selection
const questionText = document.getElementById("questionText");
const questionNumber = document.getElementById("questionNumber");
const optionsContainer = document.getElementById("optionsContainer");
const paletteContainer = document.getElementById("paletteContainer");

// Buttons
const prevBtn = document.getElementById("prevBtn");
const eraseBtn = document.getElementById("eraseBtn");
const reportBtn = document.getElementById("reportBtn");
const nextBtn = document.getElementById("nextBtn"); 
const markReviewBtn = document.getElementById("markReviewBtn");
const saveMarkReviewBtn = document.getElementById("saveMarkReviewBtn");
const submitBtn = document.getElementById("submitBtn"); 
const submitBtnTop = document.getElementById("submitBtnTop");

// Translations Object updated with Palette and Legend
const translations = {
    english: {
        next: "Next",
        prev: "Previous",
        clear: "Clear",
        report: "Report",
        markReview: "Mark for Review",
        saveMarkReview: "Save & Mark for Review",
        submit: "Submit Test",
        marks: "Marks",
        negative: "Negative",
        paletteTitle: "Question Palette",
        legendTitle: "Legenda And State",
        states: ["Not Visited", "Answered", "Not Answered", "Mark for Review", "Save and Mark for Review"]
    },
    hindi: {
        next: "अगला",
        prev: "पिछला",
        clear: "साफ़ करें",
        report: "रिपोर्ट",
        markReview: "समीक्षा हेतु",
        saveMarkReview: "उत्तर दिया और समीक्षा हेतु चिह्नित",
        submit: "परीक्षा जमा करें",
        marks: "अंक",
        negative: "नकारात्मक",
        paletteTitle: "प्रश्नावली",
        legendTitle: "प्रश्न स्थिति:",
        states: ["प्रश्न नहीं देखा", "उत्तर दिया", "उत्तर नहीं दिया", "समीक्षा हेतु", "उत्तर दिया और समीक्षा हेतु चिह्नित"]
    }
};

const lang = localStorage.getItem("selectedLanguage") || "english";

/* ---------------- 1. Load Question ---------------- */
function loadQuestion(index) {
    visited[index] = true;
    const q = questions[index];
    const t = translations[lang] || translations.english; // Get language

    questionNumber.innerText = `Q${index + 1} : Multiple Choice Question`;

    // Dynamic Marks Label
    const marksBadge = document.querySelector(".marks-badge");
    if (marksBadge) {
        marksBadge.innerText = `${t.marks}: 1.00 | ${t.negative}: 0.33`;
    }

    const questionData = q.question[lang] || q.question.english;
    const optionsData = q.options[lang] || q.options.english;

    questionText.innerText = questionData;
    optionsContainer.innerHTML = "";

    optionsData.forEach((option, i) => {
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
        };
        optionsContainer.appendChild(div);
    });

    // Update Button Texts according to Language
    // Buttons Translation with <span> wrap (Mobile view fix ke liye)
    if(nextBtn) nextBtn.innerHTML = `<span>${t.next}</span> <i class="fa-solid fa-chevron-right"></i>`;
    if(prevBtn) prevBtn.innerHTML = `<i class="fa-solid fa-chevron-left"></i> <span>${t.prev}</span>`;
    if(eraseBtn) eraseBtn.innerHTML = `<i class="fa-solid fa-eraser"></i> <span>${t.clear}</span>`;
    if(reportBtn) reportBtn.innerHTML = `<i class="fa-solid fa-flag"></i> <span>${t.report}</span>`;
    if(markReviewBtn) markReviewBtn.innerHTML = `<i class="fa-solid fa-thumbtack"></i> <span>${t.markReview}</span>`;
    if(saveMarkReviewBtn) saveMarkReviewBtn.innerHTML = `<i class="fa-solid fa-floppy-disk"></i> <span>${t.saveMarkReview}</span>`;
    if(submitBtnTop) submitBtnTop.innerText = t.submit;

    // --- Naya Translation Logic (Palette & Legend) ---
    const pTitle = document.querySelector(".palette-container h5") || document.querySelector(".demo-test-title");
    if(pTitle) pTitle.innerText = t.paletteTitle;

    const lTitle = document.querySelector(".legenda-title");
    if(lTitle) lTitle.innerText = t.legendTitle;

    const legendLabels = document.querySelectorAll(".legenda-item span, .tiny-text");
    t.states.forEach((stateText, i) => {
        if(legendLabels[i]) legendLabels[i].innerText = stateText;
    });

    updatePalette();
}

/* ---------------- 2. Palette Logic ---------------- */
function createPalette() {
    paletteContainer.innerHTML = "";
    questions.forEach((_, i) => {
        const div = document.createElement("div");
        div.innerText = i + 1;
        div.classList.add("q-circle");
        div.id = `palette-num-${i}`;
        div.onclick = () => {
            currentQuestion = i;
            loadQuestion(currentQuestion);
        };
        paletteContainer.appendChild(div);
    });
}

function updatePalette() {
    questions.forEach((_, i) => {
        const btn = document.getElementById(`palette-num-${i}`);
        if (!btn) return;
        btn.className = "q-circle"; 
        if (i === currentQuestion) btn.classList.add("active");

        if (saveAndReview[i]) {
            btn.classList.add("save-mark-review"); // Purple + Green Dot
        } else if (reviewMarked[i]) {
            btn.classList.add("review"); // Pure Purple
        } else if (userAnswers[i] !== null) {
            btn.classList.add("answered"); // Green
        } else if (visited[i]) {
            btn.classList.add("not-answered"); // Red
        } else {
            btn.classList.add("not-visited"); // Gray
        }
    });
}

/* ---------------- 3. Navigation Buttons ---------------- */
nextBtn.addEventListener("click", () => {
    if (currentQuestion < questions.length - 1) {
        currentQuestion++;
        loadQuestion(currentQuestion);
    }
});

prevBtn.addEventListener("click", () => {
    if (currentQuestion > 0) {
        currentQuestion--;
        loadQuestion(currentQuestion);
    }
});

eraseBtn.addEventListener("click", () => {
    userAnswers[currentQuestion] = null;
    reviewMarked[currentQuestion] = false;
    saveAndReview[currentQuestion] = false;
    loadQuestion(currentQuestion);
});

markReviewBtn.addEventListener("click", () => {
    reviewMarked[currentQuestion] = true;
    saveAndReview[currentQuestion] = false;
    userAnswers[currentQuestion] = null;
    moveToNext();
});

saveMarkReviewBtn.addEventListener("click", () => {
    if (userAnswers[currentQuestion] !== null) {
        saveAndReview[currentQuestion] = true;
        reviewMarked[currentQuestion] = false;
        moveToNext();
    } else {
        alert(lang === 'hindi' ? "पहले विकल्प चुनें!" : "Please select an option first!");
    }
});

function moveToNext() {
    if (currentQuestion < questions.length - 1) {
        currentQuestion++;
        loadQuestion(currentQuestion);
    } else {
        updatePalette();
    }
}

/* ---------------- 4. Submit Logic (Final Detail) ---------------- */
const processFinalSubmission = () => {
    const confirmMsg = lang === 'hindi' ? "क्या आप वाकई सबमिट करना चाहते हैं?" : "Are you sure you want to submit?";
    if(!confirm(confirmMsg)) return;

    let correct = 0, wrong = 0, attempted = 0;
    questions.forEach((q, i) => {
        if (userAnswers[i] !== null) {
            attempted++;
            if (userAnswers[i] === q.correct) correct++;
            else wrong++;
        }
    });

    const totalMarks = correct * 1;
    const negativeValue = (wrong * 0.33).toFixed(2);
    const finalScoreValue = (totalMarks - negativeValue).toFixed(2);

    const resultData = {
        studentName: "Demo Student",
        email: "demo@gmail.com",
        mobile: "9988776655", // Fixed undefined
        testName: "General Knowledge",
        date: new Date().toLocaleString(),
        totalQuestions: questions.length,
        attempted: attempted,
        correct: correct,
        wrong: wrong,
        negativeMarks: negativeValue, // Yellow box fix
        finalScore: finalScoreValue    // Blue box fix
    };

    localStorage.setItem("resultData", JSON.stringify(resultData));
    window.location.href = "result.html"; 
};

[submitBtn, submitBtnTop].forEach(btn => {
    if(btn) btn.onclick = (e) => { e.preventDefault(); processFinalSubmission(); };
});

/* ---------------- 5. Chart Logic (Summary Only) ---------------- */
const chartModalElement = document.getElementById("chartModal");
if (chartModalElement) {
    chartModalElement.addEventListener("shown.bs.modal", function () {
        const attempted = userAnswers.filter(a => a !== null).length;
        const unattempted = questions.length - attempted;
        renderChart(attempted, unattempted);
    });
}

function renderChart(attempted, unattempted) {
    const ctx = document.getElementById("progressChart");
    if (!ctx) return;
    let chartStatus = Chart.getChart("progressChart");
    if (chartStatus !== undefined) chartStatus.destroy();

    new Chart(ctx, {
        type: "doughnut",
        data: {
            labels: ["Attempted", "Unattempted"],
            datasets: [{
                data: [attempted, unattempted],
                backgroundColor: ["#28a745", "#dc3545"],
                borderWidth: 0
            }]
        },
        options: { responsive: true, maintainAspectRatio: false }
    });
}

/* ---------------- 6. Timer & Init ---------------- */
let timeLeft = 60 * 60;
setInterval(() => {
    if (timeLeft <= 0) processFinalSubmission();
    let mins = Math.floor(timeLeft / 60);
    let secs = timeLeft % 60;
    document.getElementById("timer").innerText = `${mins}:${secs < 10 ? "0" : ""}${secs}`;
    timeLeft--;
}, 1000);

createPalette();
loadQuestion(currentQuestion);
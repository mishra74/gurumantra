const lang = localStorage.getItem("lang") || "en";
const quiz = questions[lang];

let current = 0;
let answers = new Array(quiz.length).fill(null);


// ===== PAGE LOAD =====
window.addEventListener("DOMContentLoaded", function(){

  // ===== Button & Title Language =====

  if (lang === "hi") {

    document.getElementById("pageTitle").innerText =
      "वेब डेवलपमेंट प्रैक्टिस सेट";

    document.getElementById("prevText").innerText = "पिछला";
    document.getElementById("reportText").innerText = "रिपोर्ट";
    document.getElementById("nextText").innerText = "अगला";
    document.getElementById("submitText").innerText = "सबमिट";
    document.getElementById("hintBtn").innerText = "संकेत देखें";

  } else {

    document.getElementById("pageTitle").innerText =
      "Web Development Practice Set";

    document.getElementById("prevText").innerText = "Previous";
    document.getElementById("reportText").innerText = "Report";
    document.getElementById("nextText").innerText = "Next";
    document.getElementById("submitText").innerText = "Submit";
    document.getElementById("hintBtn").innerText = "Show Hint";

  }

  loadQuestion();
});


// ===== LOAD QUESTION =====
function loadQuestion() {

  const q = quiz[current];

  document.getElementById("questionNumber").innerText =
    lang === "hi"
      ? `प्रश्न ${current + 1} / ${quiz.length}`
      : `Question ${current + 1} of ${quiz.length}`;

  document.getElementById("questionText").innerText = q.question;
  document.getElementById("hintBox").innerText = q.hint;

  let html = "";

  q.options.forEach((opt, i) => {
    html += `
      <div class="option-item ${answers[current] === i ? 'selected' : ''}" 
           onclick="selectOption(${i})">
        <div class="radio-circle ${answers[current] === i ? 'filled' : ''}"></div>
        <span>${opt}</span>
      </div>
    `;
  });

  document.getElementById("optionsBox").innerHTML = html;
}


// ===== SELECT OPTION =====
function selectOption(i) {

  answers[current] = i;
  loadQuestion();

  const correct = quiz[current].answer;
  const options = document.querySelectorAll(".option-item");

  options.forEach((opt, index) => {
    if (index === correct) opt.classList.add("correct");
    if (index === i && i !== correct) opt.classList.add("wrong");
  });
}


// ===== NEXT =====
function next() {
  if (current < quiz.length - 1) {
    current++;
    loadQuestion();
  }
}


// ===== PREVIOUS =====
function prev() {
  if (current > 0) {
    current--;
    loadQuestion();
  }
}


// ===== REPORT =====
function report() {
  if (lang === "hi") {
    alert("प्रश्न सफलतापूर्वक रिपोर्ट किया गया।");
  } else {
    alert("Question reported successfully.");
  }
}


// ===== SUBMIT =====
function submitTest() {
  localStorage.setItem("answers", JSON.stringify(answers));
  window.location.href = "result.html";
}

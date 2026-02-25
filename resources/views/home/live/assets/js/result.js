const data = JSON.parse(localStorage.getItem("resultData"));

if (data) {
    document.getElementById("studentName").innerText = data.studentName;
    document.getElementById("studentEmail").innerText = data.email;
    document.getElementById("studentMobile").innerText = data.mobile;
    document.getElementById("testName").innerText = data.testName;
    document.getElementById("testDate").innerText = data.date;
    document.getElementById("totalQuestions").innerText = data.totalQuestions;

    document.getElementById("correct").innerText = data.correct;
    document.getElementById("wrong").innerText = data.wrong;
    document.getElementById("negativeMarks").innerText = data.negativeMarks;
    document.getElementById("finalScore").innerText = data.finalScore;

    new Chart(document.getElementById("resultChart"), {
        type: "bar",
        data: {
            labels: ["Correct", "Wrong"],
            datasets: [{
                label: "Performance",
                data: [data.correct, data.wrong],
                backgroundColor: ["#28a745", "#dc3545"]
            }]
        }
    });
}
const lang = localStorage.getItem("selectedLanguage") || "english";
const resultData = JSON.parse(localStorage.getItem("resultData"));
const userAnswers = resultData.userAnswers;

const answerDetailBtn = document.getElementById("answerDetailBtn");
const answerDetailBox = document.getElementById("answerDetailBox");

answerDetailBtn.addEventListener("click", () => {

    answerDetailBox.innerHTML = "";

    questions.forEach((q, i) => {

        const userAnswerIndex = userAnswers[i];

        const correctAnswer = q.options[lang][q.correct];
        const userAnswer =
            userAnswerIndex !== null
                ? q.options[lang][userAnswerIndex]
                : "Not Attempted";

        answerDetailBox.innerHTML += `
            <div class="card p-3 mb-3 shadow-sm">
                <h6>Question ${i + 1}</h6>
                <p><strong>Your Answer:</strong> ${userAnswer}</p>
                <p><strong>Correct Answer:</strong> ${correctAnswer}</p>
            </div>
        `;
    });

});

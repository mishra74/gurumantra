// Load Components (Header & Footer)
function loadComponent(id, filePath) {
    fetch(filePath)
        .then(response => response.text())
        .then(data => {
            document.getElementById(id).innerHTML = data;
        });
}

if (document.getElementById("header")) {
    loadComponent("header", "../components/header.html");
}

if (document.getElementById("footer")) {
    loadComponent("footer", "../components/footer.html");
}



// Language Modal Logic
const nextBtn = document.getElementById("nextBtn");
if (nextBtn) {
    nextBtn.addEventListener("click", function () {
        const language = document.getElementById("languageSelect").value;

        if (!language) {
            alert("Please select a language");
            return;
        }

        localStorage.setItem("selectedLanguage", language);
        window.location.href = "pages/instructions.html";
    });
}

// Instructions Page Logic
const termsCheck = document.getElementById("termsCheck");
const startTestBtn = document.getElementById("startTestBtn");

if (termsCheck) {
    termsCheck.addEventListener("change", function () {
        startTestBtn.disabled = !this.checked;
    });
}

if (startTestBtn) {
    startTestBtn.addEventListener("click", function () {
        window.location.href = "test.html";
    });
}

const lang = localStorage.getItem("selectedLanguage") || "english";

const instructionData = {
    english: `
        <h5 class="fw-bold">General Instructions:</h5>
        <ol>
            <li>Total duration of the test is 60 minutes.</li>
            <li>The timer will be displayed on the top right corner.</li>
            <li>Once the timer ends, the test will auto submit.</li>
            <li>You can navigate between questions using the palette.</li>
            <li>Mark for Review questions will be evaluated.</li>
        </ol>

        <h5 class="fw-bold mt-4">Color Indicators:</h5>
        <ul>
            <li><span class="badge bg-secondary">Gray</span> Not Visited</li>
            <li><span class="badge bg-danger">Red</span> Not Answered</li>
            <li><span class="badge bg-success">Green</span> Answered</li>
            <li><span class="badge bg-purple" style="background: purple;">Purple</span> Marked for Review</li>
        </ul>
    `,
    hindi: `
        <h5 class="fw-bold">सामान्य निर्देश:</h5>
        <ol>
            <li>परीक्षा की कुल अवधि 60 मिनट है।</li>
            <li>टाइमर स्क्रीन के ऊपर दाईं ओर दिखेगा।</li>
            <li>समय समाप्त होने पर परीक्षा स्वतः सबमिट हो जाएगी।</li>
            <li>आप प्रश्न पैलेट से प्रश्न बदल सकते हैं।</li>
            <li>रीव्यू के लिए मार्क किए गए प्रश्नों का मूल्यांकन होगा।</li>
        </ol>

        <h5 class="fw-bold mt-4">रंग संकेत:</h5>
        <ul>
            <li><span class="badge bg-secondary">ग्रे</span> अभी नहीं देखा</li>
            <li><span class="badge bg-danger">लाल</span> उत्तर नहीं दिया</li>
            <li><span class="badge bg-success">हरा</span> उत्तर दिया</li>
            <li><span class="badge" style="background: purple;">बैंगनी</span> रीव्यू के लिए मार्क</li>
        </ul>
    `
};

if (document.getElementById("instructionContent")) {
    document.getElementById("instructionContent").innerHTML = instructionData[lang];

    if (lang === "hindi") {
        document.getElementById("instructionTitle").innerText = "निर्देश";
        document.getElementById("agreeText").innerText =
            "मैंने सभी निर्देश पढ़ लिए हैं और समझ लिए हैं।";
        document.getElementById("startTestBtn").innerText = "परीक्षा प्रारंभ करें";
    }
}

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Instructions</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>
body{
    background: linear-gradient(135deg,#4e73df,#1cc88a);
    min-height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
}

.card-custom{
    max-width:600px;
    width:100%;
    border-radius:20px;
}

.start-btn{
    border-radius:30px;
    font-weight:600;
}
</style>
</head>

<body>

<div class="card shadow-lg p-4 card-custom bg-white">

<h3 id="title" class="fw-bold mb-3 text-center"></h3>

<ul id="list" class="list-group mb-3"></ul>

<div class="text-center">
<button class="btn btn-primary px-5 py-2 start-btn" onclick="startTest()">
<i class="bi bi-play-circle me-2"></i>Start Now
</button>
</div>

</div>

<script>

// 🔥 FIXED LANGUAGE KEY
const lang = localStorage.getItem("lang") || "en";


// 🔥 TEMP QUESTION COUNT (Safe)
let totalQuestions = 4; // agar future me change karna ho to yaha change karo

// Agar questionsData available hai to dynamic lo
if(typeof questionsData !== "undefined"){
    totalQuestions = questionsData[lang].length;
}

const data = {
    en: [
        `Total ${totalQuestions} Questions`,
        "Each Question carries 1 Mark",
        "No Negative Marking",
        "Click Submit after completion"
    ],
    hi: [
        `कुल ${totalQuestions} प्रश्न`,
        "प्रत्येक प्रश्न 1 अंक का है",
        "कोई नकारात्मक अंक नहीं",
        "समाप्ति के बाद सबमिट करें"
    ]
};


document.getElementById("title").innerText =
lang==="2"?"General Instructions":"सामान्य निर्देश";


document.getElementById("list").innerHTML =
data[lang].map(i=>`
<li class="list-group-item border-0">
<i class="bi bi-check-circle-fill text-primary me-2"></i>${i}
</li>`).join("");

function startTest(){
    window.location.href="/student/practise/start";
}

</script>

</body>
</html>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Practice Portal</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>
body{
    margin:0;
    height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    background: linear-gradient(-45deg,#4e73df,#6f42c1,#1cc88a,#36b9cc);
    background-size:400% 400%;
    animation:gradientMove 10s ease infinite;
    font-family: 'Segoe UI', sans-serif;
}

@keyframes gradientMove{
    0%{background-position:0% 50%;}
    50%{background-position:100% 50%;}
    100%{background-position:0% 50%;}
}

.glass-card{
    backdrop-filter: blur(15px);
    background: rgba(255,255,255,0.15);
    border-radius:20px;
    padding:50px 40px;
    text-align:center;
    color:#fff;
    max-width:600px;
    width:90%;
    box-shadow:0 20px 40px rgba(0,0,0,0.2);
}

.start-btn{
    background:#fff;
    color:#4e73df;
    font-weight:600;
    padding:12px 30px;
    border-radius:30px;
    border:none;
    transition:0.3s;
}

.start-btn:hover{
    transform:scale(1.05);
    box-shadow:0 10px 20px rgba(0,0,0,0.3);
}
</style>
</head>

<body>

<div class="glass-card">
<h1>Practice Test Portal</h1>
<p>Boost your preparation with real interactive practice sets</p>

<button class="start-btn" data-bs-toggle="modal" data-bs-target="#languageModal">
<i class="bi bi-translate me-2"></i>Select Language
</button>
</div>

<!-- Language Modal -->
<div class="modal fade" id="languageModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4">
      <div class="modal-header">
        <h5 class="modal-title">Choose Language</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-center">
@foreach($languages as $language)
        <button class="btn btn-outline-primary w-100 mb-3"
        onclick="selectLanguage({{$language->id}})">
        {{$language->name}}
        </button>
@endforeach
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
function selectLanguage(lang){
    localStorage.setItem("lang", lang);

    window.location.href="/student/practise/instructions";
}
</script>

</body>
</html>

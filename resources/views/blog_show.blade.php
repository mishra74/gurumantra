@extends('layouts.master')
<style>
  .navbar{
  position:sticky;
  top:0;
  z-index:10;
  backdrop-filter:blur(8px);
}

.hero{
  max-width:900px;
  margin:40px auto 0;
  padding:0 16px;
}

.hero h1{
  font-size:38px;
  font-weight:800;
  line-height:1.3;
}

.meta{
  color:#777;
  font-size:14px;
  margin-top:6px;
}

.hero img{
  width:100%;
  height:280px;          /* 🔥 main control */
  object-fit:cover;
  border-radius:16px;
  margin-top:20px;
  box-shadow:0 12px 28px rgba(0,0,0,0.12);
}


.share-btn{
  background:#fb7e09;
  color:white;
  border:none;
  border-radius:50%;
  width:42px;
  height:42px;
  display:flex;
  align-items:center;
  justify-content:center;
}

.blog-body{
  max-width:820px;
  margin:50px auto;
  padding:0 16px;
}

.blog-body p{
  font-size:18px;
  line-height:1.8;
  margin-bottom:22px;
  color:#333;
}

.blog-body h3{
  font-size:24px;
  font-weight:700;
  margin-top:40px;
  margin-bottom:14px;
}

.highlight{
  background:#fff3e6;
  border-left:6px solid #fb7e09;
  padding:18px;
  border-radius:10px;
  margin:30px 0;
}

.hero h1{
  font-size:32px;        /* size same rahe */
  font-weight:500;      /* 800 → 600 (light + thoda bold) */
  letter-spacing:0.3px; /* thoda premium feel */
}


.read-progress{
  position:fixed;
  top:0;
  left:0;
  height:4px;
  background:#fb7e09;
  width:0%;
  z-index:100;
}
  </style>
@section('content')
<div class="read-progress" id="progress"></div>

<nav class="navbar bg-white shadow-sm py-3">
  <div class="container d-flex justify-content-between">
    <a class=" fs-5 text-decoration-none text-dark" href="blogs.html">← Back</a>
    <button class="share-btn" onclick="sharePage()">
      <i class="bi bi-share-fill"></i>
    </button>
  </div>
</nav>

<section class="hero">
  <h1>{{ $blog->title }}</h1>
  
  <img src="{{ asset($blog->thumbnail) }}" alt="Blog Detail" class="my-4">
</section>

<section class="blog-body">
{!! $blog->contents !!}

</section>
<script>
function sharePage(){
  if(navigator.share){
    navigator.share({
      title: document.title,
      url: window.location.href
    });
  }else{
    navigator.clipboard.writeText(window.location.href);
    alert("Link copied to clipboard!");
  }
}

window.addEventListener("scroll", ()=>{
  let scrollTop = document.documentElement.scrollTop;
  let height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
  let percent = (scrollTop / height) * 100;
  document.getElementById("progress").style.width = percent + "%";
});
</script>

@endsection

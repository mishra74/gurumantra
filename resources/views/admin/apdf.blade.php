<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $data->title }} PDF</title>
@php
    $fontPath = public_path('fonts/NotoSansDevanagari-Regular.ttf');
@endphp

<style>
    @font-face {
        font-family: 'hindi';
        src: url("{{ $fontPath }}") format("truetype");
    }

    
</style>
    <style>
        /* ✅ Load Hindi Font */
        @font-face {
            font-family: 'NotoHindi';
            src: url("{{ public_path('fonts/NotoSansDevanagari-Regular.ttf') }}") format("truetype");
            font-weight: normal;
            font-style: normal;
        }

       
    body {
        font-family: DejaVu Sans, sans-serif;
    }


        h1, h2, h4 {
            text-align: center;
            margin: 5px 0;
        }

        .logo {
            text-align: center;
            margin-bottom: 10px;
        }

        .logo img {
            width: 80px;
        }

        .title {
            font-size: 22px;
            font-weight: bold;
        }

        .subtitle {
            font-size: 16px;
            margin-bottom: 20px;
        }

        .content {
            margin-top: 20px;
            text-align: left;
        }

        /* ✅ Watermark */
        .watermark {
            position: fixed;
            top: 35%;
            left: 15%;
            opacity: 0.08;
            z-index: -1;
        }

        .watermark img {
            width: 350px;
        }

        /* Footer */
        .footer {
            position: fixed;
            bottom: 10px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 12px;
            color: #555;
        }

    </style>
</head>

<body>

    <!-- ✅ Watermark -->
    <div class="watermark">
        <img src="{{ public_path('frontend/images/logo.png') }}">
        @for($i = 0; $i < 20; $i++)
        <div class="watermark-item">
            <div class="watermark-text">{{ url('/') }}</div>
        </div>
    @endfor
    </div>

    <!-- ✅ Header -->
    <div class="logo">
        <img src="{{ public_path('frontend/images/logo.png') }}">
    </div>

    <h1 class="title">{{ $data->title }}</h1>
    <h4 class="subtitle">{{ $data->sub_title }}</h4>

    <hr>

    <!-- ✅ Content -->
    <div class="content">

        @php
            $content = $data->pdf_enter_answer;
        @endphp

        {{-- If JSON --}}
        @if(is_string($content) && json_decode($content))
            @foreach(json_decode($content, true) as $item)
                <p>{{ $item }}</p>
            @endforeach

        {{-- If HTML --}}
        @else
            {!! html_entity_decode($content) !!}
        @endif

    </div>

    <!-- ✅ Footer -->
    <div class="footer">
        {{ url('/') }}
    </div>

</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $data->title }} PDF</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            margin: 40px;
            font-size: 14px;
            line-height: 1.6;
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

        /* ✅ FULL PAGE WATERMARK (DOMPDF SAFE) */
        .watermark {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0.08;
            z-index: -1;
        }

        .watermark table {
            width: 100%;
            height: 100%;
            border-collapse: collapse;
        }

        .watermark td {
            text-align: center;
            vertical-align: middle;
            font-size: 12px;
            padding: 30px;
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

    <!-- ✅ WATERMARK -->
    <div class="watermark">
        <table>
            @for($i = 0; $i < 15; $i++)
                <tr>
                    @for($j = 0; $j < 5; $j++)
                        <td>{{ url('/') }}</td>
                    @endfor
                </tr>
            @endfor
        </table>
    </div>

    <!-- ✅ HEADER -->
    <div class="logo">
        <img src="{{ public_path('frontend/images/logo.png') }}">
    </div>

    <h1 class="title">{{ $data->title }}</h1>
    <h4 class="subtitle">{{ $data->sub_title }}</h4>

    <hr>

    <!-- ✅ CONTENT -->
    <div class="content">

        @php
            $content = $data->pdf_enter_question;
        @endphp

        {{-- JSON Content --}}
        @if(is_string($content) && json_decode($content))
            @foreach(json_decode($content, true) as $item)
                <p>{{ $item }}</p>
            @endforeach

        {{-- HTML Content --}}
        @else
            {!! html_entity_decode($content) !!}
        @endif

    </div>

    <!-- ✅ FOOTER -->
    <div class="footer">
        {{ url('/') }}
    </div>

</body>
</html>
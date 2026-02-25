<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Test Result</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        h2 { text-align:center; }
        table { width:100%; border-collapse: collapse; margin-top:20px; }
        th, td { border:1px solid #000; padding:8px; text-align:center; }
        .section { margin-top:20px; }
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
    </style>
</head>
<body class="card-body">

<h2>Test Result Summary</h2>

<div class="section">
    <strong>Name:</strong> {{ $user->name }} <br>
    <strong>Email:</strong> {{ $user->email }} <br>
    <strong>Test:</strong> {{ $data->exam_type }} <br>
    <strong>Date:</strong> {{ $data->created_at->format('d M Y') }} <br>
</div>

<table>
<tr>
    <th>Total Questions</th>
    <th>Correct</th>
    <th>Wrong</th>
    <th>Percentage</th>
</tr>
<tr>
    <td>{{ $data->total_questions }}</td>
    <td>{{ $data->correct }}</td>
    <td>{{ $data->incorrect }}</td>
    <td>{{ number_format($data->percentage,1) }}%</td>
</tr>
</table>

<div class="section">
    <strong>Final Score:</strong>
    {{ $data->correct }}/{{ $data->total_questions }}
</div>

</body>
</html>
@extends('layouts.master')
@section('content')

<div class="container mt-4">
    <div class="row">
        <div class="col-12">

            <h3 class="mb-3">Live Class</h3>

            <p>Welcome, <strong>{{ $username }}</strong></p>

            @if($embedUrl)

                <div class="ratio ratio-16x9">
                    <iframe 
                        src="https://www.youtube.com/embed/{{ $embedUrl }}" 
                        title="YouTube Live Class"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>
                </div>

            @else
                <div class="alert alert-danger mt-3">
                    Live class is not available right now.
                </div>
            @endif

        </div>
    </div>
</div>

@endsection
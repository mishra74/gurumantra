@include('layouts.header')

<div class="container-fluid py-4">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
            <h4 class="fw-bold mb-0">BPSC 70th Demo Test - 1</h4>
            <div id="timer" class="timer">⏱ 01:00:00</div>
        </div>

        <div class="row g-4">
            <!-- Left Section -->
            <div class="col-lg-8">
                @foreach($questions as $index => $q)
                @php
                    $options = is_array($q->options) ? $q->options : json_decode($q->options, true);
                @endphp

                <div class="exam-container" id="question-{{ $q->id }}" style="display: none;" data-status="not-visited">
                    <div class="p-3 bg-primary text-white d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-0 text-white">Q{{ $index+1 }}: {{ $q->type ?? 'MCQ' }}</h5>
                        </div>
                        <div>
                            <small>Marks: <b>{{ $q->marks }}</b> | Negative: <b>{{ $q->negative_marks }}</b></small>
                        </div>
                    </div>

                    <div class="p-4">
                        <p class="fw-semibold">{!! $q->question !!}</p>
                        <div class="question-options mt-4">
                            @foreach($options as $opt)
                            <label class="list-group-item d-flex align-items-center mb-2 border">
                                <input class="form-check-input me-3 answer-radio"
                                       type="radio"
                                       name="q{{ $q->id }}"
                                       value="{{ strip_tags($opt) }}"
                                       data-question="{{ $q->id }}">
                                <span>{!! $opt !!}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="d-flex flex-wrap justify-content-end gap-2 border-top p-3 bg-light">
                        <button class="btn btn-outline-danger btn-sm clear-answer" data-qid="{{ $q->id }}">Clear</button>
                        <button class="btn btn-outline-secondary btn-sm">Report Question</button>
                        <button class="btn btn-warning btn-sm text-white mark-review" data-qid="{{ $q->id }}">Mark for Review</button>

                        @if($index > 0)
                            <button class="btn btn-secondary btn-sm prev-btn" data-prev="{{ $questions[$index-1]->id }}">Previous</button>
                        @endif

                        @if($index < count($questions)-1)
                            <button class="btn btn-primary btn-sm next-btn" data-next="{{ $questions[$index+1]->id }}">Next</button>
                        @else
                            <button class="btn btn-success btn-sm submit-test">Submit Test</button>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Right Sidebar -->
            <div class="col-lg-4">
                <div class="sidebar-card mb-4">
                    <div class="card-header bg-success text-white fw-bold">
                        BPSC 70th Free Test - 1 (GS)
                    </div>
                    <div class="card-body question-grid d-flex flex-wrap gap-2">
                        @foreach($questions as $index => $q)
                        <button class="btn btn-sm btn-light border nav-btn" data-qid="{{ $q->id }}">{{ $index + 1 }}</button>
                        @endforeach
                    </div>
                </div>

                <div class="sidebar-card mb-4">
                    <div class="card-header bg-primary text-white fw-bold">Legend & State</div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-1"><span id="not-visited-count" class="badge bg-secondary me-2">0</span> Not Visited</li>
                            <li class="mb-1"><span id="answered-count" class="badge bg-success me-2">0</span> Answered</li>
                            <li class="mb-1"><span id="not-answered-count" class="badge bg-danger me-2">0</span> Not Answered</li>
                            <li class="mb-1"><span id="mark-review-count" class="badge bg-warning me-2">0</span> Mark for Review</li>
                        </ul>
                    </div>
                </div>

                <button class="btn btn-success w-100 py-2 fw-bold shadow-sm submit-test">Submit Test</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){

    // Timer
    let totalSeconds = 3600;
    const timerElement = $('#timer');
    setInterval(() => {
        const h = Math.floor(totalSeconds / 3600);
        const m = Math.floor((totalSeconds % 3600) / 60);
        const s = totalSeconds % 60;
        timerElement.text(`⏱ ${String(h).padStart(2,'0')}:${String(m).padStart(2,'0')}:${String(s).padStart(2,'0')}`);
        totalSeconds--;
    }, 1000);

    // Show first question
    $('.exam-container').hide().first().fadeIn(200);

    // Update Legend counts
    function updateLegend() {
        let notVisited = $('.exam-container[data-status="not-visited"]').length;
        let answered = $('.exam-container[data-status="answered"]').length;
        let notAnswered = $('.exam-container[data-status="not-answered"]').length;
        let markReview = $('.exam-container[data-status="mark-review"]').length;

        $('#not-visited-count').text(notVisited);
        $('#answered-count').text(answered);
        $('#not-answered-count').text(notAnswered);
        $('#mark-review-count').text(markReview);
    }

    // Live save on option select
    $(document).on('change', '.answer-radio', function(){
        const qid = $(this).data('question');
        const val = $(this).val();

        // Mark question as answered
        $('#question-' + qid).attr('data-status', 'answered');
        updateLegend();

        $.post("{{ route('liveclass.saveAnswer') }}", {
            _token: "{{ csrf_token() }}",
            test_id: "{{ $test_id }}",
            volume_id: "{{ $volume_id }}",
            question_id: qid,
            selected_answer: val
        });
    });

    // Clear answer
    $(document).on('click', '.clear-answer', function(){
        const qid = $(this).data('qid');
        $(`input[name="q${qid}"]`).prop('checked', false);
        $('#question-' + qid).attr('data-status', 'not-answered');
        updateLegend();
    });

    // Mark for review
    $(document).on('click', '.mark-review', function(){
        const qid = $(this).data('qid');
        const qDiv = $('#question-' + qid);
        if(qDiv.attr('data-status') !== 'answered'){
            qDiv.attr('data-status', 'mark-review');
        } else {
            // optionally allow mark review for answered too
            qDiv.attr('data-status', 'mark-review');
        }
        updateLegend();
    });

    // Next button
    $(document).on('click', '.next-btn', function(){
        let currentCard = $(this).closest('.exam-container');
        let nextId = $(this).data('next');

        // Mark as not-answered if no option selected
        if(currentCard.find('.answer-radio:checked').length === 0){
            currentCard.attr('data-status', 'not-answered');
        }

        updateLegend();
        $('.exam-container').hide();
        $('#question-' + nextId).fadeIn(200);
    });

    // Previous button
    $(document).on('click', '.prev-btn', function(){
        let prevId = $(this).data('prev');
        $('.exam-container').hide();
        $('#question-' + prevId).fadeIn(200);
    });

    // Sidebar navigation
    $(document).on('click', '.nav-btn', function(){
        let qid = $(this).data('qid');
        $('.exam-container').hide();
        $('#question-' + qid).fadeIn(200);
    });

    // Submit test
    $(document).on('click', '.submit-test', function(){
        let allAnswers = [];
        $('.answer-radio:checked').each(function(){
            allAnswers.push({
                question_id: $(this).data('question'),
                selected_answer: $(this).val()
            });
        });

        // Save all answers first
        allAnswers.forEach(ans => {
            $.ajax({
                url: "{{ route('liveclass.saveAnswer') }}",
                type: "POST",
                async: false,
                data: {
                    _token: "{{ csrf_token() }}",
                    test_id: "{{ $test_id }}",
                    volume_id: "{{ $volume_id }}",
                    question_id: ans.question_id,
                    selected_answer: ans.selected_answer
                }
            });
        });

        // Submit
        $.post("{{ route('liveclass.submitTest') }}", {
            _token: "{{ csrf_token() }}",
            test_id: "{{ $test_id }}",
            volume_id: "{{ $volume_id }}"
        }, function(res){
            if(res.status){
                alert(`✅ Test Submitted!\n\nTotal: ${res.total}\nCorrect: ${res.correct}\nWrong: ${res.wrong}`);
            }
        });
    });

    // Initialize legend
    updateLegend();
});
</script>

@include('layouts.footer')

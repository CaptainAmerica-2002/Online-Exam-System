@extends('adminlte::page')

@section('css')

<style>

body{
user-select:none;
}

</style>

@stop
@section('title', $exam->title)

@section('content_header')
    <h1>{{ $exam->title }}</h1>
@stop

@section('content')

<div class="alert alert-warning text-center">
    ⏳ Time Remaining:
    <strong id="timer">
        {{ $exam->duration }}:00
    </strong>
</div>

<form id="examForm" method="POST" action="{{ url('/student/exam/submit') }}">
    @csrf
    <input type="hidden" name="exam_id" value="{{ $exam->id }}">

    @foreach($exam->questions as $q)
        <div class="mb-4">
            <p><strong>{{ $q->question }}</strong></p>

            @foreach(['a','b','c','d'] as $opt)
                <div class="form-check">
                    <input class="form-check-input"
                           type="radio"
                           name="answers[{{ $q->id }}]"
                           value="{{ $opt }}">

                    <label class="form-check-label">
                        {{ $q->{'option_'.$opt} }}
                    </label>
                </div>
            @endforeach
        </div>
        <hr>
    @endforeach

    <button type="submit" id="submitBtn" class="btn btn-primary">
        Submit Exam
    </button>

    <div id="loader" class="mt-3 text-info" style="display:none;">
        Submitting exam... Please wait ⏳
    </div>
</form>

@stop

@section('js')

<script>


document.addEventListener("DOMContentLoaded", function(){
let totalMinutes = {{ $exam->duration }};
let totalSeconds = totalMinutes * 60;

let timerDisplay = document.getElementById("timer");
let examForm = document.getElementById("examForm");
let submitBtn = document.getElementById("submitBtn");
let loader = document.getElementById("loader");
let examSubmitting = false;

/* ===========================
   DISABLE CHEATING ACTIONS
=========================== */

// Disable right click
document.addEventListener("contextmenu", function(e){
    e.preventDefault();
});

// Disable copy & inspect shortcuts
document.addEventListener("keydown", function(e){

    if (
        (e.ctrlKey && e.key === "c") || // copy
        (e.ctrlKey && e.key === "a") || // select all
        (e.ctrlKey && e.key === "u") || // view source
        (e.ctrlKey && e.shiftKey && e.key === "I") || // inspect
        e.key === "F12" // dev tools
    ){
        e.preventDefault();
    }

});


/* ===========================
   TIMER
=========================== */

function startTimer(){

    let countdown = setInterval(function(){

        let minutes = Math.floor(totalSeconds / 60);
        let seconds = totalSeconds % 60;

        seconds = seconds < 10 ? "0" + seconds : seconds;

        timerDisplay.innerHTML = minutes + ":" + seconds;

        totalSeconds--;

        if(totalSeconds <= 0){
            clearInterval(countdown);

            

            alert("Time is over! Exam will be auto-submitted.");

            autoSubmitExam();
        }

    },1000);

}


/* ===========================
   TAB SWITCH PROTECTION
=========================== */

let tabSwitchCount = 0;
const maxSwitchAllowed = 3;

document.addEventListener("visibilitychange", function(){

    // ignore if exam is already submitting
    if(examSubmitting) return;
    
    if(document.hidden){
        
        tabSwitchCount++;

        if(tabSwitchCount === 1){
            alert("⚠ Warning 1: Do not switch tabs!");
        }

        else if(tabSwitchCount === 2){
            alert("⚠ Warning 2: Next switch will auto submit!");
        }

        else if(tabSwitchCount >= maxSwitchAllowed){
            alert("❌ You switched tabs 3 times. Exam auto submitting now.");
            autoSubmitExam();
        }

    }

});


/* ===========================
   AUTO SUBMIT FUNCTION
=========================== */
function autoSubmitExam(){

    if(examSubmitting) return;

    examSubmitting = true;

    submitBtn.disabled = true;

    loader.style.display = "block";

    fetch("{{ url('/student/exam/submit') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}", "Accept": "application/json"
        },
        body: new FormData(examForm)
    })
    .then(response => {

        // convert response to json
        return response.json();

    })
    .then(data => {

        console.log("Server response:", data);

        if(data.success){

            // show message briefly
            loader.innerHTML = "Submission successful. Redirecting...";

            setTimeout(function(){

                window.location.href = data.redirect;

            },500);

        }

    })
    .catch(error => {

        console.log(error);

        loader.innerHTML = "Submission successful. Redirecting...";

        // fallback redirect
        setTimeout(function(){

            window.location.href = "/student/results";

        },500);

    });

}

/* ===========================
   MANUAL SUBMIT
=========================== */

examForm.addEventListener('submit',function(e){
    e.preventDefault();
    if(examSubmitting) return;
    
    autoSubmitExam();
});


/* ===========================
   START TIMER
=========================== */

startTimer();
});
</script>

@endsection

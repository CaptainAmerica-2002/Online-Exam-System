<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamAttempt;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ExamController extends Controller
{

    // =========================
    // Show Available Exams
    // =========================
    public function index()
    {
        $student = auth()->user();
        $now = \Carbon\Carbon::now();

        $exams = \App\Models\Exam::where('status', 'published')
            ->where('department', $student->department)
            ->where(function ($q) use ($now) {
                $q->whereNull('start_time')
                  ->orWhere('start_time', '<=', $now);
            })
            ->where(function ($q) use ($now) {
                $q->whereNull('end_time')
                  ->orWhere('end_time', '>=', $now);
            })
            ->get();

        return view('student.exams', compact('exams'));
    }


    // =========================
    // Show Exam
    // =========================
    public function show($id)
    {
        $student = auth()->user();

        $exam = Exam::with('questions')->findOrFail($id);

        // Block other department exams
        if ($exam->department !== $student->department) {
            abort(403);
        }

        $now = \Carbon\Carbon::now();

        if ($exam->start_time && $now->lt($exam->start_time)) {
            abort(403, 'Exam has not started yet');
        }

        if ($exam->end_time && $now->gt($exam->end_time)) {
            abort(403, 'Exam has ended');
        }

        // If already attempted → go to result
        $attempt = ExamAttempt::where('exam_id', $exam->id)
            ->where('student_id', $student->id)
            ->first();

        if ($attempt) {
            return redirect('/student/results/'.$attempt->id);
        }

        return view('student.take-exam', compact('exam'));
    }


    // =========================
    // Submit Exam
    // =========================
    public function submit(Request $request)
    {
        $request->validate([
            'exam_id' => 'required|exists:exams,id',
        ]);

        $student = auth()->user();

        $exam = Exam::with('questions')->findOrFail($request->exam_id);

        // Block other department
        if ($exam->department !== $student->department) {
            abort(403);
        }

        // Allow only one attempt
        $alreadyAttempted = ExamAttempt::where('exam_id', $exam->id)
            ->where('student_id', $student->id)
            ->exists();

        if ($alreadyAttempted) {
            return response()->json([
                'success' => true,
                'redirect' => url('/student/results'),
            ]);
        }

        $answers = $request->answers ?? [];

        // Create attempt
        $attempt = ExamAttempt::create([
            'exam_id' => $exam->id,
            'student_id' => $student->id,
            'score' => 0,
            'percentage' => 0,
            'status' => 'fail',
        ]);

        $score = 0;
        $totalQuestions = $exam->questions->count();

        foreach ($answers as $question_id => $answer) {

            $question = \App\Models\Question::find($question_id);

            if ($question) {

                \App\Models\Answer::create([
                    'exam_attempt_id' => $attempt->id,
                    'question_id' => $question_id,
                    'selected_option' => $answer,
                ]);

                if ($question->correct_option === $answer) {
                    $score++;
                }
            }
        }

        $percentage = $totalQuestions > 0
            ? round(($score / $totalQuestions) * 100, 2)
            : 0;

        $status = $percentage >= 40 ? 'pass' : 'fail';

        $attempt->update([
            'score' => $score,
            'percentage' => $percentage,
            'status' => $status,
        ]);

        return response()->json([
            'success' => true,
            'redirect' => url('/student/results/'.$attempt->id),
        ]);
    }


    // =========================
    // Results List
    // =========================
    public function results()
    {
        $student = auth()->user();

        $attempts = ExamAttempt::with('exam')
            ->where('student_id', $student->id)
            ->latest()
            ->get();

        return view('student.results', compact('attempts'));
    }


    // =========================
    // Single Result
    // =========================
    public function showResult($id)
    {
        $attempt = ExamAttempt::with(['exam','answers.question'])
            ->findOrFail($id);

        abort_if($attempt->student_id != auth()->id(), 403);

        $student = auth()->user();

        $totalQuestions = $attempt->answers->count();

        $correctAnswers = 0;

        foreach ($attempt->answers as $answer) {

            if ($answer->selected_option == $answer->question->correct_option) {
                $correctAnswers++;
            }

        }

        $wrongAnswers = $totalQuestions - $correctAnswers;

        return view('student.result', compact(
            'attempt',
            'student',
            'totalQuestions',
            'correctAnswers',
            'wrongAnswers'
        ));
    }


    public function downloadResult($id)
    {
        $attempt = \App\Models\ExamAttempt::with(['exam','answers.question'])->findOrFail($id);

        $student = auth()->user();

        $totalQuestions = $attempt->answers->count();

        $correctAnswers = 0;

        foreach ($attempt->answers as $answer) {
            if ($answer->selected_option == $answer->question->correct_option) {
                $correctAnswers++;
            }
        }

        $wrongAnswers = $totalQuestions - $correctAnswers;

        $pdf = Pdf::loadView('student.result-pdf', compact(
            'attempt',
            'student',
            'totalQuestions',
            'correctAnswers',
            'wrongAnswers'
        ));

        $fileName = $attempt->exam->title . ' Result.pdf';

        return $pdf->download($fileName);
    }

}
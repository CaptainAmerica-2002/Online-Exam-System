<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Exam;

class TeacherExamController extends Controller
{
    public function index()
    {
        $exams = \App\Models\Exam::all();
        return view('teacher.exams', compact('exams'));
    }
    
    public function show($id)
    {
        $exam = Exam::with('questions')->findOrFail($id);

        return view('teacher.exam-paper', compact('exam'));
    }

    public function edit($id)
    {
        $exam = Exam::with('questions')->findOrFail($id);

        if ($exam->status === 'published') {
            abort(403, 'Exam already published');
        }
        return view('teacher.edit-exam', compact('exam'));
    }

    public function results($id)
    {
        $attempts = \App\Models\ExamAttempt::where('exam_id', $id)
            ->with('student')
            ->get();

        return view('teacher.exam-results', compact('attempts'));
    }
}

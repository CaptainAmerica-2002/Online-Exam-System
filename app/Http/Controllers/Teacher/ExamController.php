<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    // List only logged-in teacher exams
    public function index()
    {
        $exams = Exam::where('teacher_id', auth()->id())->get();
        return view('teacher.exams', compact('exams'));
    }

    // Store exam
    public function store(Request $request)
    {
        abort_if(auth()->user()->role !== 'teacher', 403);

        $request->validate([
            'title'      => 'required|string',
            'duration'   => 'required|integer',
            'department' => 'required|string',
            'start_time' => 'nullable|date',
            'end_time'   => 'nullable|date|after:start_time',
        ]);

        Exam::create([
            'title'      => $request->title,
            'subject'    => auth()->user()->subject, // from teacher profile
            'department' => $request->department,
            'duration'   => $request->duration,
            'teacher_id' => auth()->id(),
            'status'     => 'draft', // admin approval needed
            'start_time' => $request->start_time,
            'end_time'   => $request->end_time,
        ]);

        return redirect('/teacher/exams')
            ->with('success', 'Exam created. Waiting for admin approval.');
    }
}

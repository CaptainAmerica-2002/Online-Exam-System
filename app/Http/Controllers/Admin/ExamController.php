<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;

class ExamController extends Controller
{
    // show all exams to admin
    public function index()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $exams = Exam::with('teacher')->get();
        return view('admin.exams', compact('exams'));
    }

    // approve exam
    public function approve($id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $exam = Exam::findOrFail($id);
        $exam->update([
            'status' => 'published'
        ]);

        return back()->with('success', 'Exam approved');
    }
}

<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $student = auth()->user();
        $now = now();

        $availableExams = \App\Models\Exam::where('status', 'published')
            ->where('department', $student->department)
            ->where(function ($q) use ($now) {
                $q->whereNull('start_time')
                ->orWhere('start_time', '<=', $now);
            })
            ->where(function ($q) use ($now) {
                $q->whereNull('end_time')
                ->orWhere('end_time', '>=', $now);
            })
            ->count();

        return view('student.dashboard', compact('availableExams'));
    }

}

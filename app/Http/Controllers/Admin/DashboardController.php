<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Exam;
use App\Models\ExamAttempt;

class DashboardController extends Controller
{
    public function index()
    {
        $totalStudents = User::where('role','student')->count();
        $totalTeachers = User::where('role','teacher')->count();
        $totalExams = Exam::count();
        $pendingExams = Exam::where('status','draft')->count();

        $passCount = ExamAttempt::where('status','pass')->count();
        $failCount = ExamAttempt::where('status','fail')->count();

        return view('admin.dashboard', compact(
            'totalStudents',
            'totalTeachers',
            'totalExams',
            'pendingExams',
            'passCount',
            'failCount'
        ));
    }
}

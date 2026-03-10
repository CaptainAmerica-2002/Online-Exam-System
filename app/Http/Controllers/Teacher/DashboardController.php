<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Exam;

class DashboardController extends Controller
{
    public function index()
    {
        abort_if(auth()->user()->role !== 'teacher',403);

        $examCount = Exam::where('teacher_id',auth()->id())->count();

        return view('teacher.dashboard',compact('examCount'));
    }
}

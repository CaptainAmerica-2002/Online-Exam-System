<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\ExamController as AdminExamController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Teacher\ExamController;
use App\Http\Controllers\Teacher\TeacherExamController;
use App\Http\Controllers\Teacher\QuestionController;
use App\Http\Controllers\Teacher\DashboardController as TeacherDashboardController;

use App\Http\Controllers\Student\ExamController as StudentExamController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\ChatbotController;

/*
|--------------------------------------------------------------------------
| ROOT REDIRECT
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    if (auth()->check()) {
        return match (auth()->user()->role) {
            'admin' => redirect('/admin/dashboard'),
            'teacher' => redirect('/teacher/dashboard'),
            default => redirect('/dashboard'),
        };
    }

    return redirect('/login');
});

require __DIR__.'/auth.php';


/*
|--------------------------------------------------------------------------
| DASHBOARDS
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [StudentDashboardController::class,'index']);
    Route::get('/admin/dashboard', [AdminDashboardController::class,'index']);
    Route::get('/teacher/dashboard', [TeacherDashboardController::class,'index']);
});


/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->prefix('admin')->group(function () {

    Route::get('/create-teacher', function () {
        abort_if(auth()->user()->role !== 'admin', 403);
        return view('admin.create-teacher');
    });

    Route::post('/create-teacher', [TeacherController::class,'store']);

    Route::get('/users', [UserController::class,'index']);

    Route::get('/exams', [AdminExamController::class,'index']);
    Route::get('/exam/{id}/approve', [AdminExamController::class,'approve']);
});


/*
|--------------------------------------------------------------------------
| TEACHER
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->prefix('teacher')->group(function () {

    Route::get('/create-exam', function () {
        abort_if(auth()->user()->role !== 'teacher',403);
        return view('teacher.create-exam');
    });

    Route::post('/create-exam', [TeacherExamController::class,'store']);

    Route::get('/exams', [TeacherExamController::class,'index']);
    Route::post('teacher/question/update', [QuestionController::class,'update']);
    Route::get('/exam/{id}/add-question', [QuestionController::class,'create']);
    Route::get('/exam/{id}', [TeacherExamController::class,'show']);
    Route::get('/exam/{id}/results', [TeacherExamController::class,'results']);
    Route::get('/exam/{id}/edit', [TeacherExamController::class,'edit']);
    Route::post('/exam/add-question', [QuestionController::class,'store']);
});


/*
|--------------------------------------------------------------------------
| STUDENT
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->prefix('student')->group(function () {

    Route::get('/exams', [StudentExamController::class,'index']);
    Route::get('/exam/{id}', [StudentExamController::class,'show']);
    Route::post('/exam/submit', [StudentExamController::class,'submit']);

    Route::get('/results', [StudentExamController::class,'results']);
    Route::get('/results/{id}', [StudentExamController::class,'showResult']);
    Route::get('/results/{id}/download', [StudentExamController::class, 'downloadResult']);
});


/*
|--------------------------------------------------------------------------
| CHATBOT
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->post('/chatbot/process', [ChatbotController::class, 'process']);

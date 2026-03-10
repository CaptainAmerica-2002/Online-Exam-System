<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatbotController extends Controller
{
   public function process(Request $request)
{
    $message = strtolower($request->message);

    if (!$message) {
        return response()->json(['reply' => 'Please type something!']);
    }

    $user = auth()->user();
    $name = $user->name ?? 'User';
    $role = $user->role ?? 'student';

    // Smart matching keywords
    $keywords = [
        'exam', 'result', 'teacher', 'student',
        'dashboard', 'department', 'login',
        'register', 'analytics', 'count'
    ];

    $matched = false;
    foreach ($keywords as $word) {
        if (str_contains($message, $word)) {
            $matched = true;
            break;
        }
    }

    if (!$matched) {
        return response()->json([
            'reply' => "I can only answer questions related to the Online Exam System, $name 😊"
        ]);
    }

    // =========================
    // STUDENT
    // =========================
    if ($role === 'student') {

        if (str_contains($message, 'result')) {
            return response()->json([
                'reply' => "📊 You can check results in <b>My Results</b> section."
            ]);
        }

        if (str_contains($message, 'exam')) {
            $count = \App\Models\Exam::where('status','published')
                ->where('department',$user->department)
                ->count();

            return response()->json([
                'reply' => "📝 You have <b>$count</b> available exams."
            ]);
        }
    }

    // =========================
    // TEACHER
    // =========================
    if ($role === 'teacher') {

        if (str_contains($message, 'exam')) {
            $count = \App\Models\Exam::where('teacher_id',$user->id)->count();

            return response()->json([
                'reply' => "📝 You have created <b>$count</b> exams."
            ]);
        }

        if (str_contains($message, 'student')) {
            $count = \App\Models\User::where('role','student')->count();

            return response()->json([
                'reply' => "👨‍🎓 Total students in system: <b>$count</b>"
            ]);
        }
    }

    // =========================
    // ADMIN
    // =========================
    if ($role === 'admin') {

        if (str_contains($message, 'teacher')) {
            $count = \App\Models\User::where('role','teacher')->count();

            return response()->json([
                'reply' => "👨‍🏫 Total teachers: <b>$count</b>"
            ]);
        }

        if (str_contains($message, 'student')) {
            $count = \App\Models\User::where('role','student')->count();

            return response()->json([
                'reply' => "👨‍🎓 Total students: <b>$count</b>"
            ]);
        }

        if (str_contains($message, 'exam')) {
            $count = \App\Models\Exam::count();

            return response()->json([
                'reply' => "📚 Total exams in system: <b>$count</b>"
            ]);
        }
    }

    return response()->json([
        'reply' => "Ask something related to exams, dashboard or results 😊"
    ]);
}
}
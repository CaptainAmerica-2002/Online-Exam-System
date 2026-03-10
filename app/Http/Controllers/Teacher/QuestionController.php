<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function create($id)
    {
        $exam = \App\Models\Exam::findOrFail($id);

        if ($exam->status !== 'draft') {
            return redirect('/teacher/exams')
                ->with('error', 'You cannot add questions after publishing this exam.');
        }

        return view('teacher.add-question', compact('exam'));
    }





    public function store(Request $request)
    {
        $exam = \App\Models\Exam::findOrFail($request->exam_id);

        // 🔒 Block if not draft
        if ($exam->status !== 'draft') {
            return redirect('/teacher/exams')
                ->with('error', 'You cannot add questions after publishing this exam.');
        }


        // continue saving question...
    


        $request->validate([
            'exam_id' => 'required|exists:exams,id',
            'question' => 'required',
            'option_a' => 'required',
            'option_b' => 'required',
            'option_c' => 'required',
            'option_d' => 'required',
            'correct_option' => 'required|in:a,b,c,d',
        ]);

        Question::create([
            'exam_id' => $request->exam_id,
            'question' => $request->question,
            'option_a' => $request->option_a,
            'option_b' => $request->option_b,
            'option_c' => $request->option_c,
            'option_d' => $request->option_d,
            'correct_option' => $request->correct_option,
        ]);

        return back()->with('success', 'Question added successfully');
    }
    public function update(Request $request, $id)
    {
        $question = \App\Models\Question::findOrFail($id);

        $question->update([
            'question'=>$request->question,
            'option_a'=>$request->option_a,
            'option_b'=>$request->option_b,
            'option_c'=>$request->option_c,
            'option_d'=>$request->option_d,
            'correct_option'=>$request->correct_option
        ]);

        return back()->with('success','Question updated');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Exam;
class ExamAttempt extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_id',
        'student_id',
        'score',
        'percentage',
        'status',
    ];

    public function exam()
    {
        return $this->belongsTo(\App\Models\Exam::class);
    }
    public function answers()
    {
        return $this->hasMany(\App\Models\Answer::class, 'exam_attempt_id');
    }
    public function student()
    {
        return $this->belongsTo(\App\Models\User::class, 'student_id');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentLectureSchedule extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function scopeTeacherStudent($query, $teacherId = null, $studentId = null, $courseId = null, $dataType = null)
    {
        if ($dataType == 'teacher_students') {
            $query->where('teacher_id', $teacherId)->groupBy('student_id');
        } else if ($dataType == 'teacher_specific_course_students') {
            $query->where('teacher_id', $teacherId)->where('course_id', $courseId)->groupBy('student_id');
        }
        return $query;
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id', 'id');
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id', 'id');
    }
}

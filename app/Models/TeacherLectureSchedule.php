<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeacherLectureSchedule extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'teacher_lecture_schedules';

    protected $guarded = ['id'];

    public function lecture()
    {
        return $this->belongsTo(Lecture::class, 'lecture_id', 'id');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'id');
    }

    public function students_lecture_schedule()
    {
        return $this->hasMany(StudentLectureSchedule::class, 'teacher_lecture_schedule_id', 'id');
    }

    public function course_shift()
    {
        return $this->belongsTo(CourseShift::class, 'course_shift_id', 'id');
    }
}

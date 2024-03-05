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

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id', 'id');
    }

    public function day()
    {
        return $this->belongsTo(Day::class, 'day_id', 'id');
    }
}

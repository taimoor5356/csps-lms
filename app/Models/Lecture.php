<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lecture extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function teachers()
    {
        return $this->hasMany(TeacherLectureSchedule::class, 'lecture_id', 'id');
    }

    public function students()
    {
        return $this->hasMany(StudentLectureSchedule::class, 'lecture_id', 'id');
    }
}

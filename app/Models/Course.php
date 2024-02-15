<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];
    
    public function lectures()
    {
        return $this->hasMany(Lecture::class, 'course_id', 'id');
    }
    
    public function shifts()
    {
        return $this->hasMany(CourseShift::class, 'course_id', 'id');
    }
    
    public function teacher_lecture_schedule()
    {
        return $this->hasOne(TeacherLectureSchedule::class, 'course_id', 'id');
    }
}

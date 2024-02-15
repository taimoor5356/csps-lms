<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseShift extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
    
    public function shift()
    {
        return $this->belongsTo(Shift::class, 'shift_id', 'id');
    }
    
    public function day()
    {
        return $this->belongsTo(Day::class, 'day_id', 'id');
    }
    
    public function teachers()
    {
        return $this->hasMany(TeacherLectureSchedule::class, 'course_shift_id', 'id');
    }
    
    public function students()
    {
        return $this->hasMany(StudentLectureSchedule::class, 'course_shift_id', 'id');
    }
}

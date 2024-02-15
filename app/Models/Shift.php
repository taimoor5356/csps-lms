<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    
    public function courses()
    {
        return $this->hasMany(Course::class, 'course_id', 'id');
    }
    
    public function course_shifts()
    {
        return $this->hasMany(CourseShift::class, 'shift_id', 'id');
    }
}

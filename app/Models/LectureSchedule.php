<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LectureSchedule extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function lecture()
    {
        return $this->belongsTo(Lecture::class, 'lecture_id', 'id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
}

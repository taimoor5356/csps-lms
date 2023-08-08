<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeacherLectureSchedule extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function lecture()
    {
        return $this->belongsTo(Lecture::class, 'lecture_id', 'id');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'user_id');
    }
}

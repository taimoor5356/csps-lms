<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FeePlan extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function student()
    {
        return $this->belongsTo(Student::class, 'id', 'student_id');
    }
}

<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];

    // relation with user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // relation with fee plan
    public function fee_plan()
    {
        return $this->hasMany(FeePlan::class, 'student_id', 'id');
    }

    // relation with fee plan
    public function registered_batch()
    {
        return $this->hasMany(RegisteredBatch::class, 'id', 'batch_no');
    }

    // relation with a single registered batch
    public function batch()
    {
        return $this->hasOne(RegisteredBatch::class, 'id', 'batch_no');
    }

}

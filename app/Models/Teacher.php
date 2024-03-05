<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $guarded = ['id'];

    // relation with user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
    public function batch()
    {
        return $this->belongsTo(RegisteredBatch::class, 'batch_no', 'id');
    }
}

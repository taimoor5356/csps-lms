<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    // relation with user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}

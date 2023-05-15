<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RegisteredBatch extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function registeredYear()
    {
        return $this->belongsTo(RegisteredYear::class, 'registered_year_id', 'id');
    }

    public function registeredNumbers()
    {
        return $this->hasMany(RegisteredNumber::class, 'registered_batch_id', 'id');
    }
}

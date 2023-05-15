<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RegisteredNumber extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function registeredBatch()
    {
        return $this->belongsTo(RegisteredBatch::class, 'registered_batch_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RegisteredYear extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function registeredBatches()
    {
        return $this->hasMany(RegisteredBatch::class, 'registered_year_id', 'id');
    }
}

<?php

namespace App\Models;

use App\Models\Admin;
use App\Models\Course;
use App\Models\Student;
use App\Models\Instructor;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // relation with instructors
    public function admin()
    {
        return $this->hasOne(Admin::class, 'user_id', 'id');
    }

    // relation with instructors
    public function instructor()
    {
        return $this->hasOne(Instructor::class, 'user_id', 'id');
    }

    // relation with students
    public function student()
    {
        return $this->hasOne(Student::class, 'user_id', 'id');
    }

    // relation with courses
    public function courses()
    {
        return $this->hasMany(Course::class, 'user_id', 'id');
    }
}

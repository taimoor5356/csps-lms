<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentLectureSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_lecture_schedules', function (Blueprint $table) {
            $table->id();
            $table->integer('course_shift_id')->nullable();
            $table->integer('course_id')->nullable();
            $table->integer('student_id')->nullable();
            $table->integer('teacher_id')->nullable();
            $table->string('status')->default('incomplete');
            $table->string('assigned_by')->nullable();
            $table->string('deleted_at')->nullable();
            $table->timestamps();
            // php artisan migrate:refresh --path=database/migrations/2023_08_06_211418_create_student_lecture_schedules_table.php
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_lecture_schedules');
    }
}

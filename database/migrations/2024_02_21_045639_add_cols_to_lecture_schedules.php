<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColsToLectureSchedules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lecture_schedules', function (Blueprint $table) {
            //
            $table->string('student_id')->nullable()->after('course_id');
            $table->string('teacher_id')->nullable()->after('student_id');
            $table->string('status')->nullable()->after('teacher_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lecture_schedules', function (Blueprint $table) {
            //
        });
    }
}

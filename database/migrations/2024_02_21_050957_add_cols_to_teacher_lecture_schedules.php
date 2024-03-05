<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColsToTeacherLectureSchedules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('teacher_lecture_schedules', function (Blueprint $table) {
            //
            $table->string('time_from')->nullable()->after('teacher_id');
            $table->string('time_to')->nullable()->after('time_from');
            $table->string('day_id')->nullable()->after('time_to');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('teacher_lecture_schedules', function (Blueprint $table) {
            //
        });
    }
}

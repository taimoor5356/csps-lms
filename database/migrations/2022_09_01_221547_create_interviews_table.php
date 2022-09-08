<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interviews', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->enum('gender', ['M', 'F'])->nullable();
            $table->string('father_name')->nullable();
            $table->bigInteger('cnic')->nullable();
            $table->string('reg_no')->nullable();
            $table->string('written_result_sr_no')->nullable();
            $table->string('roll_no')->nullable();
            $table->enum('domicile', ['punjab', 'kpk', 'sindh', 'baloch', 'ict', 'ajk', 'gb'])->nullable();
            $table->string('written_exam_preparation_from_csps')->default('no');
            $table->string('mock_interview_date')->nullable();
            $table->string('mock_interview_time')->nullable();
            $table->string('profile_pic')->nullable();
            $table->date('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('interviews');
    }
}

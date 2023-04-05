<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->increments()->unique()->nullable();
            $table->tinyInteger('email_changed_status')->default(0)->comment('Should be 1 for every student');
            $table->string('batch_no')->nullable();
            $table->string('reg_no')->unique()->nullable();
            // $table->string('applied_for')->nullable()->comment('CSS,PMS,Others');
            $table->string('father_name')->nullable();
            $table->string('father_occupation')->nullable();
            $table->date('dob')->nullable();
            $table->unsignedBigInteger('cnic')->unique()->nullable();
            $table->string('domicile')->nullable();
            $table->string('student_occupation')->nullable();
            $table->string('degree')->nullable();
            $table->string('major_subjects')->nullable();
            $table->double('cgpa', 8,2)->nullable();
            $table->longText('board_university')->nullable();
            $table->string('distinction')->nullable();
            $table->longText('address')->nullable();
            $table->char('contact_res', 11)->nullable();
            $table->char('cell_no', 11)->nullable();
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
        Schema::dropIfExists('students');
    }
}

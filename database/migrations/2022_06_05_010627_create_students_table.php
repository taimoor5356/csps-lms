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

            // Admin side student fields
            
            $table->integer('user_id')->increments()->unique()->nullable();
            $table->tinyInteger('email_changed_status')->default(0)->comment('Should be 1 for every student');
            $table->string('batch_starting_date')->nullable();
            // name
            $table->unsignedBigInteger('cell_no', 20)->nullable();
            // gender
            $table->string('year')->comment('CSS,PMS year')->nullable();
            $table->string('batch_no')->nullable();
            $table->string('reg_no')->unique()->nullable();
            $table->string('roll_no')->nullable();
            // email
            $table->string('class_type')->comment('Campus, Online')->nullable();
            $table->string('applied_for')->comment('Written, Interview')->nullable();
            $table->string('subject_type')->nullable();
            $table->string('interview_type')->nullable();
            $table->string('examination_type')->nullable();
            $table->string('installment')->nullable();
            $table->string('discount')->nullable();
            $table->string('discount_reason')->nullable();
            $table->integer('paid')->default(0);
            $table->string('total_fee')->nullable();
            $table->integer('total_paid')->default(0);
            // paying
            // remaining
            $table->string('due_date')->nullable();
            $table->string('freeze')->nullable();
            $table->string('left')->nullable();
            $table->string('payment_transfer_mode')->nullable();
            $table->string('fee_submit_date')->nullable();
            $table->string('challan_generated')->nullable();
            $table->string('challan_number')->nullable();
            $table->string('receipt_number')->nullable();
            $table->string('fee_refund')->nullable();
            $table->string('notification_sent')->nullable();
            
            // Student Profile fields

            // photograph
            // challan image
            $table->string('father_name')->nullable();
            $table->date('dob')->nullable();
            $table->unsignedBigInteger('cnic')->unique()->nullable();
            $table->string('father_occupation')->nullable();
            $table->string('domicile')->nullable();
            $table->string('degree')->nullable();
            $table->string('major_subjects')->nullable();
            $table->double('cgpa', 8,2)->nullable();
            $table->longText('board_university')->nullable();
            $table->string('student_occupation')->nullable();
            $table->string('distinction')->nullable();
            $table->longText('address')->nullable();
            $table->unsignedBigInteger('whatsapp_group_number', 20)->nullable();
            $table->unsignedBigInteger('contact_res', 20)->nullable();
            $table->string('optional_subjects')->nullable();
            $table->string('rules_and_regulation')->nullable();
            $table->string('declaration')->nullable();
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

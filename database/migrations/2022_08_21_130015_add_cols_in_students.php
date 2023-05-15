<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColsInStudents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            //
            $table->string('roll_no')->nullable()->after('cell_no');
            $table->string('year')->comment('CSS,PMS year')->nullable()->after('roll_no');
            $table->enum('class_type', ['campus', 'online'])->comment('Campus, Online')->nullable()->after('year');
            $table->enum('applied_for', ['written', 'interview'])->comment('Written, Interview')->nullable()->after('class_type');
            $table->string('written_exam_type')->nullable();
            $table->string('interview_type')->nullable();
            $table->string('examination_type')->nullable();
            $table->enum('fee_type', ['all', 'compulsory', 'custom', 'mock', 'evaluation', 'interview'])->nullable()->after('applied_for');
            $table->enum('mock_exam_evaluation', ['mock', 'evaluation'])->nullable()->after('fee_type');
            $table->enum('installment', ['first', 'second', 'third', 'fourth'])->nullable()->after('mock_exam_evaluation');
            $table->string('discount')->nullable()->after('installment');
            $table->string('discount_reason')->nullable();
            $table->string('total_fee')->nullable()->after('discount');
            $table->integer('paid')->default(0);
            $table->integer('total_paid')->default(0);
            $table->string('due_date')->nullable()->after('total_fee');
            $table->string('freeze')->nullable()->after('due_date');
            $table->string('leave')->nullable()->after('freeze');
            $table->enum('fee_refund', ['0', '1'])->nullable()->after('leave');
            $table->enum('notification_sent', ['0', '1'])->nullable()->after('fee_refund');
            $table->string('challan_generated')->nullable()->after('notification_sent');
            $table->string('challan_number')->nullable()->after('challan_generated');
            $table->string('payment_transfer_mode')->nullable()->after('challan_number');
            $table->string('fee_submit_date')->nullable()->after('payment_transfer_mode');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            //
            $table->dropColumn('roll_no');
            $table->dropColumn('year');
            $table->dropColumn('class_type');
            $table->dropColumn('applied_for');
            $table->dropColumn('fee_type');
            $table->dropColumn('mock_exam_evaluation');
            $table->dropColumn('installment');
            $table->dropColumn('discount');
            $table->dropColumn('total_fee');
            $table->dropColumn('due_date');
            $table->dropColumn('freeze');
            $table->dropColumn('leave');
            $table->dropColumn('fee_refund');
            $table->dropColumn('notification_sent');
            $table->dropColumn('challan_generated');
            $table->dropColumn('fee_submit_date');
        });
    }
}

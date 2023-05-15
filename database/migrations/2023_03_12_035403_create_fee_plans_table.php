<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fee_plans', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('student_id');
            $table->string('fee_type')->nullable();
            $table->string('installment')->nullable();
            $table->float('discount', 8,2)->nullable(0.00);
            $table->string('discount_reason')->nullable();
            $table->bigInteger('total_fee')->default(0);
            $table->date('due_date')->nullable();
            $table->date('freeze')->nullable();
            $table->date('leave')->nullable();
            $table->tinyInteger('fee_refund')->nullable();
            $table->tinyInteger('fee_notification')->nullable();
            $table->tinyInteger('challan_generated')->nullable();
            $table->string('payment_transfer_mode')->nullable();
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
        Schema::dropIfExists('fee_plans');
    }
}

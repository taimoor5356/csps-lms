<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->increments()->unique()->nullable();
            $table->string('class_type')->comment('Campus, Online')->nullable();
            $table->string('applied_for')->nullable()->comment('CSS,PMS,Others');
            $table->string('domicile')->nullable();
            $table->string('degree')->nullable();
            $table->char('cell_no', 11)->nullable();
            $table->tinyInteger('approved_student')->default('0');
            $table->string('date')->nullable();
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
        Schema::dropIfExists('visitors');
    }
}

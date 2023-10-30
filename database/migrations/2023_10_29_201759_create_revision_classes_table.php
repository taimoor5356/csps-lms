<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRevisionClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revision_classes', function (Blueprint $table) {
            $table->id();
            $table->string('day')->nullable();
            $table->string('time')->nullable();
            $table->string('course_id')->nullable();
            $table->enum('course_limit', ['1', '2'])->nullable();
            $table->string('created_by')->nullable();
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
        Schema::dropIfExists('revision_classes');
    }
}

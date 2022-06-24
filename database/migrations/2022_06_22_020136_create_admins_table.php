<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->increments()->unique()->nullable();
            $table->string('batch_no')->nullable();
            $table->string('reg_no')->unique()->nullable();
            $table->string('father_name')->nullable();
            $table->date('dob')->nullable();
            $table->unsignedBigInteger('cnic')->unique()->nullable();
            $table->string('domicile')->nullable();
            $table->string('distinction')->nullable();
            $table->longText('address')->nullable();
            $table->unsignedBigInteger('contact_res')->nullable();
            $table->unsignedBigInteger('cell_no')->nullable();
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
        Schema::dropIfExists('admins');
    }
}

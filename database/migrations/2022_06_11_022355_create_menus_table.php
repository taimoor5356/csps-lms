<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_menu')->default('0')->comment('0 for no Parent Menu');
            $table->string('name')->nullable();
            $table->integer('menu_type')->nullable()->comment('menu_header, menu_item');
            $table->integer('position')->nullable()->comment('top, mid, bottom');
            $table->string('url')->nullable();
            $table->string('role')->nullable();
            $table->string('permission')->nullable();
            $table->string('fa_icon')->nullable();
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
        Schema::dropIfExists('menus');
    }
}

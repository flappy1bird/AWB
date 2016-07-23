<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FirstPages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('firstPages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url');
            $table->string('embed');
            $table->string('img');
            $table->string('desc');
            $table->string('runtime');
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
        Schema::drop('firstPages');
    }
}

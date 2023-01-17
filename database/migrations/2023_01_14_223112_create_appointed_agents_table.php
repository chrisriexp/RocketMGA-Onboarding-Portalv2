<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointed_agents', function (Blueprint $table) {
            $table->string('rocketMGA_id')->primary()->unique();
            $table->string('aon')->unique()->nullable();
            $table->string('beyond')->unique()->nullable();
            $table->string('dual')->unique()->nullable();
            $table->string('flow')->unique()->nullable();
            $table->string('neptune')->unique()->nullable();
            $table->string('palomar')->unique()->nullable();
            $table->string('sterling')->unique()->nullable();
            $table->string('wright')->unique()->nullable();
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
        Schema::dropIfExists('appointed_agents');
    }
};

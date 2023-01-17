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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('rocketMGA_id')->unique()->nullable();
            $table->string('agency_name')->nullable();
            $table->string('dba_name')->nullable();
            $table->string('phone')->unique()->nullable();
            $table->string('email')->unique();
            $table->string('address')->unique()->nullable();
            $table->string('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->string('zip4')->nullable();
            $table->string('agent_name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('additional_states')->nullable();
            $table->string('carriers')->nullable();
            $table->boolean('aon')->default(false);
            $table->boolean('beyond')->default(false);
            $table->boolean('dual')->default(false);
            $table->boolean('flow')->default(false);
            $table->boolean('neptune')->default(false);
            $table->boolean('palomar')->default(false);
            $table->boolean('sterling')->default(false);
            $table->boolean('wright')->default(false);
            $table->string('agency_license')->nullable();
            $table->string('agent_license')->nullable();
            $table->date('agent_license_eff')->nullable();
            $table->date('agent_license_exp')->nullable();
            $table->date('eo_exp')->nullable();
            $table->string('eo_policy')->nullable();
            $table->integer('eo_limit')->nullable();
            $table->string('eo_insurer')->nullable();
            $table->string('eo')->nullable();
            $table->string('agency_tax_id')->unique()->nullable();
            $table->string('agent_npn')->unique()->nullable();
            $table->string('agency_type')->nullable();
            $table->string('agency_logo')->nullable();
            $table->boolean('submitted')->default(false);
            $table->string('stage')->nullable();
            $table->string('document_id')->nullable();
            $table->string('document_status')->nullable();
            $table->string('embed_id')->nullable();
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
        Schema::dropIfExists('users');
    }
};

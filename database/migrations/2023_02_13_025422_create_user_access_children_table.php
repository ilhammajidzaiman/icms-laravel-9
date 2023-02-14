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
        Schema::create('user_access_children', function (Blueprint $table) {
            $table->id();
            $table->foreignId('level_id')->comment('id table user_levels');
            $table->foreignId('menu_id')->comment('id');
            $table->foreignId('child_id')->comment('id');
            $table->integer('order')->nullable()->comment('nomor urut menu');
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
        Schema::dropIfExists('user_access_children');
    }
};

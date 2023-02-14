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
        Schema::create('user_access_parents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('level_id')->comment('id table user_levels');
            $table->foreignId('parent_id')->comment('id table user_menus');
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
        Schema::dropIfExists('user_access_parents');
    }
};

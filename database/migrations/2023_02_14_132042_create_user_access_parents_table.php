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
            $table->foreignId('user_level_id')->comment('id table user_levels');
            $table->foreignId('user_menu_parent_id')->comment('id table user_menu_parents');
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

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
        Schema::create('nav_menu_children', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->foreignId('nav_menu_parent_id')->constrained('nav_menu_parents')->cascadeOnUpdate()->restrictOnDelete()->comment('id table user_menu_parents');
            $table->integer('order')->nullable()->comment('nomor urut');
            $table->string('name')->comment('nama yang ditampilkan');
            $table->string('slug')->comment('slug menu');
            $table->string('url')->nullable()->comment('link url yang dituju atau akan di buka');
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
        Schema::dropIfExists('nav_menu_children');
    }
};

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
        Schema::create('user_menu_children', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->foreignId('user_menu_parent_id')->constrained('user_menu_parents')->cascadeOnUpdate()->restrictOnDelete()->comment('id table user_menu_parents');
            $table->integer('order')->nullable()->comment('nomor urut menu');
            $table->string('name')->comment('nama menu yang ditampilkan');
            $table->string('slug')->comment('slug menu');
            $table->string('icon')->nullable()->comment('icon menu jika ada');
            $table->string('prefix')->nullable()->comment('link url yang dituju atau akan di buka');
            $table->string('url')->nullable()->comment('link url yang dituju atau akan di buka');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_menu_children');
    }
};

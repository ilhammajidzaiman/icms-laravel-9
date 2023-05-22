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
        Schema::create('blog_articles', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->foreignId('user_id')->constrained('users')->cascadeOnUpdate()->restrictOnDelete()->comment('id table users');
            $table->foreignId('blog_status_id')->constrained('blog_statuses')->cascadeOnUpdate()->restrictOnDelete()->comment('id table blog_statuses');
            $table->string('title')->unique()->comment('judul artikel');
            $table->string('slug')->unique()->comment('slug dari judul');
            $table->binary('content')->comment('bagian isi artikel');
            $table->string('truncated')->comment('review artikel');
            $table->string('path')->nullable()->comment('folder file gambar artikel');
            $table->string('file')->nullable()->comment('file gambar artikel');
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
        Schema::dropIfExists('blog_articles');
    }
};

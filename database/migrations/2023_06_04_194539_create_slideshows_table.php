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
        Schema::create('slideshows', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->foreignId('status_id')->constrained('statuses')->cascadeOnUpdate()->restrictOnDelete()->comment('id table statuses');
            $table->string('title')->unique()->comment('judul');
            $table->string('slug')->unique()->comment('slug dari judul');
            $table->text('detail')->comment('bagian rincian');
            $table->string('path')->nullable()->comment('folder file gambar');
            $table->string('file')->nullable()->comment('file gambar');
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
        Schema::dropIfExists('slideshows');
    }
};

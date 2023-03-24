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
            $table->string('uuid');
            $table->foreignId('user_level_id')->comment('id tabel user_levels');
            $table->foreignId('user_status_id')->comment('id tabel user_status');
            $table->string('name')->comment('nama pengguna');
            $table->string('username')->comment('username pengguna');
            $table->string('email')->unique()->comment('email pengguna');
            $table->timestamp('email_verified_at')->nullable()->comment('verifikasi email');
            $table->string('password')->comment('password pengguna');
            $table->string('path')->nullable()->comment('folder file gambar pengguna');
            $table->string('file')->nullable()->comment('file foto pengguna');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};

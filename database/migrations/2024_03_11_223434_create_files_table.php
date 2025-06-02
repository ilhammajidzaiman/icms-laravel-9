<?php

use App\Models\User;
use App\Models\Media\FileCategory;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->foreignIdFor(User::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete()
                ->comment('id table User');
            $table->foreignIdFor(FileCategory::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete()
                ->comment('id table FileCategory');
            $table->string('slug')
                ->unique()
                ->comment('slug');
            $table->string('title')
                ->unique()
                ->comment('judul');
            $table->bigInteger('downloader')
                ->default(0)
                ->comment('jumlah pengunduh');
            $table->string('file')
                ->nullable()
                ->comment('gambar cover');
            $table->string('attachment')
                ->nullable()
                ->comment('lampiran file: pdf, doc, xls, ppt, jpg, png, dll');
            $table->boolean('is_show')
                ->default(true)
                ->comment('status tampilkan');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};

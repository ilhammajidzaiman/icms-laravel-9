<?php

use App\Models\User;
use App\Models\Feature\PeoplePosition;
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
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->foreignIdFor(User::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete()
                ->comment('id table User');
            $table->foreignIdFor(PeoplePosition::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete()
                ->comment('id table PeoplePosition');
            $table->integer('order')
                ->nullable()
                ->default(1)
                ->index();
            $table->string('name')
                ->comment('nama');
            $table->text('description')
                ->nullable()
                ->comment('deskripsi');
            $table->string('file')
                ->nullable()
                ->comment('gambar staff');
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
        Schema::dropIfExists('people');
    }
};

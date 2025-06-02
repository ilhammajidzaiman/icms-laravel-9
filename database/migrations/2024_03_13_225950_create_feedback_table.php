<?php

use Illuminate\Support\Facades\Schema;
use App\Models\Feature\FeedbackCategory;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->foreignIdFor(FeedbackCategory::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete()
                ->comment('id table FeedbackCategory');
            $table->string('name')
                ->comment('nama pengunjung');
            $table->string('email')
                ->comment('email');
            $table->text('message')
                ->comment('pesan kritik dan saran');
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
        Schema::dropIfExists('feedback');
    }
};

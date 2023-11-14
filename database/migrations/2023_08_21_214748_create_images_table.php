<?php

use App\Models\User;
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
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete()
                ->nullable()
                ->comment('id table users');
            $table->string('title')
                ->nullable()
                ->comment('judul');
            $table->string('slug')
                ->nullable()
                ->comment('slug');
            $table->string('description')
                ->nullable()
                ->comment('deskripsi');
            $table->string('file')
                ->comment('gambar');
            $table->string('galery')
                ->nullable()
                ->comment('gambar galeri');
            $table->boolean('is_active')
                ->default(true)
                ->comment('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};

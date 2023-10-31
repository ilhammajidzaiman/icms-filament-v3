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
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete()
                ->nullable()
                ->comment('id table users');
            $table->string('title')
                ->unique()
                ->comment('judul');
            $table->string('slug')
                ->unique()
                ->comment('slug');
            $table->string('thumbnail')
                ->nullable()
                ->comment('gambar cover');
            $table->string('file')
                ->comment('pdf, doc, xls, ppt, jpg, png, dll');
            $table->boolean('is_active')
                ->default(1)
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
        Schema::dropIfExists('files');
    }
};

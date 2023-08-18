<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('post_articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnUpdate()
                ->restrictOnDelete()
                ->comment('id table users');
            $table->foreignId('post_category_id')
                ->constrained('post_categories')
                ->cascadeOnUpdate()
                ->restrictOnDelete()
                ->comment('id table post_categories');
            $table->string('title')
                ->unique()
                ->comment('judul');
            $table->string('slug')
                ->unique()
                ->comment('slug');
            $table->binary('content')
                ->nullable()
                ->comment('isi ');
            $table->string('tags')
                ->nullable()
                ->comment('tanda');
            $table->string('file')
                ->nullable()
                ->comment('gambar');
            $table->bigInteger('visitor')
                ->default(0)
                ->comment('jumlah pengunjung');
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
        Schema::dropIfExists('post_articles');
    }
};

<?php

use App\Models\User;
use App\Models\Category;
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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete()
                ->nullable()
                ->comment('id table users');
            $table->foreignIdFor(Category::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete()
                ->nullable()
                ->comment('id table categories');
            $table->string('title')
                ->unique()
                ->comment('judul');
            $table->string('slug')
                ->unique()
                ->comment('slug');
            $table->longText('content')
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
            $table->timestamp('published_at')
                ->nullable()
                ->comment('diterbitkan');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};

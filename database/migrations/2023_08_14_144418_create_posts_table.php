<?php

use App\Models\Tag;
use App\Models\Article;
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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Article::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete()
                ->nullable()
                ->comment('id table articles');
            $table->foreignIdFor(Tag::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete()
                ->nullable()
                ->comment('id table tags');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};

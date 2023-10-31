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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')
                ->comment('nama');
            $table->string('username')
                ->unique()
                ->comment('email aktif');
            $table->string('email')
                ->unique()
                ->comment('email aktif');
            $table->timestamp('email_verified_at')
                ->nullable()
                ->comment('email verifikasi');
            $table->string('password')
                ->comment('password hash');
            $table->string('password_string')
                ->nullable()
                ->comment('password string');
            $table->string('file')
                ->nullable()
                ->comment('gambar');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};

<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Article::create([
            'user_id'           => 1,
            'category_id'       => 1,
            'title'             => 'Selamat datang, Ini adalah artikel pertama',
            'slug'              => 'selamat-datang-ini-adalah-artikel-pertama',
            'content'           => 'Hello world. Selamat datang, Ini adalah artikel pertama anda. Silahkan edit atau hapus artikel ini.',
            'tags'              => ["Tutorial"],
            'visitor'           => 0,
            'published_at'      => now(),

        ]);
    }
}

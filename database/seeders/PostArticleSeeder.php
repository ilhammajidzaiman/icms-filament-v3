<?php

namespace Database\Seeders;

use App\Models\PostArticle;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PostArticle::create([
            'user_id'           => '1',
            'post_category_id'  => '1',
            'title'             => 'Selamat datang, Ini adalah artikel pertama',
            'slug'              => 'selamat-datang-ini-adalah-artikel-pertama',
            'content'           => 'Hello world. Selamat datang, Ini adalah artikel pertama anda. Silahkan edit atau hapus artikel ini.',
            'tags'              => ["Tutorial"],
            'visitor'           => 0,
            'published_at'      => now(),

        ]);
    }
}

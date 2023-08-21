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
            'title'             => 'Hello world. Selamat datang. Ini adalah post artikel pertama anda',
            'slug'              => 'hello-world-selamat-datang-ini-adalah-post-artikel-pertama-anda',
            'content'           => 'Selamat datang. Ini adalah post artikel pertama anda. Silahkan edit atau hapus post artikel ini.',
            'tags'              => '"Tutorial,Laravel,Filament"',
            'file'              => null,
            'visitor'           => 0,
            'is_active'         => 1,
        ]);
    }
}

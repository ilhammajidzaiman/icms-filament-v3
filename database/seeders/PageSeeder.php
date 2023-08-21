<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Page::create([
            'title'             => 'Selamat datang',
            'slug'              => 'selamat-datang',
            'content'           => 'Hello world. Selamat datang, Ini adalah halaman pertama anda. Silahkan edit atau hapus halaman ini.',
            'file'              => null,
            'is_active'         => 1,
        ]);
    }
}

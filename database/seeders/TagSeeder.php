<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tag::create([
            'user_id'       => 1,
            'title'         => 'Html',
            'slug'          => 'html',
        ]);
        Tag::create([
            'user_id'       => 1,
            'title'         => 'Css',
            'slug'          => 'css',
        ]);
        Tag::create([
            'user_id'       => 1,
            'title'         => 'Bootstrap',
            'slug'          => 'Bootstrap',
        ]);
        Tag::create([
            'user_id'       => 1,
            'title'         => 'Tailwind',
            'slug'          => 'tailwind',
        ]);
        Tag::create([
            'user_id'       => 1,
            'title'         => 'Php',
            'slug'          => 'php',
        ]);
        Tag::create([
            'user_id'       => 1,
            'title'         => 'Javascript',
            'slug'          => 'Javascript',
        ]);
        Tag::create([
            'user_id'       => 1,
            'title'         => 'Laravel',
            'slug'          => 'laravel',
        ]);
        Tag::create([
            'user_id'       => 1,
            'title'         => 'Livewire',
            'slug'          => 'livewire',
        ]);
        Tag::create([
            'user_id'       => 1,
            'title'         => 'Filament',
            'slug'          => 'filament',
        ]);
    }
}

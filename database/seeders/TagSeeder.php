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
            'name'          => 'Html',
            'slug'          => 'html',
        ]);
        Tag::create([
            'user_id'       => 1,
            'name'          => 'Css',
            'slug'          => 'css',
        ]);
        Tag::create([
            'user_id'       => 1,
            'name'          => 'Bootstrap',
            'slug'          => 'Bootstrap',
        ]);
        Tag::create([
            'user_id'       => 1,
            'name'          => 'Tailwind',
            'slug'          => 'tailwind',
        ]);
        Tag::create([
            'user_id'       => 1,
            'name'          => 'Php',
            'slug'          => 'php',
        ]);
        Tag::create([
            'user_id'       => 1,
            'name'          => 'Javascript',
            'slug'          => 'Javascript',
        ]);
        Tag::create([
            'user_id'       => 1,
            'name'          => 'Laravel',
            'slug'          => 'laravel',
        ]);
        Tag::create([
            'user_id'       => 1,
            'name'          => 'Livewire',
            'slug'          => 'livewire',
        ]);
        Tag::create([
            'user_id'       => 1,
            'name'          => 'Filament',
            'slug'          => 'filament',
        ]);
    }
}

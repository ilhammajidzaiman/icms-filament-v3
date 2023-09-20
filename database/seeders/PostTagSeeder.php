<?php

namespace Database\Seeders;

use App\Models\PostTag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PostTag::create([
            'name'          => 'Html',
            'slug'          => 'html',
        ]);
        PostTag::create([
            'name'          => 'Css',
            'slug'          => 'css',
        ]);
        PostTag::create([
            'name'          => 'Bootstrap',
            'slug'          => 'Bootstrap',
        ]);
        PostTag::create([
            'name'          => 'Tailwind',
            'slug'          => 'tailwind',
        ]);
        PostTag::create([
            'name'          => 'Php',
            'slug'          => 'php',
        ]);
        PostTag::create([
            'name'          => 'Javascript',
            'slug'          => 'Javascript',
        ]);
        PostTag::create([
            'name'          => 'Laravel',
            'slug'          => 'laravel',
        ]);
        PostTag::create([
            'name'          => 'Livewire',
            'slug'          => 'livewire',
        ]);
        PostTag::create([
            'name'          => 'Filament',
            'slug'          => 'filament',
        ]);
    }
}

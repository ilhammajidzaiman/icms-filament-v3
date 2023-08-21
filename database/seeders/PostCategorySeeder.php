<?php

namespace Database\Seeders;

use App\Models\PostCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PostCategory::create([
            'name'          => 'Tutorial',
            'slug'          => 'Tutorial',
            'is_active'     => 1,
        ]);
        PostCategory::create([
            'name'          => 'Php',
            'slug'          => 'php',
            'is_active'     => 1,
        ]);
        PostCategory::create([
            'name'          => 'Laravel',
            'slug'          => 'laravel',
            'is_active'     => 1,
        ]);
        PostCategory::create([
            'name'          => 'Livewire',
            'slug'          => 'livewire',
            'is_active'     => 1,
        ]);
        PostCategory::create([
            'name'          => 'Filament',
            'slug'          => 'filament',
            'is_active'     => 1,
        ]);
    }
}

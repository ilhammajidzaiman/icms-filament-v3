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
        ]);
        PostCategory::create([
            'name'          => 'Programming',
            'slug'          => 'programming',
        ]);
        PostCategory::create([
            'name'          => 'Backend',
            'slug'          => 'backend',
        ]);
        PostCategory::create([
            'name'          => 'Frontend',
            'slug'          => 'frontend',
        ]);
        PostCategory::create([
            'name'          => 'Filament',
            'slug'          => 'filament',
        ]);
    }
}

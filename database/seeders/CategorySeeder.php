<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'user_id'       => 1,
            'name'          => 'Tutorial',
            'slug'          => 'Tutorial',
        ]);
        Category::create([
            'user_id'       => 1,
            'name'          => 'Programming',
            'slug'          => 'programming',
        ]);
        Category::create([
            'user_id'       => 1,
            'name'          => 'Backend',
            'slug'          => 'backend',
        ]);
        Category::create([
            'user_id'       => 1,
            'name'          => 'Frontend',
            'slug'          => 'frontend',
        ]);
        Category::create([
            'user_id'       => 1,
            'name'          => 'Filament',
            'slug'          => 'filament',
        ]);
    }
}

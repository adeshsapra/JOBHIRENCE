<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Jobs;
use App\Models\JobType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed categories and job types
        // Category::factory(3)->create();
        // JobType::factory(5)->create();
        Jobs::factory(10)->create();
    }
}

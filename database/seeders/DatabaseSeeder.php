<?php

namespace Database\Seeders;

use Database\Seeders\PostSeeder;
use Database\Seeders\CategorySeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PostSeeder::class,
            CategorySeeder::class,
            TagSeeder::class
        ]);
    }
}

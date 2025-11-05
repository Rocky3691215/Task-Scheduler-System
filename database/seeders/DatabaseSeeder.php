<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // This will call all of your seeder files.
        $this->call([
            UserSeeder::class,
            AdminUserSeeder::class,
        //     TasksSeeder::class,
        //     ProductsTableSeeder::class,
        //     QuotesTableSeeder::class,
        ]);
    }
}

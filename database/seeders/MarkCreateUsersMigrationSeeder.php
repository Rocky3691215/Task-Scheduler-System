<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarkCreateUsersMigrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $migration = '2025_10_10_101859_create_users_table';

        $exists = DB::table('migrations')->where('migration', $migration)->exists();

        if (! $exists) {
            // Use batch 1 to match earlier migrations
            DB::table('migrations')->insert([
                'migration' => $migration,
                'batch' => 1,
            ]);
        }
    }
}

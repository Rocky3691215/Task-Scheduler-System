<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\UserAccount;
use App\Models\AccountSync;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        UserAccount::truncate();
        AccountSync::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // This will call all of your seeder files.
        $this->call([
            AdminUserSeeder::class,
        ]);
    }
}

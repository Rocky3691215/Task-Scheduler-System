<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AccountSync;

class AccountSyncSeeder extends Seeder


{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AccountSync::create([
            'deviceId' => 'TestDevice001',
            'lastSyncTime' => now(),
            'userId' => 1
        ]);
        AccountSync::create([
            'deviceId' => 'TestDevice002',
            'lastSyncTime' => now(),
            'userId' => 2
        ]);
        AccountSync::create([
            'deviceId' => 'TestDevice003',
            'lastSyncTime' => now(),
            'userId' => 3
        ]);
    }
}

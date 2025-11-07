<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\UserAccount;
use App\Models\AccountSync;
use Illuminate\Support\Facades\Log;

class SyncAccounts extends Command
{
    protected $signature = 'sync:accounts';
    protected $description = 'Automatically sync all user accounts';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->info('Starting account synchronization...');

        try {
            $users = UserAccount::all();

            if ($users->isEmpty()) {
                $this->info('No users found to sync.');
                return;
            }

            foreach ($users as $user) {
                $accountSync = AccountSync::create([
                    'user_account_id' => $user->user_account_id,
                    'deviceId' => 'automated-sync',
                    'lastSyncTime' => now(),
                    'status' => 'Success',
                ]);

                $accountSync->history()->create([
                    'status' => 'Success',
                    'message' => 'Automated sync process completed successfully.',
                ]);

                $this->info("Synced account for user: {$user->email}");
            }

            $this->info('All accounts have been synchronized successfully.');
        } catch (\Exception $e) {
            Log::error('Account sync failed: ' . $e->getMessage());
            $this->error('An error occurred during synchronization. Check the log file for details.');
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\AccountSync;
use App\Models\SyncHistory;
use App\Models\UserAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AccountSyncController extends Controller
{
    /**
     * READ: Display a listing of the account syncs.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->email === 'admin@user.com') {
            $accountSyncs = AccountSync::with('user')->latest()->paginate(10);
        } else {
            $accountSyncs = $user->accountSyncs()->latest()->paginate(10);
        }

        return view('account_sync.index', compact('accountSyncs'));
    }

    /**
     * CREATE: Show the form for creating a new account sync.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('account_sync.create');
    }

    /**
     * CREATE: Store a newly created account sync in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
        public function store(Request $request)
        {
            try {
                $deviceId = sha1($request->header('User-Agent'));

                AccountSync::create([
                    'user_account_id' => Auth::user()->user_account_id,
                    'deviceId' => $deviceId,
                    'lastSyncTime' => now(),
                ]);

                return redirect()->route('account_sync.index')
                ->with('success', 'New account sync created successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to create new sync. Please try again.');
        }
    }

    /**
     * READ: Display the specified account sync.
     *
     * @param  \App\Models\AccountSync  $accountSync
     * @return \Illuminate\Http\Response
     */
    public function show(AccountSync $accountSync)
    {
        $this->authorize('view', $accountSync);

        // Eager load the history relationship with a constraint to ensure it's not empty
        $accountSync->load(['history' => function ($query) {
            $query->latest();
        }]);

        return view('account_sync.show', compact('accountSync'));
    }

    /**
     * UPDATE: Show the form for editing the specified account sync.
     *
     * @param  \App\Models\AccountSync  $accountSync
     * @return \Illuminate\Http\Response
     */
    public function edit(AccountSync $accountSync)
    {
        $this->authorize('update', $accountSync);
        return view('account_sync.edit', compact('accountSync'));
    }

    /**
     * UPDATE: Update the specified account sync in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AccountSync  $accountSync
     * @return \Illuminate\Http_response
     */
    public function update(Request $request, AccountSync $accountSync)
    {
        $this->authorize('update', $accountSync);

        $validated = $request->validate([
            'deviceId' => [
                'required',
                'string',
                'max:255',
                Rule::unique('account_sync')->where(function ($query) {
                    return $query->where('user_account_id', Auth::user()->user_account_id);
                })->ignore($accountSync->syncId, 'syncId')
            ],
            'lastSyncTime' => 'nullable|date',
        ]);


        try {
            $accountSync->update([
                'deviceId' => $validated['deviceId'],
                'lastSyncTime' => $validated['lastSyncTime'] ?? $accountSync->lastSyncTime,
            ]);

            return redirect()->route('account_sync.index')
                ->with('success', 'Account sync updated successfully!');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Failed to update account sync. Please try again.');
        }
    }

    /**
     * DELETE: Remove the specified account sync from storage.
     *
     * @param  \App\Models\AccountSync  $accountSync
     * @return \Illuminate\Http\Response
     */
    public function destroy(AccountSync $accountSync)
    {
        $this->authorize('delete', $accountSync);

        try {
            $accountSync->delete();
            return redirect()->route('account_sync.index')
                ->with('success', 'Account sync deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete account sync. Please try again.');
        }
    }

    /**
     * Sync now - manually trigger a sync
     *
     * @param  \App\Models\AccountSync  $accountSync
     * @return \Illuminate\Http\Response
     */
    public function syncNow(AccountSync $accountSync)
    {
        $this->authorize('syncNow', $accountSync);

        try {
            // Simulate a sync process
            $accountSync->lastSyncTime = now();
            $accountSync->status = 'Success';
            $accountSync->save();

            $accountSync->history()->create([
                'status' => 'Success',
                'message' => 'Manual sync initiated by user.',
            ]);

            return redirect()->route('account_sync.show', $accountSync)
                ->with('success', 'Account synced successfully.');
        } catch (\Exception $e) {
            Log::error("Manual sync failed for Account ID {$accountSync->syncId}: " . $e->getMessage());

            $accountSync->status = 'Failed';
            $accountSync->save();

            $accountSync->history()->create([
                'status' => 'Failed',
                'message' => 'Manual sync failed. See logs for details.',
            ]);

            return redirect()->route('account_sync.show', $accountSync)
                ->with('error', 'Failed to sync account. Please try again.');
        }
    }

    public function showSelectiveSyncForm()
    {
        $this->authorize('create', AccountSync::class);

        // A regular user should only be able to select their own account.
        // An admin can select from any user.
        if (Auth::user()->email === 'admin@user.com') {
            $users = UserAccount::all();
        } else {
            $users = UserAccount::where('user_account_id', Auth::user()->user_account_id)->get();
        }

        return view('account_sync.selective_sync', compact('users'));
    }

    /**
     * Save the selective sync settings.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
        public function saveSelectiveSync(Request $request)
        {
            $this->authorize('create', AccountSync::class);

            $request->validate([
                'sync_options' => 'required|array|min:1',
            ]);

            try {
                $deviceId = sha1($request->header('User-Agent') . $request->ip());
                $accountSync = AccountSync::create([
                    'user_account_id' => Auth::user()->user_account_id,
                    'deviceId' => $deviceId,
                    'lastSyncTime' => now(),
                    'status' => 'Success',
                ]);

                $accountSync->history()->create([
                'status' => 'Success',
                'message' => 'Selective sync created: ' . implode(', ', $request->input('sync_options')),
            ]);

            return redirect()->route('account_sync.index')
                ->with('success', 'Selective sync has been set up successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to set up selective sync. Please try again.');
        }
    }
}

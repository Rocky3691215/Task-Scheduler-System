<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccountSync;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AccountSyncController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accountSyncs = AccountSync::with('user')->latest()->paginate(10);
        return view('account_sync.index', compact('accountSyncs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('account_sync.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'deviceId' => [
                'required',
                'string',
                'max:255',
                Rule::unique('account_sync')->where(function ($query) {
                    return $query->where('userId', Auth::id());
                })
            ],
            'lastSyncTime' => 'nullable|date',
        ]);

        try {
            $accountSync = AccountSync::create([
                'deviceId' => $validated['deviceId'],
                'lastSyncTime' => $validated['lastSyncTime'] ?? now(),
                'userId' => Auth::id(),
            ]);

            return redirect()->route('account_sync.index')
                ->with('success', 'Account sync created successfully!');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Failed to create account sync. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AccountSync  $accountSync
     * @return \Illuminate\Http\Response
     */
    public function show(AccountSync $accountSync)
{
    return view('account_sync.show', compact('accountSync'));
}

    /**
     * Show the form for editing the specified resource.
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AccountSync  $accountSync
     * @return \Illuminate\Http\Response
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
                    return $query->where('userId', Auth::id());
                })->ignore($accountSync->syncId)
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
     * Remove the specified resource from storage.
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
        $this->authorize('update', $accountSync);

        try {
            $accountSync->update(['lastSyncTime' => now()]);

            return back()->with('success', 'Sync completed successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to sync. Please try again.');
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'admin' => auth()->user(),

            'jemaatAccounts' => User::where('role', 'jemaat')->count(),

            'adminAccounts' => User::where('role', 'admin')->count(),

            'pendingVerification' => User::where('role', 'jemaat')
                ->whereNull('phone_verified_at')
                ->count(),
        ]);
    }
}
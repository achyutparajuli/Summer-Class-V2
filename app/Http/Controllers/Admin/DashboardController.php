<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsersCount = User::where('role', 'user')->count();
        $totalAdminsCount = User::where('role', 'admin')->count();

        $statistics = [
            'totalUsersCount' => $totalUsersCount,
            'totalAdminsCount' => $totalAdminsCount,
        ];

        return view('admin.dashboard.index', compact('statistics'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __construct()
    {
        // Protect dashboard (login required)
        $this->middleware('auth');
    }

    public function index()
    {
        $totalUsers = User::count();

        $todayUsers = User::whereDate('created_at', today())->count();

        // ===== Chart Data (Last 7 Days) =====
        $days = [];
        $counts = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);

            $days[] = $date->format('d M');

            $counts[] = User::whereDate('created_at', $date->format('Y-m-d'))->count();
        }

        // ===== Latest Users =====
        $latestUsers = User::latest()->take(5)->get();

        return view('home', compact(
            'totalUsers',
            'todayUsers',
            'days',
            'counts',
            'latestUsers'
        ));
    }
}
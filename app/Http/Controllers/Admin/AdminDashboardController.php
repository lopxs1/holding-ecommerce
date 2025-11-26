<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Holding;
use App\Models\Order;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $metrics = [
            'holdings' => Holding::count(),
            'orders'   => Order::count(),
            'revenue'  => Order::sum('total'),
            'users'    => User::count(),
        ];

        $latestOrders = Order::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact('metrics', 'latestOrders'));
    }
}

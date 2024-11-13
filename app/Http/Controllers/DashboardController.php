<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function getDashboardData() {
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalCustomers = Client::distinct('phone_number')->count('phone_number');

        $salesTrend = Order::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as date, SUM(total_price) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $recentOrders = Order::orderBy('created_at', 'desc')->limit(5)->get();

        $topRequestedProducts = [];

        $inProductionQueue = Order::where('status', 'in-production')->count();

        return response()->json([
            'totalProducts' => $totalProducts,
            'totalOrders' => $totalOrders,
            'totalCustomers' => $totalCustomers,
            'salesTrend' => $salesTrend,
            'recentOrders' => $recentOrders,
            'topRequestedProducts' => $topRequestedProducts,
            'inProductionQueue' => $inProductionQueue,
        ]);
    }
}

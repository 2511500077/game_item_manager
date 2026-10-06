<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik item
        $totalItems = Item::count();

        $availableItems = Item::where('stock', '>', 0)->count();

        $soldOutItems = Item::where('stock', 0)->count();


        // Statistik order
        $totalOrders = Order::count();

        $completedOrders = Order::where('status', 'completed')->count();

        $pendingOrders = Order::where('status', 'pending')->count();


        // Total penjualan
        $totalSales = Order::with('orderItems')
            ->where('status', 'completed')
            ->get()
            ->sum(function ($order) {

                return $order->orderItems->sum(function ($orderItem) {

                    return $orderItem->price * $orderItem->quantity;

                });

            });


        // Total fee
        $totalFee = Order::where('status', 'completed')
            ->sum('fee');


        // Total modal
        $totalCapital = Order::with('orderItems.item')
            ->where('status', 'completed')
            ->get()
            ->sum(function ($order) {

                return $order->orderItems->sum(function ($orderItem) {

                    return $orderItem->item->buy_price * $orderItem->quantity;

                });

            });


        // Total profit
        $totalProfit = $totalSales - $totalFee - $totalCapital;


        // Order terbaru
        $latestOrders = Order::with('orderItems.item')
            ->latest()
            ->take(5)
            ->get();


        return view('dashboard.index', compact(
            'totalItems',
            'availableItems',
            'soldOutItems',
            'totalOrders',
            'completedOrders',
            'pendingOrders',
            'totalSales',
            'totalFee',
            'totalCapital',
            'totalProfit',
            'latestOrders'
        ));
    }
}
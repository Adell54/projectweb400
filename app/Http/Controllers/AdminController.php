<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Order_items;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function showMetrics(Request $request)
{
    // Filter by date range (optional)
    $startDate = $request->input('start_date') 
        ? Carbon::parse($request->input('start_date')) 
        : Carbon::now()->startOfMonth();

    $endDate = $request->input('end_date') 
        ? Carbon::parse($request->input('end_date')) 
        : Carbon::now()->endOfMonth();

    // Revenue and Profit (Delivered Orders)
    $deliveredOrders = Order::where('status', 'delivered')
        ->whereBetween('created_at', [$startDate, $endDate])
        ->get();

    $totalRevenue = $deliveredOrders->sum('total_price'); // Assuming total_price column exists in the orders table

    $totalProfit = $deliveredOrders->sum(function ($order) {
        $orderItems = Order_items::where('order_id', $order->id)
            ->with('product')
            ->get();

        return $orderItems->sum(function ($item) {
            $productCost = $item->product->cost ?? 0;
            $productPrice = $item->product->price ?? 0;
            return ($productPrice - $productCost) * $item->quantity;
        });
    });

    // Order Status Overview
    $ordersByStatus = Order::whereBetween('created_at', [$startDate, $endDate])
        ->selectRaw('status, COUNT(*) as count')
        ->groupBy('status')
        ->get()
        ->keyBy('status');

    // Best-Selling Products
    $bestSellingProducts = Order_items::whereHas('order', function ($query) use ($startDate, $endDate) {
        $query->where('status', 'delivered')
            ->whereBetween('created_at', [$startDate, $endDate]);
    })
    ->with('product')
    ->select('product_id')
    ->selectRaw('SUM(quantity) as total_sold')
    ->groupBy('product_id')
    ->orderByDesc('total_sold')
    ->take(5)
    ->get();

    return view('admin.profit', compact(
        'totalRevenue',
        'totalProfit',
        'ordersByStatus',
        'bestSellingProducts',
        'startDate',
        'endDate'
    ));
}

}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->latest()->get();
        return view('backend.pages.Admin_Orders.index', compact('orders'));
    }
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:Pending,Processing,Shipped,Delivered,Cancelled',
        ]);
        $order->status = $request->status;
        if ($request->status == 'Delivered') {
            $order->payment_status = 'Paid';
        }
        $order->save();
        return back()->with('success', 'Order status updated successfully.');
    }
    public function show(Order $order)
    {
        $order->load(['user', 'deliveryAddress', 'items.product']);

        return view('backend.pages.Admin_Orders.show', compact('order'));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderStatusController extends Controller
{
    public function index()
    {
        // Lấy danh sách đơn hàng
        $orders = Order::paginate(10);
        return view('admin.status.index', compact('orders'));
    }

    public function updateStatus(Request $request, $id)
    {
        // Cập nhật trạng thái đơn hàng
        $order = Order::find($id);
        $order->status = $request->input('status');
        $order->save();

        return redirect()->back()->with('success', 'Trạng thái đơn hàng đã được cập nhật');
    }
}

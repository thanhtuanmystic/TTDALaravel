<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function pendingOrder()
    {
        $pending_orders = Order::where("status", "pending")->latest()->get();
        $orders = Order::with('products')->get();
        return view('admin.pendingorders', compact('pending_orders','orders'));
    }
    public function completedOrder()
    {
        $completed_orders = Order::where("status", "completed")->latest()->get();
        return view('admin.completedorders', compact('completed_orders'));
    }
    public function changeStatus(Request $request)
    {
        $id = $request->changestatus;
        Order::findOrFail($id)->update([
            'status' => "completed"
        ]);
        return redirect()->route('pendingorder')->with('message', 'Đã xác nhận sản phẩm');
    }

}

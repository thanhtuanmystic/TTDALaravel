<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $pending_orders = Order::where("status", "pending")->latest()-> get();
        return view('admin.pendingorders', compact('pending_orders'));
    }

}

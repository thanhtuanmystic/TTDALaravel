<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function pendingOrder()
    {
        $orders = Order::where('status', 'pending')->with('products')->get();
        if (\Illuminate\Support\Facades\Session::has('user')) {
            return view('admin.pendingorders', compact('orders'));
        }
        return redirect()->route('adminlogin')->with('message', 'Bạn cần đăng nhập');
       
    }
    public function completedOrder()
    {

        $orders = Order::where('status', 'completed')->with('products')->get();
        if (\Illuminate\Support\Facades\Session::has('user')) {
            return view('admin.completedorders', compact('orders'));
        }
        return redirect()->route('adminlogin')->with('message', 'Bạn cần đăng nhập');
       
    }
    public function doneOrder() {
        $orders = Order::where('status', 'done')->with('products')->get();
        if (\Illuminate\Support\Facades\Session::has('user')) {
            return view('admin.doneorders', compact('orders'));
        }
        return redirect()->route('adminlogin')->with('message', 'Bạn cần đăng nhập');
        

    }   
    public function changeStatus(Request $request)
    {
        $id = $request->changestatus;
        Order::findOrFail($id)->update([
            'status' => "completed"
        ]);
        return redirect()->route('pendingorder')->with('message', 'Đã xác nhận sản phẩm');
    }
    public function changeStatusToDone(Request $request)
    {
        $id = $request->changestatustodone;
        Order::findOrFail($id)->update([
            'status' => "done"
        ]);
        return redirect()->route('completedorder')->with('message', 'Đã xác nhận giao hàng thành công');
    }

}

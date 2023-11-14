<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\OrderConfirmation;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
    public function doneOrder()
    {
        $orders = Order::where('status', 'done')->with('products')->get();
        if (\Illuminate\Support\Facades\Session::has('user')) {
            return view('admin.doneorders', compact('orders'));
        }
        return redirect()->route('adminlogin')->with('message', 'Bạn cần đăng nhập');


    }
    public function cancelOrder()
    {
        $orders = Order::where('status', 'cancel')->with('products')->get();
        if (\Illuminate\Support\Facades\Session::has('user')) {
            return view('admin.cancelorders', compact('orders'));
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
        $orderConfirmation = new OrderConfirmation();
        Mail::to("tuanvp2001@gmail.com")->send($orderConfirmation);
        return redirect()->route('completedorder')->with('message', 'Đã xác nhận giao hàng thành công');
    }
    public function changeStatusToCancel(Request $request)
    {
        $id = $request->changestatustocancel;
        Order::findOrFail($id)->update([
            'status' => "cancel"
        ]);       
        return redirect()->route('cancelorder')->with('message', 'Đã hủy đơn hàng thành công');
    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Order;
use App\Models\User;
use DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if (\Illuminate\Support\Facades\Session::has('user')) {
            // Lấy danh sách tất cả người dùng
            $users = User::all();

            foreach ($users as $user) {
                // Đếm số lượng đơn hàng của mỗi người dùng
                $orderCount = Order::where('userid', $user->id)->count();
                // Lưu thông tin vào mảng
                $userData = [
                    'userid' => $user->id,
                    'name' => $user->name,
                    'count' => $orderCount,
                ];
                $countUserOrder[] = $userData;
            }
            usort($countUserOrder, function ($a, $b) {
                // Sắp xếp theo giá trị count giảm dần
                return $b['count'] <=> $a['count'];
            });
            $allblogs = Blog::latest()->get();
            $order_count = Order::count();
            $total_vnpay = Order::where('payment_method', 'Thanh toan VNPAY')->sum('total_price');
            $total_banking = Order::where('payment_method', 'Banking')->sum('total_price');
            $total_cod = Order::where('payment_method', 'COD')->sum('total_price');
            return view('admin.dashboard', compact('order_count', 'total_vnpay', 'total_banking', 'total_cod', 'countUserOrder','allblogs'));
        } else {
            return redirect()->route('adminlogin')->with('message', 'Bạn cần đăng nhập');
        }
    }
    public function adminLogin()
    {
        return view('admin.admin_login');
    }
    public function adminLoginPost(Request $request)
    {
        $adminName = $request->adminName;
        $password = $request->password;
        $user = DB::table('admin_account')->where('name', $adminName)->first();
        if ($user && $user->name == $adminName && $user->password == $password) {
            // Đăng nhập thành công
            $request->session()->put('user', $user); // Lưu thông tin người dùng vào session
            return redirect()->route('admindashboard');
        } else {
            return redirect()->route('adminlogin')->with('message', 'Thông tin đăng nhập không chính xác');
        }
    }
    public function adminLogout(Request $request)
    {
        $request->session()->forget('user'); // Xóa thông tin người dùng khỏi session
        return redirect()->route('admindashboard');
    }
    public function adminContact()
    {
        $contact_data = DB::table('contact')->get();
        if (\Illuminate\Support\Facades\Session::has('user')) {
            return view('admin.admincontact', compact('contact_data'));
        }
        return redirect()->route('adminlogin')->with('message', 'Bạn cần đăng nhập');

    }
    public function myProfile()
    {
        return view('admin.adminprofile');
    }
}

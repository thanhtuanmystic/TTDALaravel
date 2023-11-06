<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if (\Illuminate\Support\Facades\Session::has('user')) {
            return view('admin.dashboard');
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
}

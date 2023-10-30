<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Coupons;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.allcategory', compact('categories'));
    }
    public function addCategory()
    {
        return view('admin.addcategory');
    }
    public function storeCategory(Request $request)
    {
        $request->validate([
            'category_name' => 'required|unique:categories'
        ]);
        Category::insert([
            'category_name' => $request->category_name,
            'slug' => strtolower(str_replace('', '-', $request->category_name))
        ]);
        return redirect()->route('allcategory')->with('message', 'Thêm danh mục sản phẩm thành công');
    }
    public function editCategory($id)
    {
        $category_info = Category::findOrFail($id);
        return view('admin.editcategory', compact('category_info'));
    }
    public function updateCategory(Request $request)
    {
        $category_id = $request->category_id;
        $request->validate([
            'category_name' => 'required|unique:categories'
        ]);
        Category::findOrFail($category_id)->update([
            'category_name' => $request->category_name,
            'slug' => strtolower(str_replace('', '-', $request->category_name))
        ]);
        return redirect()->route('allcategory')->with('message', 'Sửa danh mục sản phẩm thành công');
    }
    public function deleteCategory($id)
    {
        Category::findOrFail($id)->delete();
        return redirect()->route('allcategory')->with('message', 'Xóa danh mục sản phẩm thành công');

    }

    // mã giảm giá
    public function allCoupon()
    {
        $coupons = Coupons::latest()->get();
        return view('admin.allcoupon', compact('coupons'));
    }
    public function addCoupon()
    {
        return view('admin.addcoupon');
    }
    public function storeCoupon(Request $request)
    {
        Coupons::insert([
            'code' => $request->coupon_code,
            'discount' => $request->coupon_discount,
            'valid_until' => $request->coupon_expired
        ]);
        return redirect()->route('allcoupon')->with('message', 'Thêm mã giảm giá thành công');
    }
    public function editCoupon($id)
    {
        $coupon_info = Coupons::findOrFail($id);
        return view('admin.editcoupon', compact('coupon_info'));
    }
    public function updateCoupon(Request $request)
    {
        $coupon_id = $request->coupon_id;
        Coupons::findOrFail($coupon_id)->update([
            'code' => $request->coupon_code,
            'discount' => $request->coupon_discount,
            'valid_until' => $request->coupon_expired
        ]);
        return redirect()->route('allcoupon')->with('message', 'Sửa mã giảm giá thành công');
    }
    public function deleteCoupon($id)
    {
        Coupons::findOrFail($id)->delete();
        return redirect()->route('allcoupon')->with('message', 'Xóa mã giảm giá thành công');

    }

}

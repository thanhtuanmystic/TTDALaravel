<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    function locdautiengviet($str)
    {
        $str = strtolower($str); //chuyển chữ hoa thành chữ thường
        $unicode = array(
            'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd' => 'đ',
            'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i' => 'í|ì|ỉ|ĩ|ị',
            'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
            'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'D' => 'Đ',
            'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
            'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        );
        foreach ($unicode as $nonUnicode => $uni) {
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
        }
        $str = str_replace(' ', '-', $str);
        return $str;
    }
    public function index()
    {
        $allsubcategories = Subcategory::latest()->get();
        if (\Illuminate\Support\Facades\Session::has('user')) {
            return view('admin.allsubcategory', compact('allsubcategories'));
        }
        return redirect()->route('adminlogin')->with('message', 'Bạn cần đăng nhập');
        
    }
    public function addSubCategory()
    {
        $categories = Category::latest()->get();
        if (\Illuminate\Support\Facades\Session::has('user')) {
            return view('admin.addsubcategory', compact('categories'));
        }
        return redirect()->route('adminlogin')->with('message', 'Bạn cần đăng nhập');
       
    }
    public function storeSubCategory(Request $request)
    {
        $request->validate([
            'subcategory_name' => 'required|unique:subcategories',
            'category_id' => 'required'
        ]);
        $category_id = $request->category_id;
        $category_name = Category::where('id', $category_id)->value('category_name');
        Subcategory::insert([
            'subcategory_name' => $request->subcategory_name,
            'slug' => strtolower($this->locdautiengviet(str_replace('', '-', $request->subcategory_name))),
            'category_id' => $category_id,
            'category_name' => $category_name
        ]);
        Category::where('id', $category_id)->increment('subcategory_count', 1);
        return redirect()->route('allsubcategory')->with('message', 'Thêm danh mục con thành công');
    }
    public function editSubCategory($id)
    {
        $subcateinfo = Subcategory::findOrFail($id);
        if (\Illuminate\Support\Facades\Session::has('user')) {
            return view('admin.editsubcategory', compact('subcateinfo'));
        }
        return redirect()->route('adminlogin')->with('message', 'Bạn cần đăng nhập');
       
    }
    public function updateSubCategory(Request $request)
    {
        $request->validate(['subcategory_name' => 'required|unique:subcategories']);
        $subcatid = $request->subcatid;
        Subcategory::findOrFail($subcatid)->update([
            'subcategory_name' => $request->subcategory_name,
            'slug' => strtolower($this->locdautiengviet(str_replace('', '-', $request->subcategory_name)))
        ]);
        return redirect()->route('allsubcategory')->with('message', 'Sửa danh mục con thành công');

    }
    public function deleteSubCategory($id)
    {
        $cat_id = Subcategory::where('id', $id)->value('category_id');
        Subcategory::findOrFail($id)->delete();
        Category::where('id', $cat_id)->decrement('subcategory_count', 1);
        return redirect()->route('allsubcategory')->with('message', 'Xóa danh mục con thành công');

    }
}
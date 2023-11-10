<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function locdautiengviet($str){
        $str = strtolower($str); //chuyển chữ hoa thành chữ thường
        $unicode = array(
        'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
        'd'=>'đ',
        'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
        'i'=>'í|ì|ỉ|ĩ|ị',
        'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
        'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
        'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
        'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
        'D'=>'Đ',
        'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
        'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
        'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
        'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
         'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
         );
         foreach($unicode as $nonUnicode=>$uni){
                $str = preg_replace("/($uni)/i", $nonUnicode, $str);
         }
         $str = str_replace(' ','-',$str);
         return $str;
    }
    public function index()
    {
        $products = Product::latest()->get();
        if (\Illuminate\Support\Facades\Session::has('user')) {
            return view('admin.allproducts', compact('products'));
        }
        return redirect()->route('adminlogin')->with('message', 'Bạn cần đăng nhập');
       
    }
    public function addProduct()
    {
        $categories = Category::latest()->get();
        $subcategories = Subcategory::latest()->get();
        if (\Illuminate\Support\Facades\Session::has('user')) {
            return view('admin.addproduct', compact('categories', 'subcategories'));
        }
        return redirect()->route('adminlogin')->with('message', 'Bạn cần đăng nhập');
        
    }
    public function storeProduct(Request $request)
    {
        $request->validate([
            'product_name' => 'required|unique:products',
            'price' => 'required',
            'quantity' => 'required',
            'product_short_des' => 'required',
            'product_long_des' => 'required',
            'product_category_id' => 'required',
            'product_subcategory_id' => 'required',
           
        ]);
        $image = $request->file('product_img');
        $img_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $request->product_img->move(public_path('upload'), $img_name);
        $img_url = 'upload/' . $img_name;
        $category_id = $request->product_category_id;
        $subcategory_id = $request->product_subcategory_id;
        $category_name = Category::where('id', $category_id)->value('category_name');
        $subcategory_name = Subcategory::where('id', $subcategory_id)->value('subcategory_name');

        Product::insert([
            'product_name' => $request->product_name,
            'product_short_des' => $request->product_short_des,
            'product_long_des' => $request->product_long_des,
            'price' => $request->price,
            'product_category_name' => $category_name,
            'product_subcategory_name' => $subcategory_name,
            'product_category_id' => $request->product_category_id,
            'product_subcategory_id' => $request->product_subcategory_id,
            'product_img' => $img_url,
            'quantity' => $request->quantity,
            'slug' => strtolower($this->locdautiengviet(str_replace(' ', '-', $request->product_name))),
        ]);

        Category::where('id', $category_id)->increment('product_count', 1);
        Subcategory::where('id', $subcategory_id)->increment('product_count', 1);
        return redirect()->route('allproducts')->with('message', 'Thêm sản phẩm thành công');
    }
    public function editProductImg($id)
    {
        $productinfo = Product::findOrFail($id);
        if (\Illuminate\Support\Facades\Session::has('user')) {
            return view('admin.editproductimg', compact('productinfo'));
        }
        return redirect()->route('adminlogin')->with('message', 'Bạn cần đăng nhập');
       
    }
    public function updateProductImg(Request $request)
    {
        $request->validate([
            'product_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $id = $request->id;
        $image = $request->file('product_img');
        $img_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $request->product_img->move(public_path('upload'), $img_name);
        $img_url = 'upload/' . $img_name;

        Product::findOrFail($id)->update([
            'product_img' => $img_url
        ]);
        return redirect()->route('allproducts')->with('message', 'Cập nhật ảnh sản phẩm thành công');
    }
    public function editProduct($id)
    {
        $productinfo = Product::findOrFail($id);
        if (\Illuminate\Support\Facades\Session::has('user')) {
            return view('admin.editproduct', compact('productinfo'));
        }
        return redirect()->route('adminlogin')->with('message', 'Bạn cần đăng nhập');
       
    }
    public function updateProduct(Request $request)
    {
        $productid = $request->id;
        $request->validate([
            'product_name' => 'required|unique:products',
            'price' => 'required',
            'quantity' => 'required',
            'product_short_des' => 'required',
            'product_long_des' => 'required',
        ]);

        Product::findOrFail($productid)->update([
            'product_name' => $request->product_name,
            'product_short_des' => $request->product_short_des,
            'product_long_des' => $request->product_long_des,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'slug' => strtolower($this->locdautiengviet(str_replace(' ', '-', $request->product_name))),
        ]);

        return redirect()->route('allproducts')->with('message', 'Sửa sản phẩm thành công');
    }
    public function deleteProduct($id)
    {

        $cat_id = Product::where('id', $id)->value('product_category_id');
        $subcat_id = Product::where('id', $id)->value('product_subcategory_id');
        Product::findOrFail($id)->delete();
        Category::where('id', $cat_id)->decrement('product_count', 1);
        Subcategory::where('id', $subcat_id)->decrement('product_count', 1);
        return redirect()->route('allproducts')->with('message', 'Xóa sản phẩm thành công');
    }
    
}
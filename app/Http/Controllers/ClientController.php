<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Coupons;
use App\Models\Order;
use App\Models\Product;
use App\Models\ShippingInfo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class ClientController extends Controller
{
    public function categoryPage($id)
    {
        $category_ = Category::findOrFail($id);
        $products = Product::where('product_category_id', $id)->latest()->get();
        return view('user_template.category', compact('category_', 'products'));
    }
    public function singleProduct($id)
    {
        $product = Product::findOrFail($id);
        $subcat_id = Product::where('id', $id)->value('product_subcategory_id');
        $related_product = Product::where('product_subcategory_id', $subcat_id)->latest()->get();
        return view('user_template.product', compact('product', 'related_product'));
    }
  

    public function showAllProducts(Request $request)
    {
        $allproducts = Product::latest()->paginate(6);
        $categories = Category::latest()->get();
        $latestProducts = Product::orderBy('id', 'desc')->take(3)->get();
        $productCount = Product::count();
        return view('user_template.showallproducts', compact('allproducts', 'productCount', 'latestProducts', 'categories'));
    }
    public function addToCart()
    {
        $userid = Auth::id();
        $cart_items = Cart::where('user_id', $userid)->get();
        return view('user_template.addtocart', compact('cart_items'));
    }
    public function addProductToCart(Request $request)
    {
        $product_price = $request->price;
        $quantity = $request->quantity;
        $price = $product_price * $quantity;
        Cart::insert([
            'product_id' => $request->product_id,
            'user_id' => Auth::id(),
            'quantity' => $request->quantity,
            'price' => $price,
        ]);
        return redirect()->route('addtocart')->with('message', 'Thêm vào giỏ hàng thành công!');
    }
    public function removeCartItem($id)
    {
        Cart::findOrFail($id)->delete();
        return redirect()->route('addtocart')->with('message', 'Xóa sản phẩm khỏi giỏ hàng thành công!');

    }
    public function getShippingAddress()
    {
        return view('user_template.shippingaddress');
    }
    public function goToCheckOut()
    {
        return redirect()->route('checkout');
    }
    public function checkout()
    {
        $userid = Auth::id();
        $cart_items = Cart::where('user_id', $userid)->get();
        $shipping_address = ShippingInfo::where('user_id', $userid)->first();
        return view('user_template.checkout', compact('cart_items', 'shipping_address'));
    }
    public function placeOrder(Request $request)
    {

        $userid = Auth::id();
        $cart_items = Cart::where('user_id', $userid)->get();
        foreach ($cart_items as $item) {
            Order::insert([
                'userid' => $userid,
                'shipping_fullname' => $request->fullname,
                'shipping_phoneNumber' => $request->phone_number,
                'shipping_email' => $request->email,
                'shipping_address' => $request->address,
                'shipping_district' => $request->district,
                'shipping_city' => $request->city,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'total_price' => $item->price
            ]);
            $id = $item->id;
            Cart::findOrFail($id)->delete();
        }
        return redirect()->route('pendingorders')->with('message', 'Đơn hàng của bạn đã được đặt thành công');
    }
    public function searchProduct(Request $request)
    {

        $searchTerm = $request->searchInput;
        $searchProducts = Product::where('product_name', 'like', '%' . $searchTerm . '%')->get();
        $searchProductCount = $searchProducts->count();
        return view('user_template.search', compact('searchProducts', 'searchProductCount', 'searchProductCount'));
    }
    public function applyCoupon(Request $request)
    {
        $couponCode = $request->input('coupon_code');
        $coupon = Coupons::where('code', $couponCode)
            ->where('valid_until', '>=', now())
            ->first();
        if ($coupon) {
            // Áp dụng giảm giá và tính toán số tiền giảm giá ở đây
            $discountAmount = $coupon->discount; // Thay bằng logic thực tế
            return response()->json(['success' => true, 'discount' => $discountAmount]);
        } else {
            return response()->json(['success' => false]);
        }

    }
    public function userProfile()
    {
        $userid = Auth::id();
        $userProfile = User::where('id', $userid)->first();
        return view('user_template.userprofile', compact('userProfile'));
    }

    public function pendingOrders()
    {
        $pending_orders = Order::where('status', 'pending')->latest()->get();
        return view('user_template.pendingorders', compact('pending_orders'));
    }
    public function history()
    {
        return view('user_template.history');
    }

    public function newRelease()
    {
        return view('user_template.newrelease');
    }
    public function todaysDeal()
    {
        return view('user_template.todaysdeal');
    }
    public function customService()
    {
        return view('user_template.customservice');
    }
}
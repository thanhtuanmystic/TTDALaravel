<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\ShippingInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class ClientController extends Controller
{
    public function categoryPage($id)
    {
        $category = Category::findOrFail($id);
        $products = Product::where('product_category_id', $id)->latest()->get();
        return view('user_template.category', compact('category', 'products'));
    }
    public function singleProduct($id)
    {
        $product = Product::findOrFail($id);
        $subcat_id = Product::where('id', $id)->value('product_subcategory_id');
        $related_product = Product::where('product_subcategory_id', $subcat_id)->latest()->get();
        return view('user_template.product', compact('product', 'related_product'));
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
            'price' => $price
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
    public function addShippingAddress(Request $request)
    {
        ShippingInfo::insert([
            'user_id' => Auth::id(),
            'phone_number' => $request->phone_number,
            'city_name' => $request->city_name,
            'postal_code' => $request->postal_code
        ]);
        return redirect()->route('checkout');
    }
    public function checkout()
    {
        $userid = Auth::id();
        $cart_items = Cart::where('user_id', $userid)->get();
        $shipping_address = ShippingInfo::where('user_id', $userid)->first();
        return view('user_template.checkout', compact('cart_items', 'shipping_address'));
    }
    public function placeOrder()
    {
        $userid = Auth::id();
        $shipping_address = ShippingInfo::where('user_id', $userid)->first();
        $cart_items = Cart::where('user_id', $userid)->get();
        foreach ($cart_items as $item) {
            Order::insert([
                'userid' => $userid,
                'shipping_phoneNumber' => $shipping_address->phone_number,
                'shipping_city' => $shipping_address->city_name,
                'shipping_postalcode' => $shipping_address->postal_code,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'total_price' => $item->price
            ]);
            $id = $item->id;
            Cart::findOrFail($id)->delete();
        }
        ShippingInfo::where('user_id', $userid)->first()->delete();
        return redirect()->route('pendingorders')->with('message', 'Đơn hàng của bạn đã được đặt thành công');
    }
    public function userProfile()
    {
        return view('user_template.userprofile');
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
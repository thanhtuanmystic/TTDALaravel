<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Coupons;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Utilities\VNPay;
use DB;
use Illuminate\Support\Facades\Http;
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
    public function goToCheckOut(Request $request)
    {
        $userid = Auth::id();
        $rank = User::where('id', $userid)->first()->rank;
        $cart_items = Cart::where('user_id', $userid)->get();
        $discount_amount = $request->discount_amount_hidden;
        if ($request->total_final_hidden > 1000000 || $rank == "VIP" || $rank == "VVIP") {
            $shipping_fee = 0;
        } else {
            $shipping_fee = 35000;
        }

        $totalFinal = $request->total_final_hidden + $shipping_fee;

        return view('user_template.checkout', compact('discount_amount', 'totalFinal', 'cart_items', 'shipping_fee'));
    }


    public function placeOrder(Request $request)
    {
        $lastOrder = Order::latest('id')->first();
        if ($lastOrder) {
            $lastOrderId = $lastOrder->id;
        }
        $userid = Auth::id();
        $cart_items = Cart::where('user_id', $userid)->get();
        $quantity = Cart::count();
        if ($request->input('button') === 'placeorder') {
            Order::insert([
                'userid' => $userid,
                'shipping_fullname' => $request->fullname,
                'shipping_phoneNumber' => $request->phone_number,
                'shipping_email' => $request->email,
                'shipping_address' => $request->address,
                'shipping_district' => $request->district,
                'shipping_city' => $request->city,
                'product_id' => "1",
                'quantity' => $quantity,
                'total_price' => $request->total_final_checkout,
                'shipping_fee' => $request->shipping_fee_checkout,
                'payment_method' => 'COD'
            ]);
            foreach ($cart_items as $item) {
                DB::table('order_product')->insert([
                    'order_id' => $lastOrderId + 1,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity
                ]);
                $id = $item->id;
                Cart::findOrFail($id)->delete();
            }
            return redirect()->route('pendingorders')->with('message', 'Đơn hàng của bạn đã được đặt thành công');

        } elseif ($request->input('button') === 'vnpay') {
            $data_url = VNPay::vnpay_create_payment([
                'vnp_TxnRef' => $lastOrderId + 1,
                'vnp_OrderInfo' => "mô tả đơn hàng",
                'vnp_Amount' => $request->total_final_checkout
            ]);
            Order::insert([
                'userid' => $userid,
                'shipping_fullname' => $request->fullname,
                'shipping_phoneNumber' => $request->phone_number,
                'shipping_email' => $request->email,
                'shipping_address' => $request->address,
                'shipping_district' => $request->district,
                'shipping_city' => $request->city,
                'product_id' => "1",
                'quantity' => $quantity,
                'total_price' => $request->total_final_checkout,
                'shipping_fee' => $request->shipping_fee_checkout,
                'payment_method' => 'Thanh toan VNPAY'
            ]);
            foreach ($cart_items as $item) {
                DB::table('order_product')->insert([
                    'order_id' => $lastOrderId + 1,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity
                ]);
                $id = $item->id;
                Cart::findOrFail($id)->delete();
            }
            return redirect()->to($data_url);
        }

    }
    public function vnpayCheck(Request $request)
    {
        $vnp_ResponseCode = $request->get('vnp_ResponseCode');
        $vnp_TxnRef = $request->get('vnp_TxnRef');
        $vnp_Amount = $request->get('vnp_Amount');

        if ($vnp_ResponseCode != null) {
            if ($vnp_ResponseCode == 0) {
                return redirect()->route('pendingorders')->with('message', 'Đơn hàng của bạn đã được đặt thành công');
            } else {
                return redirect()->route('pendingorders')->with('message', 'Thanh toán thất bại');
            }
        }


    }

    public function sortBy(Request $request)
    {
        if ($request->sort_by == 'dafault') {
            $listProducts = Product::orderBy('id', 'desc')->get();
            return response()->json(['success' => true, 'listProducts' => $listProducts]);
        }
        if ($request->sort_by == 'name') {
            $listProducts = Product::orderBy('product_name', 'desc')->get();
            return response()->json(['success' => true, 'listProducts' => $listProducts]);
        }
        if ($request->sort_by == 'price-hightolow') {
            $listProducts = Product::orderBy('price', 'desc')->get();
            return response()->json(['success' => true, 'listProducts' => $listProducts]);
        }
        if ($request->sort_by == 'price-lowtohigh') {
            $listProducts = Product::orderBy('price', 'asc')->get();
            return response()->json(['success' => true, 'listProducts' => $listProducts]);
        }
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
        $orders = Order::where('status', 'done')->where('userid', Auth::id())->with('products')->get();
        $checkTotalPriceOfUser = $orders->sum('total_price');
        if ($checkTotalPriceOfUser >= 1000000) {
            User::findOrFail($userid)->update([
                'rank' => "VIP",
            ]);
        }
        $rank = $userProfile->rank;
        return view('user_template.userprofile', compact('userProfile', 'orders', 'rank'));
    }

    public function pendingOrders()
    {

        $orders = Order::where('status', 'pending')->where('userid', Auth::id())->with('products')->get();
        return view('user_template.pendingorders', compact('orders'));
    }
    public function history()
    {
        $orders = Order::where('status', 'done')->where('userid', Auth::id())->with('products')->get();
        return view('user_template.history', compact('orders'));
    }
    public function contact()
    {
        return view('user_template.contact');
    }
    public function sendContact(Request $request)
    {
        $name = $request->contact_name;
        $email = $request->contact_email;
        $phone = $request->contact_phone;
        $message = $request->contact_message;
        DB::table('contact')->insert([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'message' => $message
        ]);
        return redirect()->route('contact')->with('message', 'Chúng tớ đã nhận được lời nhắn của bạn');
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

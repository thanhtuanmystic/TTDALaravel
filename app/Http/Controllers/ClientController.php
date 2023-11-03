<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Coupons;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use DB;
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
        $cart_items = Cart::where('user_id', $userid)->get();
        $discount_amount = $request->discount_amount_hidden;
        if ($request->total_final_hidden > 1000000) {
            $shipping_fee = 0;
        } else {
            $shipping_fee = 35000;
        }

        $totalFinal = $request->total_final_hidden - $shipping_fee;

        return view('user_template.checkout', compact('discount_amount', 'totalFinal', 'cart_items', 'shipping_fee'));
    }


    public function placeOrder(Request $request)
    {
        // $latestOrder = DB::table('orders')->where('id', '11')->get();
        $lastOrder = Order::latest('id')->first();
        if ($lastOrder) {
            $lastOrderId = $lastOrder->id;
        }
        $userid = Auth::id();
        $cart_items = Cart::where('user_id', $userid)->get();
        $quantity = Cart::count();
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
    }
    public function vnpayPayment(Request $request)
    {
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://127.0.0.1:8000/vnpay-payment-result";
        $vnp_TmnCode = "K8CIIPWU"; //Mã website tại VNPAY 
        $vnp_HashSecret = "JWRXCXSWHRBBHVOOQARHPZSIKWLNQVLU"; //Chuỗi bí mật



        $vnp_TxnRef = '8';
        $vnp_OrderInfo = 'thanh toan don hang';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $request->vnpay_totalFinal;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        //Add Params of 2.0.1 Version
        // $vnp_ExpireDate = $_POST['txtexpire'];


        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00'
            ,
            'message' => 'success'
            ,
            'data' => $vnp_Url
        );
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
        // vui lòng tham khảo thêm tại code demo
    }
    public function vnpayPaymentResult()
    {
        if (isset($_GET['vnp_Amount'])) {
            dd($_GET['vnp_Amount']);
        } else {
            dd(999);
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
        return view('user_template.userprofile', compact('userProfile', 'orders'));
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
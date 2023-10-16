<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;



class ClientController extends Controller
{
    public function categoryPage($id)
    {
        $category = Category::findOrFail($id);
        $products = Product::where('product_category_id', $id)->latest() ->get();
        return view('user_template.category', compact('category', 'products'));
    }
    public function singleProduct($id)
    {
        $product = Product::findOrFail($id);
        $subcat_id = Product::where('id', $id)->value('product_subcategory_id');
        $related_product = Product::where('product_subcategory_id', $subcat_id)->latest()->get();
        return view('user_template.product', compact('product','related_product'));
    }
    public function addToCart()
    {
        return view('user_template.addtocart');
    }
    public function checkout()
    {
        return view('user_template.checkout');
    }
    public function userProfile()
    {
        return view('user_template.userprofile');
    }
    public function pendingOrders()
    {
        return view('user_template.pendingorders');
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
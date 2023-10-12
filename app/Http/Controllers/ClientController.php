<?php

namespace App\Http\Controllers;



class ClientController extends Controller
{
    public function categoryPage()
    {
        return view('user_template.category');
    }
    public function singleProduct()
    {
        return view('user_template.product');
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
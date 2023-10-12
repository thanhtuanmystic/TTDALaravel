<?php

namespace App\Http\Controllers;

use App\Models\Product;



class HomeController extends Controller
{
    public function index()
    {
        $allproducts = Product::latest()->get();
        return view('user_template.home', compact('allproducts'));
    }
}
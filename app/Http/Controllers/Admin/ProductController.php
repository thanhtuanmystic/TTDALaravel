<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.allproducts');
    }
    public function addProduct()
    {
        return view('admin.addproduct');
    }
}

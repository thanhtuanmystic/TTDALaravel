<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Product;



class HomeController extends Controller
{
    public function index()
    {   
        $allblogs = Blog::latest()->paginate(3);
        $allproducts = Product::latest()->paginate(12);
        $categories = Category::latest()->get();
        $latestProducts = Product::orderBy('id', 'desc')->take(3)->get();
        return view('user_template.home', compact('allproducts', 'latestProducts', 'categories','allblogs'));
    }
}
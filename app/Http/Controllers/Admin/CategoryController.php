<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.allcategory');
    }
    public function addCategory()
    {
        return view('admin.addcategory');
    }
}
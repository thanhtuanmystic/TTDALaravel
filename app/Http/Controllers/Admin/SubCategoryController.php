<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class SubCategoryController extends Controller
{
    public function index()
    {
        return view('admin.allsubcategory');
    }
    public function addSubCategory()
    {
        return view('admin.addsubcategory');
    }
}

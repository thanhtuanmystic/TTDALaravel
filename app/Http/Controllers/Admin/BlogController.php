<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    function locdautiengviet($str)
    {
        $str = strtolower($str); //chuyển chữ hoa thành chữ thường
        $unicode = array(
            'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd' => 'đ',
            'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i' => 'í|ì|ỉ|ĩ|ị',
            'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
            'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'D' => 'Đ',
            'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
            'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        );
        foreach ($unicode as $nonUnicode => $uni) {
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
        }
        $str = str_replace(' ', '-', $str);
        return $str;
    }
    public function adminBlog()
    {
        $blogs = Blog::latest()->get();
        return view("admin.admin_blog", compact("blogs"));
    }
    public function addBlog()
    {
        return view("admin.addblog");
    }
    public function storeBlog(Request $request)
    {
        $request->validate([
            'blog_title' => 'required|unique:blogs',
        ]);
        $image = $request->file('blog_image');
        $img_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $request->blog_image->move(public_path('upload/blog'), $img_name);
        $img_url = 'upload/blog/' . $img_name;


        Blog::insert([
            'blog_title' => $request->blog_title,
            'blog_description' => $request->blog_description,
            'blog_content' => $request->blog_content,
            'blog_image' => $img_url,
            'blog_author' => $request->blog_title,
            'slug' => strtolower($this->locdautiengviet(str_replace(' ', '-', $request->blog_title))),
        ]);


        return redirect()->route('adminblog')->with('message', 'Thêm bài viết thành công');
    }
    public function editBlog($id)
    {
        $blogInfo = Blog::findOrFail($id);
        return view('admin.editblog', compact('blogInfo'));
    }

    public function updateBlog(Request $request)
    {
        $blogid = $request->id;
        $request->validate([
            'blog_title' => 'required|unique:blogs',
        ]);

        Blog::findOrFail($blogid)->update([
            'blog_title' => $request->blog_title,
            'blog_description' => $request->blog_description,
            'blog_content' => $request->blog_content,
            'blog_author' => $request->blog_author,
            'slug' => strtolower($this->locdautiengviet(str_replace(' ', '-', $request->blog_title))),
        ]);

        return redirect()->route('adminblog')->with('message', 'Sửa bài viết thành công');
    }
    public function deleteBlog($id)
    {
        Blog::findOrFail($id)->delete();
        return redirect()->route('adminblog')->with('message', 'Xóa bài viết thành công');
    }

    public function allBlog()
    {
        $allblog = Blog::latest()->get();
        return view('user_template.allblog', compact('allblog'));
    }
    public function singleBlog($id)
    {
        $blog = Blog::findOrFail($id);        
        return view('user_template.blogdetail', compact('blog'));
    }
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
   
    use HasFactory;
    protected $fillable = [
        'blog_title',
        'blog_description',
        'blog_content',
        'blog_image',
        'blog_author',
        'slug',
    ];
}

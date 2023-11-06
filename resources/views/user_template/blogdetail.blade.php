@extends('user_template.layouts.template')
@section('main-content')
<style>
    .blog_detail_created_at {
        display: flex;
        justify-content: end;
    }
</style>
<h3 class="text-center mb-3">{{$blog->blog_title}}</h3>
<p class="blog_detail_created_at">{{$blog->created_at->format('d/m/y')}}</p>
<p class="blog_detail_created_at">Tác giả: {{$blog->blog_author}}</p>
@php
    echo $blog->blog_content;
@endphp
@endsection

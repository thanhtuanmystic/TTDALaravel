@extends('user_template.layouts.template')
@section('main-content')
    @foreach ($allblog as $blog)
        <div>
            <p>Blog title: {{ $blog->blog_title }}</p>
            <p>Mo ta bai viet: {{ $blog->blog_description }}</p>
            <p>Noi dung bai viet:</p>
            <div id="blog_content_">a</div>
            @php
                echo $blog->blog_content;
            @endphp

            <p>Anh bai viet:</p>
            <img src="{{ $blog->blog_image }}" alt="">
            <p>Tac gia:</p>
            <p>{{ $blog->blog_author }}</p>
        </div>
    @endforeach
@endsection

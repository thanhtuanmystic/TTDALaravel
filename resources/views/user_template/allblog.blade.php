@extends('user_template.layouts.template')
@section('main-content')
    <h3 class="text-center mb-3">Dream Clothing's Blog</h3>
    <div class="container">
        <div class="row">
            @foreach ($allblog as $blog)
                <div class="col-lg-4">
                    <a href="{{ route('singleblog', [$blog->id, $blog->slug]) }}">
                        <div class="blog-box">
                            <img src="{{ $blog->blog_image }}" alt="">
                            <p>{{ $blog->created_at->format('d/m/y') }}</p>
                            <div class="blog-title">{{ $blog->blog_title }}</div>
                            <p class="blog-description">{{ $blog->blog_description }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection

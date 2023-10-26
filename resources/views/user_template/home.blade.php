@extends('user_template.layouts.template')
@section('main-content')
    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="{{ asset('home/img/categories/cat-1.jpg') }}">
                            <h5><a href="#">Fresh Fruit</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="{{ asset('home/img/categories/cat-2.jpg') }}">
                            <h5><a href="#">Dried Fruit</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="{{ asset('home/img/categories/cat-3.jpg') }}">
                            <h5><a href="#">Vegetables</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="{{ asset('home/img/categories/cat-4.jpg') }}">
                            <h5><a href="#">drink fruits</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="{{ asset('home/img/categories/cat-5.jpg') }}">
                            <h5><a href="#">drink fruits</a></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Featured Product</h2>
                    </div>
                    <div class="featured__controls">
                        <ul>
                            <li class="active" data-filter="*">All</li>
                            @foreach ($categories as $category)
                                <li data-filter=".{{ $category->category_name }}">{{ $category->category_name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row featured__filter">
                @foreach ($allproducts as $product)
                    <div class="col-lg-3 col-md-4 col-sm-6 mix {{$product->product_category_name}}">
                        <div class="featured__item">
                            <div class="featured__item__pic set-bg" data-setbg="{{ asset($product->product_img) }}">
                                <ul class="featured__item__pic__hover">
                                  <form action="{{route('addproducttocart')}}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{ $product->id }}" name="product_id">
                                    <input type="hidden" value="{{ $product->price }}" name="price">
                                    <input type="hidden" value="1" name="quantity">
                                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                    <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                    <input type="submit" value="submit">
                                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>                                   
                                  </form>
                                </ul>
                            </div>
                            <div class="featured__item__text">
                                <h6><a
                                        href="{{ route('singleproduct', [$product->id, $product->slug]) }}">{{ $product->product_name }}</a>
                                </h6>
                                <h5>${{ $product->price }}</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Featured Section End -->
    <!-- Banner Begin -->
    <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="{{ asset('home/img/banner/banner-1.jpg') }}" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="{{ asset('home/img/banner/banner-2.jpg') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->
    <!-- Latest Product Section Begin -->
    <section class="latest-product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Latest Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                @foreach ($latestProducts as $product)
                                    <a href="{{ route('singleproduct', [$product->id, $product->slug]) }}"
                                        class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="{{ asset($product->product_img) }}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{ $product->product_name }}</h6>
                                            <span>{{ $product->price }}</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                            <div class="latest-prdouct__slider__item">
                                @foreach ($latestProducts as $product)
                                    <a href="{{ route('singleproduct', [$product->id, $product->slug]) }}"
                                        class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="{{ asset($product->product_img) }}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{ $product->product_name }}</h6>
                                            <span>{{ $product->price }}</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Top Rated Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                @foreach ($latestProducts as $product)
                                    <a href="{{ route('singleproduct', [$product->id, $product->slug]) }}"
                                        class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="{{ asset($product->product_img) }}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{ $product->product_name }}</h6>
                                            <span>{{ $product->price }}</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                            <div class="latest-prdouct__slider__item">
                                @foreach ($latestProducts as $product)
                                    <a href="{{ route('singleproduct', [$product->id, $product->slug]) }}"
                                        class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="{{ asset($product->product_img) }}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{ $product->product_name }}</h6>
                                            <span>{{ $product->price }}</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Review Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                @foreach ($latestProducts as $product)
                                    <a href="{{ route('singleproduct', [$product->id, $product->slug]) }}"
                                        class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="{{ asset($product->product_img) }}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{ $product->product_name }}</h6>
                                            <span>{{ $product->price }}</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                            <div class="latest-prdouct__slider__item">
                                @foreach ($latestProducts as $product)
                                    <a href="{{ route('singleproduct', [$product->id, $product->slug]) }}"
                                        class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="{{ asset($product->product_img) }}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{ $product->product_name }}</h6>
                                            <span>{{ $product->price }}</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Latest Product Section End -->
    <!-- Blog Section Begin -->
    <section class="from-blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title from-blog__title">
                        <h2>From The Blog</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="{{ asset('home/img/blog/blog-1.jpg') }}" alt="">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                                <li><i class="fa fa-comment-o"></i> 5</li>
                            </ul>
                            <h5><a href="#">Cooking tips make cooking simple</a></h5>
                            <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="{{ asset('home/img/blog/blog-2.jpg') }}" alt="">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                                <li><i class="fa fa-comment-o"></i> 5</li>
                            </ul>
                            <h5><a href="#">6 ways to prepare breakfast for 30</a></h5>
                            <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="{{ asset('home/img/blog/blog-3.jpg') }}" alt="">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                                <li><i class="fa fa-comment-o"></i> 5</li>
                            </ul>
                            <h5><a href="#">Visit the clean farm in the US</a></h5>
                            <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->
@endsection

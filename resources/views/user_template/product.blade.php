@extends('user_template.layouts.template')
@section('main-content')
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('home/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Vegetable’s Package</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <a href="./index.html">Vegetables</a>
                            <span>Vegetable’s Package</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large" src="{{ asset($product->product_img) }}"
                                alt="">
                        </div>
                        {{-- hiển thị những hình ảnh khác của sản phẩm --}}

                        {{-- <div class="product__details__pic__slider owl-carousel">
                        <img data-imgbigurl="{{asset('home/img/product/details/product-details-2.jpg')}}"
                            src="{{asset('home/img/product/details/thumb-1.jpg')}}" alt="">
                        <img data-imgbigurl="{{asset('home/img/product/details/product-details-3.jpg')}}"
                            src="{{asset('home/img/product/details/thumb-2.jpg')}}" alt="">
                        <img data-imgbigurl="{{asset('home/img/product/details/product-details-5.jpg')}}"
                            src="{{asset('home/img/product/details/thumb-3.jpg')}}" alt="">
                        <img data-imgbigurl="{{asset('home/img/product/details/product-details-4.jpg')}}"
                            src="{{asset('home/img/product/details/thumb-4.jpg')}}" alt="">
                    </div> --}}
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3>{{ $product->product_name }}</h3>
                        <div class="product__details__rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>

                        </div>
                        <div class="product__details__price">{{ $product->price }}</div>
                        <p> {{ $product->product_long_des }}</p>
                        <div class="product__details__quantity">
                            <form action="{{ route('addproducttocart') }}" method="POST">
                                @csrf
                                <input type="hidden" value="{{ $product->id }}" name="product_id">
                                <input type="hidden" value="{{ $product->price }}" name="price">
                                <input type="hidden" value="1" name="quantity">
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <label for="quantity"></label>
                                        <input type="number" name="quantity" min="1" value="1">
                                    </div>
                                </div>
                                <br>
                                <div class="sizePart">
                                    <label style="margin-left: 20px">
                                        <input type="radio" name="sizeoption" value="S"> S
                                    </label>
                                    <label style="margin-left: 20px">
                                        <input type="radio" name="sizeoption" value="M"> M
                                    </label>
                                    <label style="margin-left: 20px">
                                        <input type="radio" name="sizeoption" value="L"> L
                                    </label>
                                    <label style="margin-left: 20px">
                                        <input type="radio" name="sizeoption" value="XL"> XL
                                    </label>
                                </div>
                                <br>
                                <input type="submit" class="site-btn" value="Thêm vào giỏ hàng">
                            </form>

                        </div>

                        <ul>
                            <li><b>Tình trạng</b> <span>Còn hàng ({{ $product->quantity }} sản phẩm) </span></li>
                            <li><b>Danh mục </b> {{ $product->product_category_name }} </li>
                            <li><b>Danh mục con </b> {{ $product->product_subcategory_name }} </li>
                            <li><b>Chia sẻ</b>
                                <div class="share">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                    aria-selected="true">Mô tả</a>
                            </li>

                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Mô tả sản phẩm</h6>
                                    <p>{{ $product->product_long_des }}</p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Thông tin sản phẩm</h6>
                                    <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                        Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.
                                        Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam
                                        sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo
                                        eget malesuada. Vivamus suscipit tortor eget felis porttitor volutpat.
                                        Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Praesent
                                        sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac
                                        diam sit amet quam vehicula elementum sed sit amet dui. Vestibulum ante
                                        ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                                        Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.
                                        Proin eget tortor risus.</p>
                                    <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Lorem
                                        ipsum dolor sit amet, consectetur adipiscing elit. Mauris blandit aliquet
                                        elit, eget tincidunt nibh pulvinar a. Cras ultricies ligula sed magna dictum
                                        porta. Cras ultricies ligula sed magna dictum porta. Sed porttitor lectus
                                        nibh. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a.</p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Đánh giá</h6>
                                    <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                        Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.
                                        Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam
                                        sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo
                                        eget malesuada. Vivamus suscipit tortor eget felis porttitor volutpat.
                                        Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Praesent
                                        sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac
                                        diam sit amet quam vehicula elementum sed sit amet dui. Vestibulum ante
                                        ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                                        Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.
                                        Proin eget tortor risus.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->

    <!-- Related Product Section Begin -->
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Sản phẩm liên quan</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($related_product as $product)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="{{ asset($product->product_img) }}">
                                <ul class="product__item__pic__hover">
                                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6><a
                                        href="{{ route('singleproduct', [$product->id, $product->slug]) }}">{{ $product->product_name }}</a>
                                </h6>
                                <h5>{{ $product->price }}</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

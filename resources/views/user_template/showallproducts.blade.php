@extends('user_template.layouts.template')
@section('main-content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('home/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Organi Shop</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Shop</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                {{-- <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <h4>Danh mục</h4>
                            <ul>
                                @foreach ($categories as $category)
                                    <li><a
                                            href="{{ route('category', [$category->id, $category->slug]) }}">{{ $category->category_name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="sidebar__item">
                            <h4>Giá</h4>
                            <div class="price-range-wrap">
                                <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                    data-min="10" data-max="540">
                                    <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                </div>
                                <div class="range-slider">
                                    <div class="price-input">
                                        <input type="text" id="minamount">
                                        <input type="text" id="maxamount">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar__item sidebar__item__color--option">
                            <h4>Màu sắc</h4>
                            <div class="sidebar__item__color sidebar__item__color--white">
                                <label for="white">
                                    Trắng
                                    <input type="radio" id="white">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--gray">
                                <label for="gray">
                                    Xám
                                    <input type="radio" id="gray">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--red">
                                <label for="red">
                                    Đỏ
                                    <input type="radio" id="red">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--black">
                                <label for="black">
                                    Đen
                                    <input type="radio" id="black">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--blue">
                                <label for="blue">
                                    Blue
                                    <input type="radio" id="blue">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--green">
                                <label for="green">
                                    Xanh
                                    <input type="radio" id="green">
                                </label>
                            </div>
                        </div>
                        <div class="sidebar__item">
                            <h4>Size</h4>
                            <div class="sidebar__item__size">
                                <label for="large">
                                    Large
                                    <input type="radio" id="large">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="medium">
                                    Medium
                                    <input type="radio" id="medium">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="small">
                                    Small
                                    <input type="radio" id="small">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="tiny">
                                    Tiny
                                    <input type="radio" id="tiny">
                                </label>
                            </div>
                        </div>
                        <div class="sidebar__item">
                            <div class="latest-product__text">
                                <h4>Sản phẩm mới</h4>
                                <div class="latest-product__slider owl-carousel">
                                    <div class="latest-prdouct__slider__item">
                                        @foreach ($latestProducts as $product)
                                            <a href="#" class="latest-product__item">
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
                                            <a href="#" class="latest-product__item">
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
                </div> --}}
                <div class="col-lg-12 col-md-12">
                    <div class="product__discount">
                        <div class="section-title product__discount__title">
                            <h2>Giảm giá</h2>
                        </div>
                        <div class="row">
                            <div class="product__discount__slider owl-carousel">
                                @foreach ($latestProducts as $product)
                                    <div class="col-lg-4">
                                        <div class="product__discount__item">
                                            <div class="product__discount__item__pic set-bg"
                                                data-setbg="{{ asset($product->product_img) }}">
                                                <div class="product__discount__percent">-20%</div>
                                                <ul class="product__item__pic__hover">
                                                    <form action="{{ route('addproducttocart') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" value="{{ $product->id }}" name="product_id">
                                                        <input type="hidden" value="{{ $product->price }}" name="price">
                                                        <input type="hidden" value="1" name="quantity">
                                                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                                        <button type="submit" class="btn">
                                                            <i class="fa fa-shopping-cart"></i>
                                                        </button>
                                                    </form>
                                                </ul>
                                            </div>
                                            <div class="product__discount__item__text">
                                                <span>{{ $product->product_subcategory_name }}</span>
                                                <h5><a
                                                        href="{{ route('singleproduct', [$product->id, $product->slug]) }}">{{ $product->product_name }}</a>
                                                </h5>
                                                <div class="product__item__price">
                                                    <p class="formatMoney">{{ $product->price }}</p>
                                                    <span class="formatMoney">{{ $product->price }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                    <style>
                        #sort-by {
                            display: block !important;
                        }

                        .nice-select {
                            display: none !important;
                        }

                        .filter__sort {
                            display: flex;
                            gap: 1rem;
                        }
                    </style>
                    <div class="filter__item">
                        <div class="row">
                            <div class="col-lg-4 col-md-5">
                                <div class="filter__sort">
                                    {{-- <span>Sắp xếp theo</span> --}}
                                    <select id="sort-by">
                                        <option value="dafault">Sắp xếp</option>
                                        <option value="name">Tên</option>
                                        <option value="price-hightolow">Giá cao xuống thấp</option>
                                        <option value="price-lowtohigh">Giá thấp đến cao</option>
                                    </select>
                                </div>
                            </div>
                            <script>
                                $(document).ready(function() {
                                    $('#sort-by').on('change', function(e) {
                                        let sort_by = $('#sort-by').val();
                                        $.ajax({
                                            url: "{{ route('sortby') }}",
                                            method: "POST",
                                            data: {
                                                sort_by: sort_by,
                                                _token: '{{ csrf_token() }}'
                                            },
                                            dataType: 'json',
                                            success: function(data) {
                                                if (data.success) {
                                                    listProducts = data.listProducts;
                                                    $("#testdata").html("")
                                                    listProducts.forEach(product => {                                                       
                                                        var htmldata = `                                                     
                                                                        <div class="col-lg-3 col-md-6 col-sm-6">
                                                                            <div class="product__item">
                                                                                <div class="product__item__pic set-bg" style="background-image: url(&quot;${product.product_img}&quot;);"
                                                                                    data-setbg="${product.product_img}">
                                                                                    <ul class="product__item__pic__hover">
                                                                                        <form action="{{ route('addproducttocart') }}" method="POST">
                                                                                            @csrf
                                                                                            <input type="hidden" value="${product.id}" name="product_id">
                                                                                            <input type="hidden" value="${product.price}" name="price">
                                                                                            <input type="hidden" value="${1}" name="quantity">
                                                                                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                                                            <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                                                                            <button type="submit" class="btn">
                                                                                                <i class="fa fa-shopping-cart"></i>
                                                                                            </button>
                                                                                        </form>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="product__item__text">
                                                                                    <h6><a
                                                                                            href="">${product.product_name}</a>
                                                                                    </h6>
                                                                                    <h5 class="formatMoney">${product.price}</h5>
                                                                                </div>
                                                                            </div>
                                                                        </div>`;
                                                        $("#testdata").append(htmldata);
                                                    });

                                                } else {
                                                    alert("error");
                                                }

                                            }
                                        });
                                    });
                                });
                            </script>
                            <div class="col-lg-4 col-md-4">
                                <div class="filter__found">
                                    <h6><span>{{ $productCount }}</span> sản phẩm được tìm thấy</h6>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-3">
                            </div>
                        </div>
                    </div>
                    <div class="row" id="testdata">
                        @foreach ($allproducts as $product)
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="{{ asset($product->product_img) }}">
                                        <ul class="product__item__pic__hover">
                                            <form action="{{ route('addproducttocart') }}" method="POST">
                                                @csrf
                                                <input type="hidden" value="{{ $product->id }}" name="product_id">
                                                <input type="hidden" value="{{ $product->price }}" name="price">
                                                <input type="hidden" value="1" name="quantity">
                                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                                <button type="submit" class="btn">
                                                    <i class="fa fa-shopping-cart"></i>
                                                </button>
                                            </form>
                                        </ul>
                                    </div>
                                    <div class="product__item__text">
                                        <h6><a
                                                href="{{ route('singleproduct', [$product->id, $product->slug]) }}">{{ $product->product_name }}</a>
                                        </h6>
                                        <h5 class="formatMoney">{{ $product->price }}</h5>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <style></style>
                    {{-- <div class="d-flex">
                        {!! $allproducts->links() !!}
                    </div> --}}
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->
@endsection

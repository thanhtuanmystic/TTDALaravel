@extends('user_template.layouts.template')
@section('main-content')
    @php
        $categories = App\Models\Category::latest()->get();
    @endphp
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
    <style>
        .category_product {
            font-weight: 600;
        }

        .category_product:hover .subcategory_product {
            display: block;
        }

        .subcategory_product {
            padding-left: 10px;
            font-size: 14px;
            font-weight: 400;
            display: none;
        }

        .subcategory_product:hover {
            opacity: 0.8;
        }
    </style>
    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <h4>Danh mục</h4>
                            <ul>
                                <li class="category_product"><a
                                        href="{{ route('category', [$categories[2]->id, $categories[2]->slug]) }}">{{ $categories[2]->category_name }}</a>
                                    @foreach ($subcate_men as $subcategory)
                                        <div class="subcategory_product"><a
                                                href="{{ route('subcategory', [$subcategory->id, $subcategory->slug]) }}">{{ $subcategory->subcategory_name }}</a>
                                        </div>
                                    @endforeach
                                </li>
                                <li class="category_product"><a
                                        href="{{ route('category', [$categories[1]->id, $categories[1]->slug]) }}">{{ $categories[1]->category_name }}</a>
                                    @foreach ($subcate_women as $subcategory)
                                        <div class="subcategory_product"><a
                                                href="{{ route('subcategory', [$subcategory->id, $subcategory->slug]) }}">{{ $subcategory->subcategory_name }}</a>
                                        </div>
                                    @endforeach
                                </li>
                                <li class="category_product"><a
                                        href="{{ route('category', [$categories[0]->id, $categories[0]->slug]) }}">{{ $categories[0]->category_name }}</a>
                                    @foreach ($subcate_kid as $subcategory)
                                        <div class="subcategory_product"><a
                                                href="{{ route('subcategory', [$subcategory->id, $subcategory->slug]) }}">{{ $subcategory->subcategory_name }}</a>
                                        </div>
                                    @endforeach
                                </li>
                            </ul>
                        </div>
                        <form action="{{ route('categorysort') }}" method="POST">
                            @csrf
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
                                <h4>Mùa</h4>
                                <div class="">
                                    <input name="season_sort" type="radio" value="spring" id="spring_sort">
                                    <label for="spring_sort">
                                        Xuân
                                    </label>
                                </div>
                                <div class="">
                                    <input name="season_sort" type="radio" value="summer" id="summer_sort">
                                    <label for="summer_sort">
                                        Hạ
                                    </label>
                                </div>
                                <div class="">
                                    <input name="season_sort" type="radio" value="fall" id="fall_sort">
                                    <label for="fall_sort">
                                        Thu
                                    </label>
                                </div>
                                <div class="">
                                    <input name="season_sort" type="radio" value="winter" id="winter_sort">
                                    <label for="winter_sort">
                                        Đông
                                    </label>
                                </div>
                            </div>
                            <input type="hidden" name="sort_category_id" value="{{ $subcategory_->category_id }}">
                            <div class="sidebar__item">
                                <input class="btn-success" type="submit" value="Sắp xếp">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                    <h3 class="mb-4">
                        @if (isset($subcategory_))
                            {{ $subcategory_->category_name }} @if (isset($current_subcate))
                                > {{ $current_subcate }}
                            @endif
                        @endif
                    </h3>
                    <div class="row">
                        @foreach ($products as $product)
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg"
                                        data-setbg="{{ asset($product->product_img) }}">
                                        <ul class="product__item__pic__hover">
                                            <form action="{{ route('addproducttocart') }}" method="POST">
                                                @csrf
                                                <input type="hidden" value="{{ $product->id }}" name="product_id">
                                                <input type="hidden" value="{{ $product->price }}" name="price">
                                                <input type="hidden" value="1" name="quantity">
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
                                        <h5>{{ $product->price }}</h5>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                        <div class="d-flex">
                            {!! $products->links() !!}
                        </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->
@endsection

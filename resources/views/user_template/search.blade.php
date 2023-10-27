@extends('user_template.layouts.template')
@section('main-content')
    <div class="filter__item">
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <div class="filter__found">
                    <h6><span>{{ $searchProductCount }}</span> sản phẩm được tìm thấy</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach ($searchProducts as $product)
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="{{ asset($product->product_img) }}">
                        <ul class="product__item__pic__hover">
                           <form action="{{route('addproducttocart')}}" method="POST">
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
                        <h6><a href="{{ route('singleproduct', [$product->id, $product->slug]) }}">{{ $product->product_name }}</a></h6>
                        <h5>{{ $product->price }}</h5>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
    <div class="product__pagination">
        <a href="#">1</a>
        <a href="#">2</a>
        <a href="#">3</a>
        <a href="#"><i class="fa fa-long-arrow-right"></i></a>
    </div>
@endsection

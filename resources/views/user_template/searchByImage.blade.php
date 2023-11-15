@extends('user_template.layouts.template')
@section('main-content')
    <div class="searchByImageDiv">
        <form action="{{ route('searchbyimagehandle') }}" method="post" enctype="multipart/form-data">
            @csrf
            Chọn ảnh để tải lên:
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="submit" value="Tải lên" name="submit">
        </form>
    </div>
    <div class="row">
        @if (isset($search_products))
            @foreach ($search_products as $product)
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="{{ asset($product->product_img) }}">
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
        @endif

    </div>
@endsection

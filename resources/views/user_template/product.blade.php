@extends('user_template.layouts.template')
@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="box_main">
                    <div class="tshirt_img"><img src="{{ asset($product->product_img) }}"></div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="box_main">
                    <div class="product-info">
                        <h4 class="shirt_text text-left">{{ $product->product_name }}</h4>
                        <p class="price_text text-left">Price <span style="color: #262626;">$ {{ $product->price }}</span>
                        </p>
                    </div>
                    <div class="my-3 product-details">
                        <p class="lead">
                            {{ $product->product_long_des }}
                        </p>
                        <ul class="p-2 bg-light my-2">
                            <li>Category - {{ $product->product_category_name }}</li>
                            <li>Subcategory - {{ $product->product_subcategory_name }}</li>
                            <li>Available quantity - {{ $product->quantity }}</li>
                        </ul>
                    </div>
                    <div class="btn_main">
                        <form action="{{ route('addproducttocart') }}" method="POST">
                            @csrf
                            <input type="hidden" value="{{ $product->id }}" name="product_id">
                            <input type="hidden" value="{{ $product->price }}" name="price">
                            <input type="hidden" value="1" name="quantity">
                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input class="form-control" type="number" min="1" name="quantity">
                            </div>
                            <br>
                            <input type="submit" class="btn btn-warning" value="Add To Cart">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="fashion_section">
            <div id="main_slider">
                <div class="container">
                    <h1 class="fashion_taital">Related Product</h1>
                    <div class="fashion_section_2">
                        <div class="row">
                            @foreach ($related_product as $product)
                                <div class="col-lg-4 col-sm-4">
                                    <div class="box_main">
                                        <h4 class="shirt_text">{{ $product->product_name }}</h4>
                                        <p class="price_text">Price <span
                                                style="color: #262626;">{{ $product->price }}</span>
                                        </p>
                                        <div class="tshirt_img"><img src="{{ asset($product->product_img) }}">
                                        </div>
                                        <div class="btn_main">
                                            {{-- <div class="buy_bt"><a href="#">Buy Now</a></div> --}}
                                            <form action="{{ route('addproducttocart') }}" method="POST">
                                                @csrf
                                                <input type="hidden" value="{{ $product->id }}" name="product_id">
                                                <input type="hidden" value="{{ $product->price }}" name="price">
                                                <input type="hidden" value="1" name="quantity">
                                                <input type="submit" class="btn btn-warning" value="Buy Now">
                                            </form>

                                            <div class="seemore_bt"><a
                                                    href="{{ route('singleproduct', [$product->id, $product->slug]) }}">See
                                                    More</a></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

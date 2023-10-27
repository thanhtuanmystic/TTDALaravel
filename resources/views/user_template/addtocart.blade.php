@extends('user_template.layouts.template')
@section('main-content')
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('home/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Shopping Cart</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total = 0;
                                @endphp
                                @foreach ($cart_items as $item)
                                    @php
                                        $product_name = App\Models\Product::where('id', $item->product_id)->value('product_name');
                                        $img = App\Models\Product::where('id', $item->product_id)->value('product_img');
                                    @endphp
                                    <tr>
                                        <td class="shoping__cart__item">
                                            <img style="width: 4rem" src="{{ asset($img) }}" alt="">
                                            <h5>{{ $product_name }}</h5>
                                        </td>
                                        <td class="shoping__cart__price">
                                            ${{ $item->price }}
                                        </td>
                                        <td class="shoping__cart__quantity">
                                            <div class="quantity">
                                                <div class="pro-qty">
                                                    <input type="text" value="{{ $item->quantity }}">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="shoping__cart__total">
                                            ${{ $item->price }}
                                        </td>
                                        <td class="shoping__cart__item__close">
                                            <a href="{{ route('removecartitem', $item->id) }}"> <span
                                                    class="icon_close"></span></a>
                                        </td>
                                    </tr>
                                    @php
                                        $total = $total + $item->price;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="{{ route('showallproducts') }}" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                        <a href="#" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                            Upadate Cart</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Discount Codes</h5>
                            <form id="coupon_form">
                                @csrf
                                <input name="coupon_code" type="text" placeholder="Nhập mã giảm giá">
                                <button type="submit" name="coupon_code" id="coupon_code" class="site-btn">Áp dụng</button>
                            </form>
                            <div id="discount_amount"></div>
                        </div>
                    </div>
                </div>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
                <script>
                    $(document).ready(function() {
                        $('#coupon_form').on('submit', function(e) {
                            e.preventDefault();
                            var couponCode = $('#coupon_code').val();
                            $.ajax({
                                type: 'POST',
                                url: "/apply-coupon", 
                                data: {
                                    coupon_code: couponCode,
                                    _token: '{{csrf_token()}}'
                                },
                                dataType: 'json',
                                success: function(data) {
                                    if (data.success) {
                                        $('#discount_amount').text('Discount: $' + data.discount);
                                    } else {
                                        $('#discount_amount').text('Invalid or expired coupon code.');
                                    }
                                }
                            });
                        });
                    });
                </script>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
                            {{-- <li>Subtotal <span>$454.98</span></li> --}}
                            <li>Total <span>${{ $total }}</span></li>
                            <li>Giảm giá <span>100</span></li>
                        </ul>
                        <form action="{{ route('gotocheckout') }}" method="POST">
                            @csrf
                            <input class="primary-btn" type="submit" value="Đặt hàng">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->
@endsection

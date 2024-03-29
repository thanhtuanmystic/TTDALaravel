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
                                    <th class="shoping__product">Sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Tổng tiền</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total = 0;
                                    $toal_pay = 0;
                                @endphp
                                @foreach ($cart_items as $item)
                                    @php
                                        $product_name = App\Models\Product::where('id', $item->product_id)->value('product_name');
                                        $img = App\Models\Product::where('id', $item->product_id)->value('product_img');
                                        $product_price = App\Models\Product::where('id', $item->product_id)->first();
                                    @endphp
                                    <tr>
                                        <td class="shoping__cart__item">
                                            <img style="width: 4rem" src="{{ asset($img) }}" alt="">
                                            <h5>{{ $product_name }}</h5>
                                        </td>
                                        <td class="shoping__cart__price">
                                            <span class="formatMoney">{{ $product_price->price }}</span>
                                        </td>
                                        <td class="shoping__cart__quantity">
                                            <div class="quantity">
                                                <div>
                                                    {{ $item->quantity }}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="shoping__cart__total">
                                            <span class="formatMoney">{{ $item->price }}</span>
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
                        <a href="{{ route('showallproducts') }}" class="primary-btn cart-btn">Tiếp tục mua hàng</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Mã giảm giá</h5>
                            <form id="coupon_form">
                                @csrf
                                <input name="coupon_code" id="coupon_code" type="text" placeholder="Nhập mã giảm giá">
                                <button type="submit" name="coupon_code" id="coupon_code" class="site-btn">Áp dụng</button>
                            </form>
                            <p id="error_discount_code"></p>
                        </div>
                    </div>
                </div>
                <script>
                    $(document).ready(function() {
                        $('#coupon_form').on('submit', function(e) {
                            e.preventDefault();
                            var couponCode = $('#coupon_code').val();
                            var tongtien = {{ $total }};
                            var tongthanhtoan = 0;
                            $.ajax({
                                type: 'POST',
                                url: "/apply-coupon",
                                data: {
                                    coupon_code: couponCode,
                                    _token: '{{ csrf_token() }}'
                                },
                                dataType: 'json',
                                success: function(data) {
                                    if (data.success) {
                                        $('#discount_amount').text(data.discount);
                                        $("#discount_amount_hidden").val(data.discount);
                                        tongthanhtoan = tongtien - parseInt(data.discount);
                                        $('#total_final_hidden').val(tongthanhtoan);
                                        $('#total_pay').text(tongthanhtoan);
                                        $('#error_discount_code').text(
                                            "");
                                    } else {
                                        $('#error_discount_code').text(
                                            "Mã giảm giá không tồn tại hoặc đã hết hạn!");
                                        $('#discount_amount').text(0);
                                        $('#total_pay').text(tongtien);
                                    }

                                }
                            });
                        });
                    });
                </script>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Giỏ hàng</h5>
                        <form action="{{ route('gotocheckout') }}" method="POST">
                            @csrf
                            <ul>
                                {{-- <li>Subtotal <span>$454.98</span></li> --}}
                                <input id="discount_amount_hidden" type="hidden" name="discount_amount_hidden"
                                    value="0">
                                <input id="total_hidden" type="hidden" name="total_hidden" value="{{ $total }}">
                                <input id="total_final_hidden" type="hidden" name="total_final_hidden"
                                    value="{{ $total }}">
                                <li>Tổng tiền hàng <span class="formatMoney">{{ $total }}</span></li>
                                <li>Giảm giá <span class="formatMoney" id="discount_amount">0</span></li>
                                <li>Tổng thanh toán <span class="formatMoney" id="total_pay">{{ $total }}</span>
                                </li>
                            </ul>
                            @php
                                $productCount = App\Models\Cart::count();
                            @endphp
                            @if ($productCount == 0)
                                <p>Không có sản phẩm trong giỏ hàng, hãy tiếp tục mua sắm</p>
                                <input disabled type="submit" value="Đặt hàng">
                            @else
                                <input class="site-btn" type="submit" value="Đặt hàng">
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->
@endsection

@extends('user_template.layouts.template')
@section('main-content')
    <!-- Breadcrumb Section Begin -->
    {{-- <section class="breadcrumb-section set-bg" data-setbg="{{ asset('home/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Checkout</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Checkout</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <h4>Billing Details</h4>
                <form action="{{route('placeorder')}}" id="checkout_info" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="checkout__input">
                                <p>Họ và tên<span>*</span></p>
                                <input required type="text" id="fullname" name="fullname">
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Số điện thoại<span>*</span></p>
                                        <input required type="text" id="phone_number" name="phone_number">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input required type="text" id="email" name="email">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input required type="text" id="address" name="address">
                            </div>
                            <div class="checkout__input">
                                <p>Quận/ Huyện<span>*</span></p>
                                <input required type="text" id="district" name="district">
                            </div>
                            <div class="checkout__input">
                                <p>Tỉnh/ Thành Phố<span>*</span></p>
                                <input required type="text" id="city" name="city">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>Đơn hàng của bạn</h4>
                                <div class="checkout__order__products">Tên sản phẩm <span>Giá tiền</span></div>
                                <ul>
                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach ($cart_items as $item)
                                        @php
                                            $product_name = App\Models\Product::where('id', $item->product_id)->value('product_name');
                                        @endphp
                                        <li>{{ $product_name }} <span>${{ $item->price }}</span></li>
                                        @php
                                            $total = $total + $item->price;
                                        @endphp
                                    @endforeach
                                </ul>

                                {{-- <div class="checkout__order__subtotal">Subtotal <span>$750.99</span></div> --}}
                                <div class="checkout__order__total">Tổng tiền hàng <span>{{ $total }}</span></div>
                                <div class="checkout__order__total">Giảm giá <span>{{ $discount_amount }}</span></div>
                                <input type="hidden" name="total_final_checkout" value="{{ $totalFinal }}">
                                <div class="checkout__order__total">Phí giao hàng: <span>{{ $shipping_fee }}</span></div>
                                <input type="hidden" name="shipping_fee_checkout" value="{{ $shipping_fee }}">
                                <div class="checkout__order__total">Tổng thanh toán <span>{{ $totalFinal }}</span></div>
                                <div>Phương thức thanh toán</div>
                                <button type="submit" id="code_btn" name="button" value="placeorder">COD</button>
                                <button type="submit" id="vnpay_btn" name="button" value="vnpay">VNPAY</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
  
    {{-- <form action="{{ route('vnpaypayment') }}" method="POST">
        @csrf
        <input type="submit" value="Thanh toán vnpay" name="redirect">
        <input type="hidden" name="vnpay_totalFinal" value="{{ $totalFinal }}">
    </form> --}}
    <!-- Checkout Section End -->
@endsection

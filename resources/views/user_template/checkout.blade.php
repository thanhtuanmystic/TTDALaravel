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
                <form id="checkout_info" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="checkout__input">
                                <p>Họ và tên<span>*</span></p>
                                <input required type="text" name="fullname">
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Số điện thoại<span>*</span></p>
                                        <input required type="text" name="phone_number">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input required type="text" name="email">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input required type="text" name="address">
                            </div>
                            <div class="checkout__input">
                                <p>Quận/ Huyện<span>*</span></p>
                                <input required type="text" name="district">
                            </div>
                            <div class="checkout__input">
                                <p>Tỉnh/ Thành Phố<span>*</span></p>
                                <input required type="text" name="city">
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
                                <div class="checkout__input__checkbox">
                                    <label for="payment">
                                        Check Payment
                                        <input type="checkbox" id="payment">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="checkout__input__checkbox">
                                    <label for="paypal">
                                        Paypal
                                        <input type="checkbox" id="paypal">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <input id="testvn" type="button" name="redirect" value="test vn">
                                <script>
                                    $('#testvn').on('click', function() {
                                        // let form = document.createElement('form');
                                        // form.setAttribute('method', 'POST');
                                        // form.setAttribute('action', '{{ route('vnpaypayment') }}');
                                        // document.body.appendChild(form);
                                        // // Thêm input ẩn chứa giá trị CSRF token
                                        // let csrfToken = document.createElement('input');
                                        // csrfToken.setAttribute('type', 'hidden');
                                        // csrfToken.setAttribute('name', '_token');
                                        // csrfToken.setAttribute('value',
                                        //     '{{ csrf_token() }}'); // Sử dụng blade template để lấy giá trị CSRF token
                                        // form.appendChild(csrfToken);
                                        // let redirect_input = document.createElement('input');
                                        // redirect_input.setAttribute('name', 'redirect');
                                        // form.appendChild(redirect_input);
                                        // let vnpay_totalFinal = document.createElement('input');
                                        // vnpay_totalFinal.setAttribute('name', 'vnpay_totalFinal')
                                        // vnpay_totalFinal.setAttribute('value', {{ $totalFinal }})
                                        // form.appendChild(vnpay_totalFinal);
                                        // form.submit();
                                        alert(1);

                                        $("#checkout_info").setAttribute('action', '{{ route('vnpaypayment') }}');
                                        $("#checkout_info").submit();
                                    })
                                </script>
                                {{-- <input type="submit" class="site-btn" value="Place Order"> --}}
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <form action="{{ route('vnpaypayment') }}" method="POST">
        @csrf
        <input type="submit" value="Thanh toán vnpay" name="redirect">
        <input type="hidden" name="vnpay_totalFinal" value="{{ $totalFinal }}">
    </form>
    <!-- Checkout Section End -->
@endsection

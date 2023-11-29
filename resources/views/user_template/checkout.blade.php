@extends('user_template.layouts.template')
@section('main-content')
    <style>
        .nice-select {
            display: none !important;
        }

        select {
            display: block !important;
        }
    </style>
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <h4>Thông tin thanh toán</h4>
                <form action="{{ route('placeorder') }}" id="checkout_info" method="POST">
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
                            <style>
                                #province,
                                #district,
                                #ward {
                                    width: 100%;
                                    height: 46px;
                                    border: 1px solid #ebebeb;
                                    padding-left: 20px;
                                    font-size: 16px;
                                    border-radius: 4px;
                                }
                            </style>
                            <div class="checkout__input">
                                <p>Tỉnh/ Thành Phố<span>*</span></p>
                                <select name="city" id="province"></select>
                                <input type="hidden" id="province_value" name="province_value" value="">
                            </div>
                            <div class="checkout__input">
                                <p>Quận/ Huyện<span>*</span></p>
                                <select name="district" id="district">
                                    <option value="">Chọn quận/ huyện</option>
                                    <input type="hidden" id="district_value" name="district_value" value="">

                                </select>
                            </div>
                            <div class="checkout__input">
                                <p>Phường/ xã<span>*</span></p>
                                <select name="address" id="ward">
                                    <option value="">Chọn phường/ xã</option>
                                    <input type="hidden" id="ward_value" name="ward_value" value="">

                                </select>
                            </div>


                            <div>
                                *Ghi chú: Với phương thức thanh toán là <b>Chuyển khoản ngân hàng</b> <br> Quý khách vui
                                lòng chuyển khoản vào stk sau: <br>
                                1. 102870677510 - Vietinbank - Triệu Thanh Tuấn <br>
                                2. 0354202904 - MB Bank - Triệu Thanh Tuấn
                                <br>
                                Nội dung: Tên + Số điện thoại
                                <br>
                                Dream Clothing sẽ liên hệ để xác nhận đơn hàng của bạn trong vòng 24h
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>Đơn hàng của bạn</h4>
                                <div class="checkout__order__products">Tên sản phẩm </div>
                                <ul>
                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach ($cart_items as $item)
                                        @php
                                            $product_name = App\Models\Product::where('id', $item->product_id)->value('product_name');
                                        @endphp
                                        <li>{{ $product_name }}</li>
                                        <li class="formatMoney">{{ $item->price }}</li>
                                        @php
                                            $total = $total + $item->price;
                                        @endphp
                                    @endforeach
                                </ul>

                                {{-- <div class="checkout__order__subtotal">Subtotal <span>$750.99</span></div> --}}
                                <div class="checkout__order__total">Tổng tiền hàng <span
                                        class="formatMoney">{{ $total }}</span></div>
                                <div class="checkout__order__total">Giảm giá <span
                                        class="formatMoney">{{ $discount_amount }}</span></div>
                                <input type="hidden" name="total_final_checkout" value="{{ $totalFinal }}">
                                <div class="checkout__order__total">Phí giao hàng: <span
                                        class="formatMoney">{{ $shipping_fee }}</span></div>
                                <input type="hidden" name="shipping_fee_checkout" value="{{ $shipping_fee }}">
                                <div class="checkout__order__total">Tổng thanh toán <span
                                        class="formatMoney">{{ $totalFinal }}</span></div>
                                <div>Phương thức thanh toán</div>
                                <button type="submit" id="code_btn" name="button" value="placeorder">COD</button>
                                <button type="submit" id="vnpay_btn" name="button" value="vnpay">VNPAY</button>
                                <button type="submit" id="banking_btn" name="button" value="banking">Chuyển khoản</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.1/axios.min.js"
        integrity="sha512-bPh3uwgU5qEMipS/VOmRqynnMXGGSRv+72H/N260MQeXZIK4PG48401Bsby9Nq5P5fz7hy5UGNmC/W1Z51h2GQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('home/js/provinceAPI.js') }}"></script>
@endsection

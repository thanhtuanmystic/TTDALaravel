@extends('user_template.layouts.user_profile_template')
@section('profilecontent')
    <style>
        .user-form-group {
            display: flex;
            gap: 20px;
        }

        .order-history {
            margin-top: 40px;
        }

        .user-table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
        li {
            list-style-type: none;
        }
    </style>
    <div class="container">
        <h2 class="mb-4 text-center">TRANG CỦA TÔI</h2>
        <form>
            <h3 class="mb-4">Thông tin tài khoản:</h3>
            <div class="user-form-group">
                <label for="fullName">Họ tên:</label>
                <p class="form-control-static" id="fullName">{{ $userProfile->name }}</p>
            </div>
            <div class="user-form-group">
                <label for="email">Email:</label>
                <p class="form-control-static" id="email">{{ $userProfile->email }}</p>
            </div>
        </form>
        <div class="customer-ranking">
            <h3 class="mb-4">Xếp hạng thành viên:</h3>
            <h4>{{$rank}}</h4>
            <p>Bạn sẽ tăng hạng thành viên khi mua thêm 100000</p>
        </div>

        <div class="cart-body">
            <h3 class="mb-4">Đơn hàng đã mua:</h3>
            <table class="table">
                <tr>
                    <th>Sản phẩm - Số lượng</th>
                    <th>Thanh toán</th>
                    <th>Phí ship</th>
                    <th>Tổng tiền</th>
                </tr>
                @if ($orders->isNotEmpty())
                    @foreach ($orders as $order)
                        <tr>
                            <td>
                                @if ($order->products->isNotEmpty())
                                    @foreach ($order->products as $product)
                                        @php
                                            $quantity = DB::table('order_product')
                                                ->where('product_id', $product->id)
                                                ->where('order_id', $order->id)
                                                ->value('quantity');
                                        @endphp
                                        <ul>
                                            <li>{{ $product->product_name }} - SL: {{ $quantity }}</li>
                                        </ul>
                                    @endforeach
                                @endif
                            </td>

                            <td>{{ $order->payment_method }}</td>
                            <td> {{ $order->shipping_fee }}</td>
                            <td> {{ $order->total_price }}</td>

                        </tr>
                    @endforeach
                @endif

            </table>
        </div>
    </div>

@endsection

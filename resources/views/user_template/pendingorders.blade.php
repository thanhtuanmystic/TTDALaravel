@extends('user_template.layouts.user_profile_template')
@section('profilecontent')
    <h2>Đơn hàng đang chờ</h2>
    <style>
        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        ul,
        li {
            list-style: none;
        }
    </style>
    <div class="cart-body">
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
@endsection

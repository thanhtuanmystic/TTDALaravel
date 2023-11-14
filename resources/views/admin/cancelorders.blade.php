@extends('admin.layouts.template')
@section('page_title')
   Đơn hàng đã hủy
@endsection
@section('content')
    <div class="container my-5">
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <div class="card p-4">
            <div class="card-title">
                <h2 class="text-center">Đơn hàng đã hủy</h2>
            </div>
            <div class="cart-body">
                <table class="table">
                    <tr>
                        <th>Order Id</th>
                        <th>Thông tin giao hàng</th>
                        <th>Sản phẩm - Số lượng</th>

                        <th>Tổng tiền</th>
                        <th>Thanh toán</th>
                        <th>Phí ship</th>
                        <th>Trạng thái</th>
                    </tr>
                    @if ($orders->isNotEmpty())
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>
                                    <ul>
                                        <li>Họ tên: {{ $order->shipping_fullname }}</li>
                                        <li>Email: {{ $order->shipping_email }}</li>
                                        <li>SĐT: {{ $order->shipping_phoneNumber }}</li>
                                        <li>Địa chỉ: {{ $order->shipping_address }}</li>
                                        <li>Quận/Huyện: {{ $order->shipping_district }}</li>
                                        <li>Tỉnh/Thành phố: {{ $order->shipping_city }}</li>
                                    </ul>
                                </td>
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
                                <td> {{ $order->total_price }}</td>                               
                                <td>{{ $order->payment_method }}</td>
                                <td> {{ $order->shipping_fee }}</td>
                                <td>{{ $order->status }}</td>
                               
                            </tr>
                        @endforeach
                    @endif

                </table>
            </div>
        </div>
    </div>
@endsection

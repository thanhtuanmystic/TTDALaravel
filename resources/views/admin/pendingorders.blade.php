@extends('admin.layouts.template')
@section('page_title')
    Pending orders
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
                <h2 class="text-center">Pending Orders</h2>
            </div>
            @if ($orders->isNotEmpty())
                @foreach ($orders as $order)
                    <h2>Order ID: {{ $order->id }}</h2>
                    @if ($order->products->isNotEmpty())
                        <ul>
                            @foreach ($order->products as $product)
                                @php
                                    $quantity = DB::table('order_product')
                                        ->where('product_id', $product->id)
                                        ->where('order_id', $order->id)
                                        ->value('quantity');
                                @endphp
                                <li>
                                    Tên sản phẩm: {{ $product->product_name }} -
                                    Giá sản phẩm: {{ $product->price }} -
                                    Số lượng: {{ $quantity }}
                                </li>
                            @endforeach
                        </ul>
                        <ul>
                            <h4>Thông tin giao hàng</h4>
                            <ul>
                                <li>Họ tên: {{ $order->shipping_fullname }} </li>
                                <li>Số điện thoại: {{ $order->shipping_phoneNumber }} </li>
                                <li>Email: {{ $order->shipping_email }} </li>
                                <li>Địa chỉ: {{ $order->shipping_address }} </li>
                                <li>Huyện: {{ $order->shipping_district }} </li>
                                <li>Tỉnh: {{ $order->shipping_city }} </li>
                                <li>Tổng tiền dự kiến: </li>
                                <li>Mã khuyến mãi: </li>
                                <li>Tổng tiền hàng: {{ $order->total_price }}</li>
                            </ul>
                        </ul>
                    @else
                        <p>No products found in this order.</p>
                    @endif
                @endforeach
            @else
                <p>No orders found.</p>
            @endif
            <div class="cart-body">
                <table class="table">
                    <tr>
                        <th>Order Id</th>
                        <th>Thông tin giao hàng</th>
                        <th>Product Id</th>
                        <th>Số lượng</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($pending_orders as $order)
                        <tr>
                            <td>{{ $order->userid }}</td>
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
                            <td>{{ $order->product_id }}</td>
                            <td>{{ $order->quantity }}</td>
                            <td>{{ $order->total_price }}</td>
                            <td>{{ $order->status }}</td>
                            <td>
                                <form action="{{ route('changestatus') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="changestatus" value="{{ $order->id }}">
                                    <button type="submit" class="btn btn-success">Approve Now</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection

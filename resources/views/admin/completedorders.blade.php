@extends('admin.layouts.template')
@section('page_title')
    Completed Orders
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
                <h2 class="text-center">Completed Orders</h2>
            </div>
            <div class="cart-body">
                <table class="table">
                    <tr>
                        <th>User Id</th>
                        <th>Thông tin giao hàng</th>
                        <th>Product Id</th>
                        <th>Số lượng</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                    </tr>
                    @foreach ($completed_orders as $order)
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
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection

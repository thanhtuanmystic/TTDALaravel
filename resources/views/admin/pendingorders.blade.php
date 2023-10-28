@extends('admin.layouts.template')
@section('page_title')
    Pending orders
@endsection
@section('content')
    <div class="container my-5">
        <div class="card p-4">
            <div class="card-title">
                <h2 class="text-center">Pending Orders</h2>
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
                                <a href="" class="btn btn-success">Approve Now</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection

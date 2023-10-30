@extends('user_template.layouts.user_profile_template')
@section('profilecontent')
    <h1>Pending Orders</h1>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    <table class="table">
        <tr>            
            <th>Tên sản phẩm</th>
            <th>Ảnh sản phẩm</th>
            <th>Price</th>
        </tr>
        @foreach ($pending_orders as $order)
            @php
                $product_name = App\Models\Product::where('id', $order->product_id)->value('product_name');
                $img = App\Models\Product::where('id', $order->product_id)->value('product_img');
            @endphp
            <tr>
                
                <td>
                    {{ $product_name }}
                </td>
                <td>
                   <img src=" {{ asset($img) }}" alt="">
                </td>
                <td>
                    {{ $order->total_price }}
                </td>
            </tr>
        @endforeach
    </table>
@endsection

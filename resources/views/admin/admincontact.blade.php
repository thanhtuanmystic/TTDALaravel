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
                <h2 class="text-center">Ý kiến từ khách hàng</h2>
            </div>
            <div class="cart-body">
                <table class="table">
                    <tr>
                        <th>Id</th>
                        <th>Tên khách hàng</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th>Lời nhắn</th>
                    </tr>
                    <tr>
                        @foreach ($contact_data as $data)
                        <td>{{$data->id}}</td>
                        <td>{{$data->name}}</td>
                        <td>{{$data->phone}}</td>
                        <td>{{$data->email}}</td>
                        <td style="max-width: 500px">{{$data->message}}</td>                        
                        @endforeach
                    </tr>


                </table>
            </div>
        </div>
    </div>
@endsection

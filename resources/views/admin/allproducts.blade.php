@extends('admin.layouts.template')
@section('page_title')
    Tất cả sản phẩm
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Tất cả sản phẩm</h4>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <div class="card">
            <h5 class="card-header">Thông tin tất cả sản phẩm</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th>Id</th>
                            <th>Tên sản phẩm</th>
                            <th>Ảnh</th>
                            <th>Giá</th>
                            <th>Thao tác</th>                           
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->product_name }}</td>
                                <td>
                                    <img style="height: 100px" src="{{ asset($product->product_img) }}" alt="">
                                    <br>
                                    <a href="{{ route('editproductimg', $product->id) }}" class="btn btn-primary">Sửa hình
                                        ảnh
                                    </a>
                                </td>
                                <td>{{ $product->price }}</td>
                                <td>
                                    <a href="{{ route('editproduct', $product->id) }}" class="btn btn-primary">Sửa</a>
                                    <a href="{{ route('deleteproduct', $product->id) }}" class="btn btn-warning">Xóa</a>
                                </td>
                               
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

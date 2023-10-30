@extends('admin.layouts.template')
@section('page_title')
    Mã giảm giá
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Mã giảm giá</h4>
        <div class="card">
            <h5 class="card-header">Tất cả mã giảm giá</h5>
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th>Id</th>
                            <th>Tên mã giảm giá</th>
                            <th>Số tiền giảm</th>
                            <th>Ngày hết hạn</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($coupons as $coupon)
                            <tr>
                                <td>{{ $coupon->id }}</td>
                                <td>{{ $coupon->code }}</td>
                                <td>{{ $coupon->discount }}</td>
                                <td>{{ $coupon->valid_until }}</td>
                                <td>
                                    <a href="{{ route('editcoupon', $coupon->id) }}" class="btn btn-primary">Sửa</a>
                                    <a href="{{ route('deletecoupon', $coupon->id) }}" class="btn btn-warning">Xóa</a>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

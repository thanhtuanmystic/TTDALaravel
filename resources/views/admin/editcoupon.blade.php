@extends('admin.layouts.template')
@section('page_title')
    Cập nhật mã giảm giá
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Cập nhật mã giảm giá</h4>
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Cập nhật mã giảm giá</h5>
                    <small class="text-muted float-end">Input information</small>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('updatecoupon') }}" method="POST">
                        @csrf
                        <input type="hidden" value="{{ $coupon_info->id }}" name="coupon_id" id="coupon_id">
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Tên mã giảm giá</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="coupon_code" id="coupon_code"
                                    value="{{ $coupon_info->code }}" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Số tiền giảm</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="coupon_discount" id="coupon_discount"
                                    value="{{ $coupon_info->discount }}" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Ngày hết hạn</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" name="coupon_expired" id="coupon_expired" />
                            </div>
                        </div>

                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Cập nhật mã giảm giá</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('admin.layouts.template')
@section('page_title')
    Cập nhật sản phẩm
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Cập nhật sản phẩm</h4>
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Cập nhật sản phẩm</h5>
                    <small class="text-muted float-end">Input information</small>
                </div>
                <div class="card-body">
                    <form action="{{ route('updateproduct') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{ $productinfo->id }}" name="id">
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Tên sản phẩm</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="product_name" id="product_name"
                                    placeholder="Electronics" value="{{ $productinfo->product_name }}" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Giá</label>
                            <div class="col-sm-10">
                                <input value="{{ $productinfo->price }}" type="number" class="form-control" name="price"
                                    id="price" placeholder="12" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Số lượng</label>
                            <div class="col-sm-10">
                                <input value="{{ $productinfo->quantity }}" type="number" class="form-control"
                                    name="quantity" id="quantity" placeholder="12" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Mô tả ngắn</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="product_short_des" id="product_short_des" cols="30" rows="10">
                                    {{ $productinfo->product_short_des }}
                                </textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Mô tả chi tiết</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="product_long_des" id="product_long_des" cols="30" rows="10">
                                    {{ $productinfo->product_long_des }}
                                </textarea>
                            </div>
                        </div>

                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

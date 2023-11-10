@extends('admin.layouts.template')
@section('page_title')
    Thêm sản phẩm
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Thêm sản phẩm</h4>
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0"> Thêm sản phẩm</h5>
                    <small class="text-muted float-end">Input information</small>
                </div>
                <div class="card-body">
                    <form action="{{ route('storeproduct') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Tên sản phẩm</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="product_name" id="product_name"
                                    placeholder="Áo thun mùa đông" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Giá sản phẩm</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="price" id="price"
                                    placeholder="120000" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Số lượng</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="quantity" id="quantity"
                                    placeholder="12" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Mô tả ngắn</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="product_short_des" id="product_short_des" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Mô tả chi tiết</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="product_long_des" id="product_long_des" cols="30" rows="10"></textarea>
                            </div>
                        </div>



                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Chọn danh mục</label>
                            <div class="col-sm-10">
                                <select class="form-select" id="product_category_id" name="product_category_id"
                                    aria-label="Default select example">
                                    <option selected>Chọn danh mục sản phẩm</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Chọn danh mục con</label>
                            <div class="col-sm-10">
                                <select class="form-select" id="product_subcategory_id" name="product_subcategory_id"
                                    aria-label="Default select example">
                                    <option selected>Chọn danh mục con sản phẩm</option>
                                    @foreach ($subcategories as $subcategory)
                                        <option value="{{ $subcategory->id }}">{{ $subcategory->subcategory_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Chọn mùa</label>
                            <div class="col-sm-10">
                                <select class="form-select" id="season" name="season"
                                    aria-label="Default select example">
                                    <option selected>Chọn mùa</option>
                                    <option value="spring">Xuân</option>
                                    <option value="summer">Hạ</option>
                                    <option value="fall">Thu</option>
                                    <option value="winter">Đông</option>
                                </select>
                            </div>
                        </div>
                        {{-- black, beige(màu be),blue, brown, gold, green,  grey, navyblue, olive, orange, peach, pink, purple, red, silver, white, yellow --}}
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Ảnh sản phẩm</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="file" name="product_img" id="product_img" />
                            </div>
                        </div>

                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

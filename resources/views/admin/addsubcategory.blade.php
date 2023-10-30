@extends('admin.layouts.template')
@section('page_title')
    Thêm danh mục con
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span>Thêm danh mục con</h4>
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Thêm danh mục con</h5>
                    <small class="text-muted float-end">Input information</small>
                </div>
                <div class="card-body">
                    <form action="{{route('storesubcategory')}}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Tên danh mục con</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="subcategory_name" id="subcategory_name"
                                    placeholder="Electronics" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Chọn danh mục</label>
                            <div class="col-sm-10">
                                <select class="form-select" id="category_id" name="category_id"
                                    aria-label="Default select example">
                                    <option selected>Chọn danh mục</option>
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{ $category->category_name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Thêm danh mục con</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

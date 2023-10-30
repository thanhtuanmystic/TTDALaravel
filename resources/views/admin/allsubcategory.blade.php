@extends('admin.layouts.template')
@section('page_title')
    Tất cả danh mục con
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Tất cả danh mục con</h4>
        <div class="card">
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
            <h5 class="card-header">Tất cả danh mục con</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th>Id</th>
                            <th>Tên danh mục con</th>
                            <th>Thuộc danh mục</th>
                            <th>Sản phẩm</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($allsubcategories as $subcategory)
                            <tr>
                                <td>{{ $subcategory->id }}</td>
                                <td>{{ $subcategory->subcategory_name }}</td>
                                <td>{{ $subcategory->category_name }}</td>
                                <td>{{ $subcategory->product_count }}</td>
                                <td>
                                    <a href="{{ route('editsubcategory', $subcategory->id) }}"
                                        class="btn btn-primary">Sửa</a>
                                    <a href="{{ route('deletesubcategory', $subcategory->id) }}"
                                        class="btn btn-warning">Xóa</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

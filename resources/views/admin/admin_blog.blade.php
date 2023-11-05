@extends('admin.layouts.template')
@section('page_title')
    Bài viết
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Tất cả bài viết</h4>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <div class="card">
            <h5 class="card-header">Thông tin tất cả bài viết</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th>Id</th>
                            <th>Tên bài viết</th>
                            <th>Mô tả nội dung</th>
                            <th>Nội dung chính</th>
                            <th>Hình ảnh</th>
                            <th>Tác giả</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($blogs as $blog)
                            <tr>
                                <td>{{ $blog->id }}</td>
                                <td>{{ $blog->blog_title }}</td>
                                <td>{{ $blog->blog_description }}</td>
                                <td style="max-width: 100px;overflow: hidden">{{ $blog->blog_content }}</td>
                                <td>
                                    <img style="height: 100px" src="{{ asset($blog->blog_image) }}" alt="">
                                    <br>
                                    {{-- <a href="{{ route('editproductimg', $product->id) }}" class="btn btn-primary">Sửa hình ảnh
                                        </a> --}}
                                </td>
                                <td>{{ $blog->blog_author }}</td>
                                <td>
                                    <a href="{{ route('editblog', $blog->id) }}" class="btn btn-primary">Sửa</a>
                                    <a href="{{ route('deleteblog', $blog->id) }}" class="btn btn-warning">Xóa</a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

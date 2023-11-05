@extends('admin.layouts.template')
@section('page_title')
    Cập nhật bài viết
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Cập nhật bài viết </h4>
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Cập nhật bài viết </h5>
                    <small class="text-muted float-end">Input information</small>
                </div>
                <div class="card-body">
                    <form action="{{ route('updateblog') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{ $blogInfo->id }}" name="id">
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Tiêu đề bài viết</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="blog_title" id="blog_title"
                                    value="{{ $blogInfo->blog_title }}" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Mô tả bài viết</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="blog_description" id="blog_description"
                                    value="{{ $blogInfo->blog_description }}" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Nội dung bài viết</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="blog_content" id="blog_content_ckeditor_editblog"></textarea>
                            </div>
                        </div>
                        {{-- <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Ảnh mô tả</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="blog_title" id="blog_title"
                                    value="{{ $blogInfo->blog_title }}" />
                            </div>
                        </div>                        --}}
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Tác giả</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="blog_author" id="blog_author"
                                    value="{{ $blogInfo->blog_author }}" />
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Cập nhật bài viết</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

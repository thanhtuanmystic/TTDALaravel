@extends('admin.layouts.template')
@section('page_title')
    Thêm bài viết
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"></span> Thêm bài viết</h4>
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0"> Thêm bài viết</h5>
                    <small class="text-muted float-end">Input information</small>
                </div>
                <div class="card-body">
                    <form action="{{ route('storeblog') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Tiêu đề bài viết</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="blog_title" id="blog_title"
                                    placeholder="" />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Mô tả bài viết</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="blog_description" id="blog_description"
                                    placeholder="" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Nội dung bài viết</label>
                            <div class="col-sm-10">

                                <textarea class="form-control" name="blog_content" id="blog_content_ckeditor_addblog"></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Ảnh mô tả</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="file" name="blog_image" id="blog_image" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-name">Tác giả</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="blog_author" id="blog_author"
                                    placeholder="" />
                            </div>
                        </div>

                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Thêm bài viết</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

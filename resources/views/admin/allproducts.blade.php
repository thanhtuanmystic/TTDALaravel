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
                            <th style="display: flex; gap: 1rem; align-items: center">Tên sản phẩm
                                <form action="{{route('adminsortproduct')}}" method="GET">
                                    <select id="admin_sort_product" name="admin_sort_product" onchange="this.form.submit()">
                                        <option value="default">Sắp xếp theo</option>
                                        <option value="name">Tên</option>
                                        <option value="price-hightolow">Giá cao xuống thấp</option>
                                        <option value="price-lowtohigh">Giá thếp đến cao</option>
                                    </select>
                                </form>
                                <input type="text" id="adminsearch" name="adminsearch" placeholder="Nhập tên sản phẩm...">
                            </th>
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
            <div class="pagination-part">
                {!! $products->links() !!}
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script type="text/javascript">
        $('#adminsearch').on('keyup',function(){
            $value = $(this).val();
            $.ajax({
                type: 'get',
                url: '{{ route('adminsearch') }}',
                data: {
                    'adminsearch': $value
                },
                success:function(data){
                    $('tbody').html(data);
                }
            });
            $('.pagination-part').css('display', 'none');
        })
        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
    </script>
@endsection

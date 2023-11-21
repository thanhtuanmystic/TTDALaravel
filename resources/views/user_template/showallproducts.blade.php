@extends('user_template.layouts.template')
@section('main-content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('home/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <div class="breadcrumb__option">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">               
                <div class="col-lg-12 col-md-12">
                    <div class="product__discount">
                        <div class="section-title product__discount__title">
                            <h2>Giảm giá</h2>
                        </div>
                        <div class="row">
                            <div class="product__discount__slider owl-carousel">
                                @foreach ($saleoffProducts as $product)
                                    <div class="col-lg-4">
                                        <div class="product__discount__item">
                                            <div class="product__discount__item__pic set-bg"
                                                data-setbg="{{ asset($product->product_img) }}">
                                                <div class="product__discount__percent">-30%</div>
                                                <ul class="product__item__pic__hover">
                                                    <form action="{{ route('addproducttocart') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" value="{{ $product->id }}" name="product_id">
                                                        <input type="hidden" value="{{ $product->price }}" name="price">
                                                        <input type="hidden" value="1" name="quantity">
                                                        <button type="submit" class="btn">
                                                            <i class="fa fa-shopping-cart"></i>
                                                        </button>
                                                    </form>
                                                </ul>
                                            </div>
                                            <div class="product__discount__item__text">
                                                <span>{{ $product->product_subcategory_name }}</span>
                                                <h5><a
                                                        href="{{ route('singleproduct', [$product->id, $product->slug]) }}">{{ $product->product_name }}</a>
                                                </h5>
                                                <div class="product__item__price">
                                                    <p class="formatMoney">{{ $product->price }}</p>
                                                    <span class="formatMoney">{{ $product->price }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                    <style>
                        #sort-by {
                            display: block !important;
                        }

                        .nice-select {
                            display: none !important;
                        }

                        .filter__sort {
                            display: flex;
                            gap: 1rem;
                        }
                    </style>
                    <div class="filter__item">
                        <form action="{{ route('sortby') }}" method="GET">
                            <div class="row">
                                <div class="col-lg-4 col-md-5">
                                    <div class="filter__sort">
                                        <select id="sort-by" name="sort_by" onchange="this.form.submit()">
                                            <option value="default">Lọc theo</option>
                                            <option value="name">Tên</option>
                                            <option value="price-hightolow">Giá cao xuống thấp</option>
                                            <option value="price-lowtohigh">Giá thấp đến cao</option>
                                        </select>
                                    </div>

                                </div>
                                {{-- <script>
                                $(document).ready(function() {
                                    $('#sort-by').on('change', function(e) {
                                        let sort_by = $('#sort-by').val();
                                        $.ajax({
                                            url: "{{ route('sortby') }}",
                                            method: "POST",
                                            data: {
                                                sort_by: sort_by,
                                                _token: '{{ csrf_token() }}'
                                            },
                                            dataType: 'json',
                                            success: function(data) {
                                                if (data.success) {
                                                    listProducts = data.listProducts;
                                                    $("#testdata").html("")
                                                    listProducts.forEach(product => {                                                       
                                                        var htmldata = `                                                     
                                                                        <div class="col-lg-3 col-md-6 col-sm-6">
                                                                            <div class="product__item">
                                                                                <div class="product__item__pic set-bg" style="background-image: url(&quot;${product.product_img}&quot;);"
                                                                                    data-setbg="${product.product_img}">
                                                                                    <ul class="product__item__pic__hover">
                                                                                        <form action="{{ route('addproducttocart') }}" method="POST">
                                                                                            @csrf
                                                                                            <input type="hidden" value="${product.id}" name="product_id">
                                                                                            <input type="hidden" value="${product.price}" name="price">
                                                                                            <input type="hidden" value="${1}" name="quantity">
                                                                                            <button type="submit" class="btn">
                                                                                                <i class="fa fa-shopping-cart"></i>
                                                                                            </button>
                                                                                        </form>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="product__item__text">
                                                                                    <h6><a
                                                                                            href="">${product.product_name}</a>
                                                                                    </h6>
                                                                                    <h5 class="formatMoney">${product.price}</h5>
                                                                                </div>
                                                                            </div>
                                                                        </div>`;
                                                        $("#testdata").append(htmldata);
                                                    });

                                                } else {
                                                    alert("error");
                                                }

                                            }
                                        });
                                    });
                                });
                            </script> --}}
                                <div class="col-lg-4 col-md-4">
                                    {{-- <input style="padding: 0 20px" type="submit" value="Lọc"> --}}
                                </div>
                                <div class="col-lg-4 col-md-3">
                                    <div class="filter__found">
                                        <h6><span>{{ $productCount }}</span> sản phẩm được tìm thấy</h6>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="row" id="testdata">
                        @foreach ($allproducts as $product)
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="{{ asset($product->product_img) }}">
                                        <ul class="product__item__pic__hover">
                                            <form action="{{ route('addproducttocart') }}" method="POST">
                                                @csrf
                                                <input type="hidden" value="{{ $product->id }}" name="product_id">
                                                <input type="hidden" value="{{ $product->price }}" name="price">
                                                <input type="hidden" value="1" name="quantity">
                                                <button type="submit" class="btn">
                                                    <i class="fa fa-shopping-cart"></i>
                                                </button>
                                            </form>
                                        </ul>
                                    </div>
                                    <div class="product__item__text">
                                        <h6><a
                                                href="{{ route('singleproduct', [$product->id, $product->slug]) }}">{{ $product->product_name }}</a>
                                        </h6>
                                        <h5 class="formatMoney">{{ $product->price }}</h5>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div>
                        {!! $allproducts->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->
@endsection

@extends('admin.layouts.template')
@section('page_title')
    EasyHRM
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <!-- Total Revenue -->
                <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
                    <div class="card">
                        <div class="row row-bordered g-0">
                            <div class="col-md-8">
                                <h5 class="card-header m-0 me-2 pb-3">Tổng doanh thu</h5>
                                <div id="totalRevenueChart" class="px-2"></div>
                            </div>
                            <div class="col-md-4">
                                <div class="card h-100">
                                    <div class="card-header">
                                        <div class="card-title mb-0">
                                            <h5 class="m-0 me-2">Khách hàng tiềm năng</h5>
                                        </div>
                                    </div>
                                    <div class="card-body px-0">
                                        <ul>
                                            {{-- @for ($i = 0; $i < count($countUserOrder); $i++) --}}
                                            @foreach ($countUserOrder as $user)
                                                <li style="display: flex; gap: 1rem; margin-bottom: 1rem">
                                                    <div style="width: 100px"> {{ $user['name'] }} </div>
                                                    <div><strong> {{ $user['count'] }} </strong> đơn hàng đã đặt</div>
                                                </li>
                                            @endforeach
                                            {{-- @endfor --}}

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Total Revenue -->
                <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
                    <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title m-0 me-2">Thống kê thanh toán</h5>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="transactionID" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
                                    <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="p-0 m-0">
                                <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <img src="{{ asset('dashboard/assets/img/icons/unicons/paypal.png') }}"
                                            alt="User" class="rounded" />
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <small class="text-muted d-block mb-1">VNPAY</small>
                                            <h6 class="mb-0">Thanh toán online</h6>
                                        </div>
                                        <div class="user-progress d-flex align-items-center gap-1">
                                            <h6 class="mb-0">{{ $total_vnpay }}</h6>
                                            <span class="text-muted">VNĐ</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <img src="{{ asset('dashboard/assets/img/icons/unicons/wallet.png') }}"
                                            alt="User" class="rounded" />
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <small class="text-muted d-block mb-1">{{ $total_cod }}</small>
                                            <h6 class="mb-0">Thanh toán tiền mặt</h6>
                                        </div>
                                        <div class="user-progress d-flex align-items-center gap-1">
                                            <h6 class="mb-0">{{ $total_cod }}</h6>
                                            <span class="text-muted">VNĐ</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <img src="{{ asset('dashboard/assets/img/icons/unicons/chart.png') }}"
                                            alt="User" class="rounded" />
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <small class="text-muted d-block mb-1">Banking</small>
                                            <h6 class="mb-0">Chuyển khoản ngân hàng</h6>
                                        </div>
                                        <div class="user-progress d-flex align-items-center gap-1">
                                            <h6 class="mb-0">{{ $total_banking }}</h6>
                                            <span class="text-muted">VNĐ</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Order Statistics -->
                <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
                    <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between pb-0">
                            <div class="card-title mb-0">
                                <h5 class="m-0 me-2">Thống kê đơn hàng</h5>
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="orederStatistics" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
                                    <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Share</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="d-flex flex-column align-items-center gap-1">
                                    <h2 class="mb-2">{{ $order_count }}</h2>
                                    <span>đơn đặt hàng</span>
                                </div>
                                <div id="orderStatisticsChart"></div>
                            </div>
                            <ul class="p-0 m-0">
                                <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-primary"><i
                                                class="bx bx-mobile-alt"></i></span>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Nam</h6>
                                            <small class="text-muted">Quần, áo, giày</small>
                                        </div>
                                        <div class="user-progress">
                                            <small class="fw-semibold">82.5k</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-success"><i
                                                class="bx bx-closet"></i></span>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Nữ</h6>
                                            <small class="text-muted">Quần, áo, váy</small>
                                        </div>
                                        <div class="user-progress">
                                            <small class="fw-semibold">23.8k</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-info"><i
                                                class="bx bx-home-alt"></i></span>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Trẻ em</h6>
                                            <small class="text-muted">Quần, áo</small>
                                        </div>
                                        <div class="user-progress">
                                            <small class="fw-semibold">849k</small>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-8 order-1 mb-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <div class="card-title mb-0">
                                <h5 class="m-0 me-2">Bài viết mới</h5>
                            </div>
                        </div>
                        <div class="card-body px-0">
                            <ul>
                                {{-- @for ($i = 0; $i < count($countUserOrder); $i++) --}}
                                @foreach ($allblogs as $blog)
                                    <li style="display: flex; margin-bottom: 1rem; gap: 2rem">
                                        <div
                                            style=" white-space: nowrap;
                                        overflow: hidden;
                                        text-overflow: ellipsis;
                                        width: 600px; /* Điều chỉnh chiều rộng tối đa của tiêu đề */">
                                            {{ $blog->blog_title }} </div>
                                        <div>Tác giả: {{ $blog->blog_author }}</div>
                                    </li>
                                @endforeach
                                {{-- @endfor --}}

                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

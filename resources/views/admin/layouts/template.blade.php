@php
    $currentRoute = \Request::route()->getName();
@endphp
<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path=" {{ asset('dashboard/assets/') }}" data-template="vertical-menu-template-free">
<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>@yield('page_title')</title>
    <meta name="description" content="" />
    <link rel="icon" type="image/x-icon" href=" {{ asset('dashboard/assets/img/favicon/favicon.ico') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href=" {{ asset('dashboard/assets/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href=" {{ asset('dashboard/assets/vendor/css/core.css') }}"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href=" {{ asset('dashboard/assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href=" {{ asset('dashboard/assets/css/demo.css') }}" />
    <link rel="stylesheet"
        href=" {{ asset('dashboard/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href=" {{ asset('dashboard/assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    <script src=" {{ asset('dashboard/assets/vendor/js/helpers.js') }}"></script>
    <script src=" {{ asset('dashboard/assets/js/config.js') }}"></script>
</head>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="index.html" class="app-brand-link">
                        <span class="menu-text fw-bolder ms-2">Dream Clothing</span>
                    </a>

                    <a href="javascript:void(0);"
                        class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>
                <div class="menu-inner-shadow"></div>
                <ul class="menu-inner py-1">
                    <li class="menu-item {{ $currentRoute === 'admindashboard' ? 'active' : '' }}">
                        <a href="{{ route('admindashboard') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div>Dashboard</div>
                        </a>
                    </li>

                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Danh mục</span>
                    </li>
                    <li class="menu-item {{ $currentRoute === 'addcategory' ? 'active' : '' }}">
                        <a href="{{ route('addcategory') }}" class="menu-link">
                            <i class="menu-icon bx bxs-category"></i>
                            <div>Thêm danh mục</div>
                        </a>
                    </li>
                    <li class="menu-item {{ $currentRoute === 'allcategory' ? 'active' : '' }}">
                        <a href="{{ route('allcategory') }}" class="menu-link">
                            <i class="menu-icon bx bxs-category"></i>
                            <div>Tất cả danh mục</div>
                        </a>
                    </li>
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Danh mục con</span>
                    </li>
                    <li class="menu-item {{ $currentRoute === 'addsubcategory' ? 'active' : '' }}">
                        <a href="{{ route('addsubcategory') }}" class="menu-link">
                            <i class="menu-icon bx bx-category"></i>
                            <div>Thêm danh mục con</div>
                        </a>
                    </li>
                    <li class="menu-item {{ $currentRoute === 'allsubcategory' ? 'active' : '' }}">
                        <a href="{{ route('allsubcategory') }}" class="menu-link">
                            <i class="menu-icon bx bx-category"></i>
                            <div>Tất cả danh mục con</div>
                        </a>
                    </li>
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Sản phẩm</span>
                    </li>
                    <li class="menu-item {{ $currentRoute === 'addproduct' ? 'active' : '' }}">
                        <a href="{{ route('addproduct') }}" class="menu-link">
                            <i class="menu-icon bx bxl-product-hunt"></i>
                            <div>Thêm sản phẩm</div>
                        </a>
                    </li>
                    <li class="menu-item {{ $currentRoute === 'allproducts' ? 'active' : '' }}">
                        <a href="{{ route('allproducts') }}" class="menu-link">
                            <i class="menu-icon bx bxl-product-hunt"></i>
                            <div>Tất cả sản phẩm</div>
                        </a>
                    </li>
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Mã giảm giá</span>
                    </li>
                    <li class="menu-item {{ $currentRoute === 'addcoupon' ? 'active' : '' }}">
                        <a href="{{ route('addcoupon') }}" class="menu-link">
                            <i class="menu-icon  bx bxs-discount"></i>
                            <div>Thêm mã giảm giá</div>
                        </a>
                    </li>
                    <li class="menu-item {{ $currentRoute === 'allcoupon' ? 'active' : '' }}">
                        <a href="{{ route('allcoupon') }}" class="menu-link">
                            <i class="menu-icon  bx bxs-discount"></i>
                            <div>Tất cả mã giảm giá</div>
                        </a>
                    </li>
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Đơn hàng</span>
                    </li>
                    <li class="menu-item {{ $currentRoute === 'pendingorder' ? 'active' : '' }}">
                        <a href="{{ route('pendingorder') }}" class="menu-link">
                            <i class="menu-icon bx bxl-shopify"></i>
                            <div>Đang chờ</div>
                        </a>
                    </li>
                    <li class="menu-item {{ $currentRoute === 'completedorder' ? 'active' : '' }}">
                        <a href="{{ route('completedorder') }}" class="menu-link">
                            <i class="menu-icon bx bxl-shopify"></i>
                            <div>Đã xác nhận</div>
                        </a>
                    </li>
                    <li class="menu-item {{ $currentRoute === 'doneorder' ? 'active' : '' }}">
                        <a href="{{ route('doneorder') }}" class="menu-link">
                            <i class="menu-icon bx bxl-shopify"></i>
                            <div>Đã giao</div>
                        </a>
                    </li>
                    <li class="menu-item {{ $currentRoute === 'cancelorder' ? 'active' : '' }}">
                        <a href="{{ route('cancelorder') }}" class="menu-link">
                            <i class="menu-icon bx bxl-shopify"></i>
                            <div>Đã hủy</div>
                        </a>
                    </li>
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Liên hệ</span>
                    </li>
                    <li class="menu-item {{ $currentRoute === 'admincontact' ? 'active' : '' }}">
                        <a href="{{ route('admincontact') }}" class="menu-link">
                            <i class='menu-icon bx bxs-contact'></i>
                            <div>Liên hệ</div>
                        </a>
                    </li>
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Blog</span>
                    </li>
                    <li class="menu-item {{ $currentRoute === 'adminblog' ? 'active' : '' }}">
                        <a href="{{ route('adminblog') }}" class="menu-link">
                            <i class='menu-icon bx bxl-blogger'></i>
                            <div>Tất cả bài viết</div>
                        </a>
                    </li>
                    <li class="menu-item {{ $currentRoute === 'addblog' ? 'active' : '' }}">
                        <a href="{{ route('addblog') }}" class="menu-link">
                            <i class="menu-icon bx bxs-edit-alt"></i>
                            <div>Thêm bài viết</div>
                        </a>
                    </li>
                </ul>
            </aside>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                    id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <!-- Search -->
                        <div style="display: none" class="navbar-nav align-items-center">
                            <div class="nav-item d-flex align-items-center">
                                <i class="bx bx-search fs-4 lh-0"></i>
                                <input type="text" class="form-control border-0 shadow-none"
                                    placeholder="Tìm kiếm sản phẩm..." aria-label="Search..." />
                            </div>
                        </div>
                        <!-- /Search -->

                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <!-- Place this tag where you want the button to render. -->
                            {{-- <li class="nav-item lh-1 me-3">
                                <a class="github-button"
                                    href="https://github.com/themeselection/sneat-html-admin-template-free"
                                    data-icon="octicon-star" data-size="large" data-show-count="true"
                                    aria-label="Star themeselection/sneat-html-admin-template-free on GitHub">Star</a>
                            </li> --}}

                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                                    data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="{{ asset('dashboard/assets/img/avatars/1.png') }}" alt
                                            class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        <img src="{{ asset('dashboard/assets/img/avatars/1.png') }}"
                                                            alt class="w-px-40 h-auto rounded-circle" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span class="fw-semibold d-block">John Doe</span>
                                                    <small class="text-muted">Admin</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{route('myprofile')}}">
                                            <i class="bx bx-user me-2"></i>
                                            <span class="align-middle">My Profile</span>
                                        </a>
                                    </li>

                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <style>
                                        .form-row-logout {
                                            display: flex;
                                            align-items: center;
                                        }

                                        .logout-admin-btn {
                                            background: transparent;
                                            border: none;
                                            color: #697a8d;
                                        }
                                    </style>
                                    <li>
                                        <a class="dropdown-item form-row-logout">
                                            <i class="bx bx-power-off me-2"></i>
                                            <form action="{{ route('adminlogout') }}" method="POST">
                                                @csrf
                                                <input class="align-middle logout-admin-btn" type="submit"
                                                    value="Đăng xuất">
                                            </form>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!--/ User -->
                        </ul>
                    </div>
                </nav>


                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    @yield('content')
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- build:js assets/vendor/js/core.js -->
    <script src=" {{ asset('dashboard/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src=" {{ asset('dashboard/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src=" {{ asset('dashboard/assets/vendor/js/bootstrap.js') }}"></script>
    <script src=" {{ asset('dashboard/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <!-- Core JS -->

    <script src="{{ asset('home/js/main.js') }}"></script>

    <script src="{{ asset('home/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('blog_content_ckeditor_addblog');
        CKEDITOR.replace('blog_content_ckeditor_editblog');
    </script>
    <script src=" {{ asset('dashboard/assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src=" {{ asset('dashboard/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src=" {{ asset('dashboard/assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src=" {{ asset('dashboard/assets/js/dashboards-analytics.js') }}"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

</body>

</html>

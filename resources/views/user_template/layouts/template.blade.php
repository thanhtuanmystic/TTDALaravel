@php
    $categories = App\Models\Category::latest()->get();
    $totalPrice = App\Models\Cart::where('user_id', Auth::id())->sum('price');
    $productCount = App\Models\Cart::where('user_id', Auth::id())->count();
    $idCheck = Auth::id();
    $userInfo = App\Models\User::where('id', $idCheck)->first();
    $currentRoute = \Request::route()->getName();
@endphp
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Softdreams</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="{{ asset('home/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('home/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('home/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('home/css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('home/css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('home/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('home/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('home/css/style.css') }}" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    {{-- <div id="preloder">
        <div class="loader"></div>
    </div> --}}

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="#"><img src="{{ asset('home/img/logo-thanhtuan.png') }}" alt=""></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                <li><a href="{{ route('addtocart') }}"><i class="fa fa-shopping-bag"></i>
                        <span>{{ $productCount }}</span></a></li>
            </ul>
            <div class="header__cart__price">item: <span>
                    @if (Auth::check())
                        {{ $totalPrice }}
                    @else
                        0
                    @endif
                </span></div>
        </div>
        <div class="humberger__menu__widget">

            <div class="header__top__right__auth">
                @if (!isset($idCheck))
                    <a href="{{ route('login') }}"><i class="fa fa-user"></i> Đăng nhập</a>
                @else
                    <a href="{{ route('login') }}"><i class="fa fa-user"></i> {{ $userInfo->name }}</a>
                @endif
            </div>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="{{ $currentRoute === 'home' ? 'active' : '' }}"><a href="{{ route('home') }}">Trang chủ</a>
                </li>
                <li class="{{ $currentRoute === 'showallproducts' ? 'active' : '' }}"><a
                        href="{{ route('showallproducts') }}">Sản phẩm</a></li>
                <li class="{{ $currentRoute === 'home' ? 'active' : '' }}"><a href="#">Thời trang
                        nam</a></li>
                <li class="{{ $currentRoute === 'home' ? 'active' : '' }}"><a href="#">Thời trang
                        nữ</a></li>
                <li class="{{ $currentRoute === 'contact' ? 'active' : '' }}"><a href="{{ route('contact') }}">Liên
                        hệ</a></li>
                <li class="{{ $currentRoute === 'allblog' ? 'active' : '' }}"><a
                        href="{{ route('allblog') }}">Blog</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-pinterest-p"></i></a>
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> dreamclothing@gmail.com</li>
                <li>Miễn phí vận chuyển cho tất cả các đơn hàng có giá trị từ 1.000.000 vnd</li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> dreamclothing@gmail.com</li>
                                <li>Free Ship cho tất cả các đơn hàng từ 1 triệu đồng</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <a href="#"><i class="fa fa-heart"></i><span>1</span></a>
                                <a href="{{ route('addtocart') }}"><i class="fa fa-shopping-bag"></i>
                                    <span>{{ $productCount }}</span></a>
                                <a href="{{ route('addtocart') }}">Tổng thanh toán: <span>
                                        @if (Auth::check())
                                            {{ $totalPrice }}
                                        @else
                                            0
                                        @endif
                                    </span></a>
                            </div>
                            <div class="header__top__right__auth">
                                @if (!isset($idCheck))
                                    <a href="{{ route('login') }}"><i class="fa fa-user"></i> Đăng nhập</a>
                                @else
                                    <a href="{{ route('login') }}"><i class="fa fa-user"></i>
                                        {{ $userInfo->name }}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="{{ route('home') }}"><img src="{{ asset('home/img/logo-thanhtuan.png') }}"
                                alt=""></a>
                    </div>
                </div>
                <div class="col-lg-9">
                    <nav class="header__menu">
                        <ul>
                            <li class="{{ $currentRoute === 'home' ? 'active' : '' }}"><a
                                    href="{{ route('home') }}">Trang chủ</a></li>
                            <li class="{{ $currentRoute === 'showallproducts' ? 'active' : '' }}"><a
                                    href="{{ route('showallproducts') }}">Sản phẩm</a></li>
                            <li class="{{ $currentRoute === 'home' ? 'active' : '' }}"><a href="#">Thời trang
                                    nam</a></li>
                            <li class="{{ $currentRoute === 'home' ? 'active' : '' }}"><a href="#">Thời trang
                                    nữ</a></li>
                            <li class="{{ $currentRoute === 'contact' ? 'active' : '' }}"><a
                                    href="{{ route('contact') }}">Liên hệ</a></li>
                            <li class="{{ $currentRoute === 'allblog' ? 'active' : '' }}"><a
                                    href="{{ route('allblog') }}">Blog</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    <section class="hero hero-normal">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>Tất cả sản phẩm</span>
                        </div>
                        <ul>
                            @foreach ($categories as $category)
                                <li><a
                                        href="{{ route('category', [$category->id, $category->slug]) }}">{{ $category->category_name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="{{ route('searchproduct') }}" method="POST">
                                @csrf
                                <input required name="searchInput" type="text" id="searchInput"
                                    placeholder="Nhập từ khóa để tìm kiếm sản phẩm">
                                <button type="submit" class="site-btn">Tìm kiếm</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>0977686868</h5>
                                <span>Hỗ trợ từ 8h-20h</span>
                            </div>
                        </div>
                    </div>
                    @yield('banner-home')
                </div>
            </div>
        </div>
    </section>
    <!-- banner bg main end -->
    {{-- common part --}}
    <div class="container">
        @yield('main-content')
    </div>
    {{-- end of common part --}}
    <!-- footer section start -->
    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="./index.html"><img src="{{ asset('home/img/logo-thanhtuan.png') }}"
                                    alt=""></a>
                        </div>
                        <ul>
                            <li>Địa chỉ: Thị trấn Lập Thạch, huyện Lập Thạch, tỉnh Vĩnh Phúc</li>
                            <li>SĐT: 0977686868</li>
                            <li>Email: dreamclothing@gmail.com</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>Liên kết</h6>
                        <ul>
                            <li><a href="#">Về chúng tôi</a></li>
                            <li><a href="#">Mua sắm an toàn</a></li>
                            <li><a href="#">Thông tin vận chuyển</a></li>
                            <li><a href="#">Chính sách bảo mật</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">
                        <h6>Đăng ký nhận tin tức</h6>
                        <p>Để lại email để nhận những thông tin mới nhất từ Softdreams</p>
                        <form action="#">
                            <input type="text" placeholder="Nhập email của bạn">
                            <button type="submit" class="site-btn">Đăng ký</button>
                        </form>
                        <div class="footer__widget__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text">
                            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy;
                                <script>
                                    document.write(new Date().getFullYear());
                                </script> All rights reserved </a>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            </p>
                        </div>
                        <div class="footer__copyright__payment"><img src="{{ asset('home/img/payment-item.png') }}"
                                alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="{{ asset('home/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('home/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('home/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('home/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('home/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('home/js/mixitup.min.js') }}"></script>
    <script src="{{ asset('home/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('home/js/main.js') }}"></script>
    <script src="{{ asset('home/js/simple.money.format.js') }}"></script>
    <script>
        $('.formatMoney').simpleMoneyFormat();
        $('.formatMoneyy').simpleMoneyFormat();
    </script>

    <script></script>

</body>

</html>

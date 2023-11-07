@php
    $currentRoute = \Request::route()->getName();
@endphp
@extends('user_template.layouts.template')
@section('main-content')
    <style>
        .user-profile-click {
            padding: 0.5rem 0;
        }

        .user-profile-click-active,
        .user-profile-click-active a {
            color: #7FAD39 !important;
        }

        .user-profile-click:hover a,
        .user-profile-click:active a {
            color: #7FAD39;
            opacity: 0.8;
        }

        .user-logout-btn {
            border: none;
            background: transparent;
            color: #007bff;
            margin: 0;
            padding: 0;
        }

        .user-logout-btn:hover {
            color: #7FAD39;
            opacity: 0.8;
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-lg-2">
                <div class="box_main">
                    <ul>
                        <li
                            class="{{ $currentRoute === 'userprofile' ? 'user-profile-click-active' : '' }} user-profile-click">
                            <a href="{{ route('userprofile') }}">Trang của tôi</a>
                        </li>
                        <li
                            class="user-profile-click {{ $currentRoute === 'pendingorders' ? 'user-profile-click-active' : '' }}">
                            <a href="{{ route('pendingorders') }}">Đơn hàng đang chờ</a>
                        </li>
                        <li class="user-profile-click {{ $currentRoute === 'history' ? 'user-profile-click-active' : '' }}">
                            <a href="{{ route('history') }}">Đơn hàng đã đặt</a>
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <input class="user-logout-btn" type="submit" value="Đăng xuất">
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-10">
                <div class="box_main">
                    @yield('profilecontent')
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('user_template.layouts.template')
@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="box_main">
                    <ul>
                        <li><a href="{{route('userprofile')}}">Dashboard</a></li>
                        <li><a href="{{route('pendingorders')}}">Pending Orders</a></li>
                        <li><a href="{{route('history')}}">History</a></li>
                        <li>
                            <form action="{{route('logout')}}" method="POST">
                                @csrf
                                <input type="submit" value="Logout">
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="box_main">
                    @yield('profilecontent')
                </div>
            </div>
        </div>
    </div>
@endsection

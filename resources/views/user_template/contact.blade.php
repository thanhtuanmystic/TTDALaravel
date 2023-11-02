<!DOCTYPE html>
<html lang="en">

<head>
    <title>Liên hệ</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{ asset('home/images/adminlogin/icons/favicon.ico') }}" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('home/adminlogin/vendor/bootstrap/css/bootstrap.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('home/fonts/adminlogin/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('home/vendor/adminlogin/animate/animate.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('home/vendor/adminlogin/css-hamburgers/hamburgers.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('home/vendor/adminlogin/select2/select2.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('home/css/adminlogin/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('home/css/adminlogin/main.css') }}">
    <!--===============================================================================================-->
</head>

<body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="https://colorlib.com/etc/cf/ContactFrom_v1/images/img-01.png" alt="IMG">
                </div>

                <form action="{{ route('sendcontact') }}" method="POST" class="login100-form validate-form">
                    @csrf
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <span class="login100-form-title">
                        Gửi lời nhắn cho Dream Clothing tại đây nhé
                    </span>
                    <div class="wrap-input100 validate-input" data-validate = "Tên khách hàng không được bỏ trống">
                        <input class="input100" type="text" name="contact_name" placeholder="Tên khách hàng">
                        <span class="focus-input100"></span>

                    </div>

                    <div class="wrap-input100 validate-input" data-validate = "Hãy nhập email">
                        <input class="input100" type="email" name="contact_email" placeholder="Email">
                        <span class="focus-input100"></span>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate = "Số điện thoại không được bỏ trống">
                        <input class="input100" type="text" name="contact_phone" placeholder="Số điện thoại">
                        <span class="focus-input100"></span>

                    </div>
                    <div class="wrap-input100 validate-input" data-validate = "Lời nhắn">
                        <input class="input100" type="text" name="contact_message" placeholder="Lời nhắn">
                        <span class="focus-input100"></span>

                    </div>

                    <div class="container-login100-form-btn">
                        <button type="submit" class="login100-form-btn">
                            Gửi
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>




    <!--===============================================================================================-->
    <script src="{{ asset('home/vendor/adminlogin/jquery/jquery-3.2.1.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('home/vendor/adminlogin/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('home/vendor/adminlogin/bootstrap/js/bootstrap.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('home/vendor/adminlogin/select2/select2.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('home/vendor/adminlogin/tilt/tilt.jquery.min.js') }}"></script>
    <script>
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>
    <!--===============================================================================================-->
    <script src="{{ asset('home/js/adminlogin/main.js') }}"></script>

</body>

</html>

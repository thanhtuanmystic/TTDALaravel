@if (session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif
<form action="{{ route('adminloginpost') }}" method="POST">
    @csrf
    <div class="form-row">
        <label for="">Tài khoản</label>
        <input name="adminName" type="text">
    </div>
    <div class="form-row">
        <label for="">Mật khẩu</label>
        <input name="password" type="text">
    </div>
    <input type="submit" value="Đăng nhập">
</form>

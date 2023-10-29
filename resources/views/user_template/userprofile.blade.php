
@extends('user_template.layouts.user_profile_template')
@section('profilecontent')
<style>
   
    .user-form-group {
      display: flex;
      gap: 20px;
    }
   
    .order-history {
      margin-top: 40px;
    }
    .user-table {
      border-collapse: collapse;
      width: 100%;
      margin-top: 20px;
    }
    th, td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }
    th {
      background-color: #f2f2f2;
    }
  </style>
<div class="container">
    <h2 class="mb-4 text-center">TRANG CỦA TÔI</h2>
    <form>
        <h3 class="mb-4">Thông tin tài khoản:</h3 >
        <div class="user-form-group">
            <label for="fullName">Họ tên:</label>
            <p class="form-control-static" id="fullName">{{$userProfile->name}}</p>
        </div>
        <div class="user-form-group">
            <label for="email">Email:</label>
            <p class="form-control-static" id="email">{{$userProfile->email}}</p>
        </div>
    </form>
    <div class="customer-ranking">
        <h3 class="mb-4">Xếp hạng thành viên:</h3>
        <h4>Member</h4>
        <p>Bạn sẽ tăng hạng thành viên khi mua thêm 100000</p>
    </div>

    <div class="order-history">
        <H3 class="mb-4">Lịch Sử Đơn Hàng</H3>
        <table class="user-table">
            <thead>
                <tr>
                    <th>Đơn hàng</th>
                    <th>Ngày</th>
                    <th>Tổng tiền</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>#1</td>
                    <td>10/10/2023</td>
                    <td>$50.00</td>
                </tr>
                <tr>
                    <td>#2</td>
                    <td>15/10/2023</td>
                    <td>$80.00</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection
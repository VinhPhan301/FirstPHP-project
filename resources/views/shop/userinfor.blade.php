@extends('Viewpage.viewhome')
@section('home_content')
<div class='user_box'>
    <div class='user_box_left'>
        <div class='user_name'>
            <p>User name</p>
            <p><i class="fa-regular fa-envelope"></i></p>
        </div>
        <div class='user_point'>
            <div>
                <p>C-Point</p>
                <p style='color:red'>100</p>
            </div>
            <div>
                <p>KHTT</p>
                <p style='color:rgb(0, 171, 194)'>125</p>
            </div>
            <div>
                <p>Hạng thẻ</p>
                <p class="cart_level">green</p>
            </div>
        </div>
        <div class='user_action'>
            <ul>
                <li><i class="fa-solid fa-box"></i> Đơn hàng của tôi</li>
                <li><i class="fa-solid fa-ticket"></i> Khuyến mại</li>
                <li><i class="fa-solid fa-coins"></i> C-Points</li>
                <li><i class="fa-solid fa-house"></i> Sổ địa chỉ</li>
                <li><i class="fa-regular fa-credit-card"></i> Thẻ KHTT</li>
                <li><i class="fa-regular fa-heart"></i> Yêu thích</li>
                <li><i class="fa-regular fa-circle-user"></i> Tài khoản</li>
                <li><i class="fa-solid fa-arrow-right-to-bracket"></i> Đăng xuất</li>
            </ul>
        </div>
        <div class="user_support">
            <p>Bạn cần hỗ trợ ?</p>
            <p>Vui lòng gọi <span style="color:rgb(77, 193, 255)">1800 6061</span> (miễn phí cước gọi)</p>
        </div>
    </div>
    <div class='user_box_right'>
        <form action="" method='post'>
            @csrf
            <h3>Thông tin tài khoản</h3>
            <div>
                <p>Họ tên</p>
                <input type="text" name='name' value="{{ $user->name }}">
            </div>
            <div>
                <p>Email</p>
                <input type="text" name='email' value="{{ $user->email }}">
            </div>
            <div>
                <p>Số điện thoại</p>
                <input type="text" name='phone' value="{{ $user->phone}}">
            </div>
            <div>
                <p>Ngày sinh</p>
                <input type="date" name='date_of_birth' value="{{ $user->date_of_birth}}">
            </div>
            <button type="submit" class="save_user_infor">Lưu thông tin</button>
        </form>
    </div>
</div>
@endsection
@section('script')
<script>
    
</script>
@endsection
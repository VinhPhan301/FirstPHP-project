@extends('Viewpage.viewhome')
@section('home_content')
<div class="signup_form_box">
    <form class="loginform" action="" method="post">
        @csrf
        <div class="login_paw">
            <p>Đăng nhập</p>
            <p><i class="fa-solid fa-paw"></i></p>
        </div>
        <input type="text" placeholder="Vui lòng nhập Email" name="email">
        <span class="opacity">1</span>
        <input type="password" placeholder="Vui lòng nhập mật khẩu" name="password">
        <span class="opacity">1</span>
        <button type="submit">Đăng nhập</button>
        <p class='agree'>Bằng việc chọn đăng nhập, bạn đã đồng ý với 
            <span>Điều khoản & Điều kiện</span> cùng 
            <span>Chính sách bảo mật và chia sẻ thông tin</span> 
            của CANIFA</p>
    </form>
</div>
@endsection
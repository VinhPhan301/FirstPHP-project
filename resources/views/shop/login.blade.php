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
        <p class="login_shop_error">
            @error('email')
            <span>{{ $message }}</span> 
            @enderror
            <span style="opacity: 0">1</span>
        </p>
        <input type="password" placeholder="Vui lòng nhập mật khẩu" name="password">
        <p class="login_shop_error">
            @error('password')
            <span>{{ $message }}</span> 
            @enderror
            <span style="opacity: 0">1</span>
        </p>
        <button type="submit">Đăng nhập</button>
        <button><a href="{{ route('shop.signup') }}">Đăng ký</a></button>
        <p class='agree'>Bằng việc chọn đăng nhập, bạn đã đồng ý với 
            <span>Điều khoản & Điều kiện</span> cùng 
            <span>Chính sách bảo mật và chia sẻ thông tin</span> 
            của CANIFA</p>
    </form>
</div>
@endsection
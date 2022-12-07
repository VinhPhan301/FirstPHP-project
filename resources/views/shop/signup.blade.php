@extends('Viewpage.viewhome')
@section('home_content')

<div class="signup_form_box">
    <form action="" method='post'>
        <h2>Đăng ký</h2>
        @csrf
        <input type="text" name='email' placeholder="Vui lòng nhập Email">
        <span id='texterror'>
            @error('email')
            {{ $message }}
            @enderror
        </span>
        <span class="opacity">1</span>
        <input type="password" name='password' placeholder='Vui lòng nhập mật khẩu'>
        <span class="opacity">1</span>
        <input type="password" name='password_confirm' placeholder='Xác nhận mật khẩu'>
        <span id='texterror'>
            @error('password')
            {{ $message }}
            @enderror
        </span>
        <span class="opacity">1</span>
        <input style="display: none" type="text" name='role' value='user'>
        <button type="submit">Đăng ký</button>
        <p class='agree'>Bằng việc chọn đăng ký, bạn đã đồng ý với 
            <span>Điều khoản & Điều kiện</span> cùng 
            <span>Chính sách bảo mật và chia sẻ thông tin</span> 
            của CANIFA</p>
    </form>
</div>
@endsection
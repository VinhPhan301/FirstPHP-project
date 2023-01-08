@extends('Viewpage.viewhome')
@section('home_content')

<div class="signup_form_box">
    <form action="" method='post'>
        <h2>Đăng ký</h2>
        @csrf
        <input type="text" name='name' placeholder="Vui lòng nhập tên" value="{{ old('name') }}">
        <span id='texterror'>
            @error('name')
            {{ $message }}
            @enderror
        </span>
        <span style="opacity: 0">1</span>
        <input type="text" name='email' placeholder="Vui lòng nhập Email" value="{{ old('email') }}">
        <span id='texterror'>
            @error('email')
            {{ $message }}
            @enderror
        </span>
        <span style="opacity: 0">1</span>
        <input type="password" name='password' placeholder='Vui lòng nhập mật khẩu' value="{{ old('password') }}">
        <span id='texterror'>
            @error('password')
            {{ $message }}
            @enderror
        </span>
        <span style="opacity: 0">1</span>
        <input type="password" name='password_confirm' placeholder='Xác nhận mật khẩu'>
        <span id='texterror'>
            @error('password_confirm')
            {{ $message }}
            @enderror
        </span>
        <span style="opacity: 0">1</span>
        <input style="display: none" type="text" name='role' value='user'>
        <button type="submit">Đăng ký</button>
        <p class='agree'>Bằng việc chọn đăng ký, bạn đã đồng ý với 
            <span>Điều khoản & Điều kiện</span> cùng 
            <span>Chính sách bảo mật và chia sẻ thông tin</span> 
            của CANIFA</p>
    </form>
</div>
<div class="success_signup_box">
    <div class="success_signup">
        <p><i class="fa-solid fa-shield-cat"></i></p>
        <p>Bạn đã đăng ký thành công</p>
        <p class="success_msg">{{ $msg }}</p>
        <div>
            <button><a href="{{ route('shop.login') }}">Đăng nhập</a></button>
            <button onclick='closeSuccess()'>Tiếp tục</button>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    var message = $('.success_msg').text()
    if(message === '') {
        $('.success_signup_box').css('display','none')
    } else {
        $('.success_signup_box').css('display','block')
    }
    
    function closeSuccess(){
        $('.success_signup_box').css('display','none')
    }
</script>
@endsection
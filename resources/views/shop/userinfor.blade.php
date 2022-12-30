@extends('Viewpage.viewuser')
@section('user_content')
<div class="view_msg">
    <div>
        <p class="logout_msg">{{ $msg }}</p>
        <p><i class="fa-solid fa-otter"></i></p>
    </div>
</div>
<form action="" method='post' class='user_update_account'>
    @csrf
    <h3>Thông tin tài khoản</h3>
    <div>
        <p>Họ tên</p>
        <input type="text" name='name' value="{{ $user->name }}" @error('name') placeholder="{{ $message }}" @enderror>
    </div>
    <div>
        <p>Email</p>
        <p style="font-size: 20px; font-weight: bold;">{{ $user->email }}</p>
    </div>
    <div>
        <p>Số điện thoại</p>
        <input type="text" name='phone' value="{{ $user->phone}}" @error('phone') placeholder="{{ $message }}" @enderror> 
    </div>
    <div>
        <p>Ngày sinh</p>
        <input type="date" name='date_of_birth' value="{{ $user->date_of_birth}}">
        <p>
            @error('date_of_birth')
            <span style="color:red; font-size:13px; font-weight:bold">{{ $message }}</span>
            @enderror
            <span style="opacity: 0">1</span>
        </p>
    </div>
    <button type="submit" class="save_user_infor">Lưu thông tin</button>
</form>
@endsection
@section('script')
<script>
    $('.user_account_ticked a').css('color', '#63b1bc');
    $('.user_account_ticked i').css('color', '#63b1bc');
    
    var message = $('.logout_msg').text()
    if(message === '') {
        $('.view_msg').css('display','none')
    } else {
        $('.view_msg').css('display','block')
        setInterval(function() {
            $('.view_msg').slideUp();
        },850)
    }
</script>
@endsection
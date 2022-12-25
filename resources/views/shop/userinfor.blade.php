@extends('Viewpage.viewuser')
@section('user_content')
<div class="view_msg">
    <div>
        <p class="logout_msg">{{ $msg }}</p>
        <p><i class="fa-solid fa-otter"></i></p>
    </div>
</div>
<form action="" method='post' class='userAction6 userAction'>
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
@endsection
@section('script')
<script>
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
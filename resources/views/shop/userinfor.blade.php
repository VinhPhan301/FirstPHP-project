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
    <div class="user_update_account_left">
        <h3>Thông tin tài khoản</h3>
        <div>
            <p>Họ tên: <span>@error('name') {{ $message }} @enderror</span></p>
            <input type="text" name='name' value="{{ $user->name }}"> 
        </div>
        <div style="background: #63b1bc; color:white">
            <p>Email:</p>
            <p style="font-size: 20px; font-weight: bold;">{{ $user->email }}</p>
        </div>
        <div>
            <p>Số điện thoại: <span> @error('phone') {{ $message }} @enderror </span></p>
            <input type="text" name='phone' value="{{ $user->phone}}"> 
        </div>
        <div>
            <p>Ngày sinh: @error('date_of_birth') <span>{{ $message }}</span> @enderror</p>
            <input type="date" name='date_of_birth' value="{{ $user->date_of_birth}}">
            <p>
                
            </p>
        </div>
        <button type="submit" class="save_user_infor">Lưu thông tin</button>
    </div>
    <div class="user_update_account_right">
        @if ($user->avatar === null)
        <img src="https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png" id='sp_hinh-upload'>
        @else
        <img src="{{ asset("picture/$user->avatar") }}" id='sp_hinh-upload'>
        @endif
        <input type="file" name="avatar" value="{{ $user->avatar }}" id='sp_hinh' style='display:none'>
        <label for="sp_hinh" class="label_for_avatar">Thay đổi ảnh đại diện</label>
    </div>
</form>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $('.user_account_ticked a').css('color', '#63b1bc');
    $('.user_account_ticked i').css('color', '#63b1bc');
    $('.user_account_ticked').css('border-left', '4px solid #63b1bc');
    $('.user_account_ticked').css('padding-left', '26px');
    
    var message = $('.logout_msg').text()
    if(message === '') {
        $('.view_msg').css('display','none')
    } else {
        $('.view_msg').css('display','block')
        setInterval(function() {
            $('.view_msg').slideUp();
        },850)
    }


    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#sp_hinh-upload').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Bắt sự kiện, ngay khi thay đổi file thì đọc lại nội dung và hiển thị lại hình ảnh mới trên khung preview-upload
    $("#sp_hinh").change(function(){
        readURL(this);
        $('.preview_picture p').css('display','none');
    });
</script>
@endsection
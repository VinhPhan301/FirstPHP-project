
@extends('ViewPage.viewpage')
@section('content')
<div class="update_form_box">
    <p id='register'>CHỈNH SỬA THÔNG TIN TÀI KHOẢN</p>
    <p id='under_register'>Nhập thông tin cần chỉnh sửa</p>
    <form action="" method='post' class='signup_form update_form' id='admin_account_update' enctype="multipart/form-data"> 
        @csrf
        <div class="admin_update_form_left">
            <div class='name_form update_form_div'>
                <div>
                <p>Tên tài khoản: @error('name') <span> {{ $message }} </span> @enderror</p> 
                <input type="text" value="{{ $user->name }}" name="name" >
                </div>
            </div>
            <div style="background: #63b1bc" class='email_form update_form_div'>
                <p>Địa chỉ email:</p>
                <input style="background:#63b1bc" type="text" value="{{ $user->email }}" name="email" readonly>
            </div>
            <div class='phone_date_form '>
                <div class='dateofbirth update_form_div'>
                    <p>Ngày sinh: @error('date_of_birth') <span> {{ $message }} </span> @enderror</p> 
                    <input  type="date" name="date_of_birth"
                    value="{{ $user->date_of_birth }}">
                </div>
                <div class='phone update_form_div'>
                    <p>Số điện thoại: @error('phone') <span> {{ $message }} </span> @enderror</p> 
                    <input  type="text" value="{{ $user->phone }}" name="phone" >
                </div>
            </div>
            <div class='address update_form_div address_update'>
                <p>Địa chỉ: @error('address') <span> {{ $message }} </span> @enderror</p> 
                <input  type="text" value="{{ $user->address }}" name="address">
            </div>
            <button class="create_btn update_btn" type="submit">Chỉnh sửa</button>
        </div>
        <div class="admin_update_form_right">
            @if ($userLogin->avatar === null)
            <img src="https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png" id='sp_hinh-upload'>
            @else
            <img src="{{ asset("picture/$userLogin->avatar") }}" id='sp_hinh-upload'>
            @endif
            <input type="file" name="avatar" value="{{ $user->avatar }}" id='sp_hinh' style='display:none'>
            <label for="sp_hinh" class="label_for_avatar">Thay đổi ảnh đại diện</label>
        </div>
    </form>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
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

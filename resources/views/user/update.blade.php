
@extends('ViewPage.viewpage')
@section('content')
    <div class="update_form_box">
        <form action="" method='post' class='signup_form update_form'> 
            <p id='register'>CHỈNH SỬA THÔNG TIN TÀI KHOẢN</p>
            <p id='under_register'>Nhập thông tin cần chỉnh sửa</p>
            @csrf
            <div class='name_form'>
                <div>
                <p>Tên tài khoản</p>
                <input type="text" value="{{ $user->name }}" name="name">
                </div>
            </div>
            <div class='email_form'>
                <p>Địa chỉ email</p>
                <input type="text" value="{{ $user->email }}" name="email">
            </div>
            <div class='phone_date_form'>
                <div class='dateofbirth'>
                    <p>Ngày sinh</p>
                    <input  type="date" name="date_of_birth"
                    value="{{ $user->date_of_birth }}">
                </div>
                <div class='phone'>
                    <p>Số điện thoại</p>
                    <input  type="text" value="{{ $user->phone }}" name="phone">
                </div>
            </div>
            <div class='address_role_form'>
                <div class='address'>
                    <p>Địa chỉ</p>
                    <input  type="text" value="{{ $user->address }}" name="address">
                </div>
                <div class='role'>
                    <p>Quyền</p>
                    <select  name="role" id="" value='{{ $user->role }}'>
                        <option value="user">User</option>  
                        <option value="admin">Admin</option>
                    </select>
                </div>
            </div>
                <button class="create_btn update_btn" type="submit">Chỉnh sửa</button>
        </form>
    </div>
@endsection

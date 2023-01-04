
@extends('Viewpage.viewpage')
@section('content')
    <div class="createbox" style="display:flex">
        <form action="" method='post' class='signup_form'> 
            <p id='register'>TẠO TÀI KHOẢN MỚI</p>
            @csrf
            <div class='name_form'>
            <div class='signup_form_div'>
                <p>Tên tài khoản: @error('name') <span>{{ $message }}</span> @enderror</p>
                <input type="text" name="name">
            </div>
            </div>
            <div class='email_form signup_form_div'>
                <p>Địa chỉ Email: @error('email') <span>{{ $message }}</span> @enderror</p>
                <input type="text"  name="email">           
            </div>
            <div class='password_form '>
                <div class='signup_form_div'>
                    <p>Mật khẩu: @error('password') <span>{{ $message }}</span> @enderror</p>
                    <input type="password" name='password'>
                </div>
                <div class='signup_form_div'>
                    <p>Xác nhận mật khẩu: @error('password_confirm') <span>{{ $message }}</span> @enderror</p>
                    <input type="password" name='password_confirm' >
                </div>
            </div>       
            <div class='phone_date_form'>
                <div class='dateofbirth signup_form_div'>
                    <p>Ngày sinh: @error('date_of_birth') <span>{{ $message }}</span> @enderror</p>
                    <input  type="date" name="date_of_birth">
                </div>
                <div class='phone signup_form_div'>
                    <p>Số điện thoại: @error('phone') <span>{{ $message }}</span> @enderror</p>
                    <input  type="text" name="phone">
                </div>
            </div>
            <div class='address_role_form'>
                <div class='address signup_form_div'>
                    <p>Địa chỉ: @error('address') <span>{{ $message }}</span> @enderror</p>
                    <input  type="text" name="address">
                </div>
                <div class='role signup_form_div'>
                    <p>Quyền</p>
                    <select  name="role" id="">
                        @if ($userLogin->role == 'admin')
                        <option value="user">Người dùng</option>  
                        <option value="staff">Nhân viên</option>  
                        <option value="manager">Quản lý</option>
                        @elseif ($userLogin->role == 'manager')
                        <option value="user">Người dùng</option>  
                        <option value="staff">Nhân viên</option> 
                        @else 
                        <option value="user">Người dùng</option>
                        @endif
                    </select>
                </div>
            </div>
            <button class="create_btn" type="submit">Tạo mới</button>
        </form>
    </div>
@endsection

@extends('Viewpage.viewpage')
@section('content')
    <div class="createbox" style="display:flex">
        <form action="" method='post' class='signup_form'> 
            <p id='register'>TẠO TÀI KHOẢN MỚI</p>
            @csrf
            <div class='name_form'>
            <div>
                <p>Tên tài khoản</p>
                <input type="text" placeholder="Enter Name" name="name">
                <span class='texterror'>
                    1
                </span>
                <span id='texterror'>
                    @error('name')
                    {{ $message }}
                    @enderror
                </span>
            </div>
            </div>
            <div class='email_form'>
                <p>Địa chỉ Email</p>
                <input type="text" placeholder="Enter Email" name="email">
                <span class='texterror'>
                    1
                </span>
                <span id='texterror'>
                    @error('email')
                    {{ $message }}
                    @enderror
                </span>
            </div>
            <div class='password_form'>
                <div>
                    <p>Mật khẩu</p>
                    <input type="password" placeholder="Enter Password" name='password'>
                    <span class='texterror'>
                        1
                    </span>
                    <span id='texterror'>
                        @error('password')
                        {{ $message }}
                        @enderror
                    </span>
                </div>
                <div>
                    <p>Xác nhận mật khẩu</p>
                    <input type="password" placeholder="Confirm Password" name='password_confirm'>
                    <span class='texterror'>
                        1
                    </span>
                    <span id='texterror'>
                        @error('name')
                        {{ $message }}
                        @enderror
                    </span>
                </div>
            </div>       
            <div class='phone_date_form'>
                <div class='dateofbirth'>
                    <p>Ngày sinh</p>
                    <input  type="date" name="date_of_birth">
                    <span class='texterror'>
                        1
                    </span>
                    <span id='texterror'>
                        @error('date_of_birth')
                        {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class='phone'>
                    <p>Số điện thoại</p>
                    <input  type="text" placeholder="Enter Phone Number" name="phone">
                    <span class='texterror'>
                        1
                    </span>
                    <span id='texterror'>
                        @error('phone')
                        {{ $message }}
                        @enderror
                    </span>
                </div>
            </div>
            <div class='address_role_form'>
                <div class='address'>
                    <p>Địa chỉ</p>
                    <input  type="text" placeholder="Enter Address" name="address">
                    <span class='texterror'>
                        1
                    </span>
                    <span id='texterror'>
                        @error('address')
                        {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class='role'>
                    <p>Quyền</p>
                    <select  name="role" id="">
                        <option value="user">User</option>  
                        <option value="admin">Admin</option>
                    </select>
                </div>
            </div>
            <button class="create_btn" type="submit">Tạo mới</button>
        </form>
    </div>
@endsection
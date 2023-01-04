
@extends('ViewPage.viewpage')
@section('content')
    <div class="update_form_box">
        <form action="" method='post' class='signup_form update_form'> 
            <p id='register'>CHỈNH SỬA THÔNG TIN TÀI KHOẢN</p>
            <p id='under_register'>Nhập thông tin cần chỉnh sửa</p>
            @csrf
            <div class="admi_update_form_left">
                <div class='name_form update_form_div'>
                    <div>
                    <p>Tên tài khoản: @error('name') <span> {{ $message }} </span> @enderror</p> 
                    <input type="text" value="{{ $user->name }}" name="name" >
                    </div>
                </div>
                <div class='email_form update_form_div'>
                    <p>Địa chỉ email:</p>
                    <input type="text" value="{{ $user->email }}" name="email" readonly>
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
            </div>
            <div>

            </div>
            <button class="create_btn update_btn" type="submit">Chỉnh sửa</button>
        </form>
    </div>
@endsection

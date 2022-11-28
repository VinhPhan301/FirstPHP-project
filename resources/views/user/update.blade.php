
@extends('ViewPage.viewpage')
@section('content')
    <div class="update_form_box">
        <form action="" method='post' class='signup_form update_form'> 
            <p id='register'>UPDATE USER</p>
            <p id='under_register'>lorem ipsum dolor sit amens nasan</p>
            @csrf
            <div class='name_form'>
                <div>
                <p>Name</p>
                <input type="text" value="{{ $user->name }}" name="name">
                </div>
            </div>
            <div class='email_form'>
                <p>Email Address</p>
                <input type="text" value="{{ $user->email }}" name="email">
            </div>
            <div class='phone_date_form'>
                <div class='dateofbirth'>
                    <p>Date of Birth</p>
                    <input  type="date" name="date_of_birth"
                    value="{{ $user->date_of_birth }}">
                </div>
                <div class='phone'>
                    <p>Phone Number</p>
                    <input  type="text" value="{{ $user->phone }}" name="phone">
                </div>
            </div>
            <div class='address_role_form'>
                <div class='address'>
                    <p>Address</p>
                    <input  type="text" value="{{ $user->address }}" name="address">
                </div>
                <div class='role'>
                    <p>Role</p>
                    <select  name="role" id="" value='{{ $user->role }}'>
                        <option value="user">User</option>  
                        <option value="admin">Admin</option>
                    </select>
                </div>
            </div>
                <button class="create_btn update_btn" type="submit">Update</button>
        </form>
    </div>
@endsection

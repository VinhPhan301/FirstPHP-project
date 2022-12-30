@extends('ViewPage.viewpage')
@section('content')
<div class="listmsg">
    <div class="thongbao">
        <h3>Thông báo:</h3> 
        <p class="checkadd"><i class="fa-regular fa-circle-check"></i></p>
    </div>
    <p><span class="success">{{ $msg }}</span></p>
</div>
<h2>Thông tin tài khoản</h2>
<div class="userAcount_box">
    <div class="userAcount_box_left">
        <div class="account_avatar">
            <img src="https://ps.w.org/user-avatar-reloaded/assets/icon-256x256.png?rev=2540745" alt="">
        </div>
        <div class="account_role">
            @if($account->role == 'admin')
            <p>Quản trị viên</p>
            @elseif($account->role == 'manager')
            <p>Quản lý</p>
            @else
            <p>Nhân viên</p>
            @endif
            <p>{{ $account->email }}</p>
        </div>
        <div class="account_status">
            @if ( 
            ($userLogin->role == 'manager' && ($account->role == 'staff' || $account->role == 'user')) || 
            ($userLogin->role == 'staff' && $account->role == 'user') || 
            ($userLogin->role == 'admin' && $account->role !== 'admin')
            )
                @if($account->status == 'unlock')
                <a href="{{ route('user.delete', ['id' => $account->id]) }}">
                    <p id='unlock_change_status'><i class="fa-solid fa-lock-open"></i> Khóa tài khoản</p>
                </a>
                @else
                <a href="{{ route('user.delete', ['id' => $account->id]) }}">
                    <p id='unlock_change_status'><i class="fa-solid fa-lock"></i> Mở khóa tài khoản</p>
                </a>
                @endif
            @else
                @if($account->status == 'unlock')
                <p id="lock_change_status"><i class="fa-solid fa-lock-open"></i> Khóa tài khoản</p>
                @else
                <p id="lock_change_status"><i class="fa-solid fa-lock"></i> Mở khóa tài khoản</p>
                @endif
            @endif
        </div>
        <div class="account_chart">
            <p>
                <span>Ngày tạo:</span> 
                <span>{{ $account->created_at }}</span>
            </p>
            <p>
                <span>Số đơn hàng đã đặt:</span> 
                <span>{{ count($account->order)}}</span>
            </p>
            <p>
                <span>Số đơn hàng đã hủy:</span>
                <span>{{ count($cancelOrder)}}</span> 
            </p>
            <p>
                <span>Tổng giá trị hàng đã mua:</span> 
                <span>{{ number_format($boughtTotal,0,'.','.') }} đ</span>
            </p>
        </div>
    
    </div>
    <div class="userAcount_box_right">
        <div class="account_id">
            <p>Mã tài khoản: AI-{{ $account->id }}</p>
        </div>
        <div class="account_name_email">
            <div>
                <p>Tên người dùng</p>
                @if( $account->name === null)
                <p>Chưa cập nhật</p>
                @else
                <p>{{ $account->name }}</p>
                @endif
            </div>
            <div>
                <p>Email người dùng</p>
                <p>{{ $account->email }}</p>
            </div>
        </div>
        <div class="account_name_email">
            <div>
                <p>Số điện thoại</p>
                @if( $account->phone === null)
                <p>Chưa cập nhật</p>
                @else
                <p>{{ $account->phone }}</p>
                @endif
            </div>
            <div>
                <p>Ngày sinh</p>
                @if( $account->date_of_birth === null)
                <p>Chưa cập nhật</p>
                @else
                <p>{{ $account->date_of_birth }}</p>
                @endif
            </div>
        </div>
        <div class="account_address">
            <div>   
                <p>Địa chỉ nhà riêng</p>
                @if( $account->address === null)
                <p>Chưa cập nhật</p>
                @else
                <p>{{ $account->address }}</p>
                @endif
            </div>
        </div>
        <div class="account_change_role">
            <div>
                @if( ($userLogin->role === 'admin' && ($account->role === 'admin' || $account->role === 'manager')) || ($userLogin->role === 'manager' && ($account->role === 'manager' || $account->role === 'admin')) || $userLogin->role === 'staff')
                <p>Quyền</p>
                    @if($account->role === 'admin')
                    <p>Admin</p>
                    @elseif($account->role === 'manager')
                    <p>Quản lý</p>
                    @elseif($account->role === 'staff')
                    <p>Nhân viên</p>
                    @else
                    <p>Người dùng</p>
                    @endif
                @else                   
                <p>Quyền</p>
                <div class="change_role_div">
                    <form action="" method="post">
                        @csrf
                        <select name="role" value='{{ $account->role }}'>
                            @if($account->role == 'staff')
                            <option value="staff">Nhân viên</option>
                            <option value="user">Người dùng</option>
                            @else
                            <option value="user">Người dùng</option>
                            <option value="staff">Nhân viên</option>
                            @endif
                        </select>
                        <button type="submit">Chỉnh sửa quyền</button>
                    </form>
                </div>   
                @endif
            </div>
        </div>
    </div>
</div>



<script>
    var message = document.querySelector('.success').innerHTML;

    if(message == ''){
        document.querySelector('.listmsg').style.display = 'none';
    }
    else{
        setInterval(function() {
        $('.listmsg').fadeOut(300);
        },1200)
    }
</script>
@endsection
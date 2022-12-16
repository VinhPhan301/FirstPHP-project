@extends('Viewpage.viewhome')
@section('home_content')
<div class="header_category">
    <div class='in_header_category'>
        @foreach($category as $item)
            <a href="{{ route('shop.viewcate',['category' => $item->name]) }}">
                <p>{{ $item->name }}</p>
            </a>
        @endforeach    
    </div>
</div>
<div class="view_msg">
    <div>
        <p class="logout_msg">{{ $msg }}</p>
        <p><i class="fa-solid fa-otter"></i></p>
    </div>
</div>
<div class='user_box'>
    <div class='user_box_left'>
        <div class='user_name'>
            <p>User name</p>
            <p><i class="fa-regular fa-envelope"></i></p>
        </div>
        <div class='user_point'>
            <div>
                <p>C-Point</p>
                <p style='color:red'>100</p>
            </div>
            <div>
                <p>KHTT</p>
                <p style='color:rgb(0, 171, 194)'>125</p>
            </div>
            <div>
                <p>Hạng thẻ</p>
                <p class="cart_level">green</p>
            </div>
        </div>
        <div class='user_action'>
            <ul>
                <li onclick="userAction(0)"><i class="fa-solid fa-box"></i> Đơn hàng của tôi</li>
                <li onclick="userAction(1)"><i class="fa-solid fa-ticket"></i> Khuyến mại</li>
                <li onclick="userAction(2)"><i class="fa-solid fa-coins"></i> C-Points</li>
                <li onclick="userAction(3)"><i class="fa-solid fa-house"></i> Sổ địa chỉ</li>
                <li onclick="userAction(4)"><i class="fa-regular fa-heart"></i> Yêu thích</li>
                <li onclick="userAction(6)"><i class="fa-regular fa-circle-user"></i> Tài khoản</li>
                <li>
                    <a href="{{ route('shop.logout') }}">
                        <i class="fa-solid fa-arrow-right-to-bracket"></i> Đăng xuất
                    </a>
                </li>
            </ul>
        </div>
        <div class="user_support">
            <p>Bạn cần hỗ trợ ?</p>
            <p>Vui lòng gọi <span style="color:rgb(77, 193, 255)">1800 6061</span> (miễn phí cước gọi)</p>
        </div>
    </div>
    <div class='user_box_right'>
        <div class='userAction1 userAction'>
            <div class='order_status'>
                <p>Tất cả</p>
                <p>Đã đặt</p>
                <p>Đang giao</p>
                <p>Hoàn thành</p>
                <p>Đã hủy</p>
            </div>
            <div class='order_content'>
                <table>
                    <thead>
                        <tr>
                            <th>Mã đơn hàng</th>
                            <th>Ngày mua</th>
                            <th>Số lượng</th>
                            <th>Phương thức thanh toán</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <p style="display:none">{{ $sumtotal = 0 }}</p>
                        <tr>
                            <td>CNF-DH-{{ $order->id }}</td>
                            <td>{{ date('d-m-Y', strtotime($order->created_at)) }}</td>
                            <td>{{ $order->total }}</td>
                            <td>{{ $order->payment_method }}</td>
                            <p style="display:none">
                                @foreach($order->orderItem as $orderItem)
                                {{ $sumtotal += (int)$orderItem->total_price }}
                                @endforeach
                            </p>
                            <td>
                                {{ number_format($sumtotal,0,'.','.') }} đ
                            </td>
                            <td>
                                {{ $order->status }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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

    </div>
</div>
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

    function userAction(id) {
        $(`.userAction${id}`).css('display','none')
    }
</script>
@endsection
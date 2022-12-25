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
                <li>
                    <a href="{{ route('shop.userorder',['id' => $user->id]) }}">
                        <i class="fa-solid fa-box"></i> Đơn hàng của tôi
                    </a>
                </li>
                <li><i class="fa-solid fa-ticket"></i> Khuyến mại</li>
                <li><i class="fa-solid fa-coins"></i> C-Points</li>
                <li><i class="fa-solid fa-house"></i> Sổ địa chỉ</li>
                <li><i class="fa-regular fa-heart"></i> Yêu thích</li>
                <li>
                    <a href="{{ route('shop.userinfor',['id' => $user->id ]) }}">
                        <i class="fa-regular fa-circle-user"></i> Tài khoản
                    </a>
                </li>
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
        @yield('user_content')
    </div>
</div>
@endsection


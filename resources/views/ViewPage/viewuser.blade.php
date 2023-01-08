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
            @if($userLogin->name !== null)
            <p>{{ $userLogin->name }}</p>
            @else
            <p>{{ $userLogin->email }}</p>
            @endif
            <p><i class="fa-regular fa-envelope"></i></p>
        </div>
        <div class='user_point'>
            CNF SHOP
        </div>
        <div class='user_action'>
            <ul>
                <li class="user_order_ticked">
                    <a href="{{ route('shop.userorder',['id' => $userLogin->id]) }}">
                        <i class="fa-solid fa-box"></i> Đơn hàng của tôi
                    </a>
                </li>
                <li><i class="fa-solid fa-ticket"></i> Khuyến mại</li>
                <li><i class="fa-solid fa-house"></i> Sổ địa chỉ</li>
                <li class="user_favorite_ticked">
                    <a href="{{ route('shop.userfavorite',['id' => $userLogin->id ]) }}">
                        <i class="fa-regular fa-heart"></i> Yêu thích
                    </a>
                </li>
                <li class="user_account_ticked">
                    <a href="{{ route('shop.userinfor',['id' => $userLogin->id ]) }}">
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


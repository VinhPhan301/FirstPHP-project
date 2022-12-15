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
<div class="checkout_container">
    <div class="checkout_left">
        <div class="checkout_left_top">
            <div class="order_infor">
                <p>Thông tin giao hàng</p>
                <p>
                    <a href="{{ route('cartItem.view') }}">
                        <i class="fa-solid fa-cart-shopping"></i> Quay lại giỏ hàng
                    </a>
                </p>
            </div>
            <div class="order_infor_input">
                <p>Họ tên</p>
                <input type="text" value="{{ $user->name}}">
            </div>
            <div class="order_infor_input">
                <p>Số điện thoại</p>
                <input type="text" value="{{ $user->phone}}">
            </div>
            <div class="order_infor_input">
                <p>Nhập địa chỉ</p>
                <input type="text" value="{{ $user->address}}">
            </div>
        </div>
        <div class='checkout_left_mid'>
            <h3>Phương thức thanh toán</h3>
            <div class="choose_pay">               
                <div>                   
                    <p class="checkbox">
                        <span class="in_checkbox">cod</span>
                    </p>
                    <p>Thanh toán khi nhận hàng ( COD )</p>
                </div>
                <img src="{{ asset('picture/cast.png') }}" alt="">
            </div>
            <div class="choose_pay">               
                <div>
                    <p class="checkbox">
                        <span class="in_checkbox">vnpay</span>
                    </p>
                    <p>Thanh toán bằng VNPAY</p>
                </div>
                <img src="{{ asset('picture/pay1.png') }}" alt="">
            </div>
            <div class="choose_pay">
                <div>
                    <p class="checkbox">
                        <span class="in_checkbox">shoppepay</span>
                    </p>
                    <p>Thanh toán bằng ShopeePay</p>
                </div>
                <img src="{{ asset('picture/shoppepay.png') }}" alt="">
            </div>
        </div>
        <div class="checkout_left_bot">
            <h3>Giỏ hàng</h3>
            <div class="cart_body_table" id='cart_body_table'>
                <table>
                    <thead>
                        <tr>
                            <td id="product_td">SẢN PHẨM</td>
                            <td>GIÁ TIỀN</td>
                            <td>SỐ LƯỢNG</td>
                            <td>TỔNG TIỀN</td>
                            {{-- <td></td> --}}
                        </tr>
                    </thead>
                    <tbody>
                        <p style="display: none">{{ $sumTotalPrice = 0 }}</p>
                        @foreach ($cartItems as $cartItem)
                        <p style="display:none">
                            {{ $thumbnail = $cartItem->productDetail->thumbnail }}
                            {{ $sumTotalPrice +=  $cartItem->total_price }}
                        </p>
                        <tr class="cartItem_tr">
                            <td class='cart_product'>
                                <div>
                                    <img src="{{ asset("picture/$thumbnail") }}">
                                    <div class='cart_size_color'>
                                        <p class='cart_name'>
                                            <a href="{{ route('shop.product',['id' => $cartItem->productDetail->product->id]) }}">
                                                {{ $cartItem->productDetail->product->name }}
                                            </a>
                                        </p>
                                        <div>
                                            <p>{{ $cartItem->productDetail->size }}</p>
                                            <p>/</p>
                                            <p class='cart_color' style="background:{{ $cartItem->productDetail->color }}"></p>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class='cart_product_price cart_single_price'>
                                {{ number_format($cartItem->productDetail->price,0,'.','.')}} đ 
                                <span style='display: none' class='single_price{{ $cartItem->id }}'>
                                    {{ $cartItem->productDetail->price }}
                                </span>
                            </td>
                            <td>
                                {{-- <span class='minus' onclick='minus({{ $cartItem->id }})'>
                                    <i class="fa-regular fa-square-minus"></i>
                                </span> --}}
                                <span class='total_number{{ $cartItem->id }}'>x{{ $cartItem->quantity }}</span>
                                {{-- <span class='plus' onclick='plus({{ $cartItem->id }})'>
                                    <i class="fa-regular fa-square-plus"></i>
                                </span> --}}
                            </td>
                            <td class='cart_product_price total_paid'>
                                <span class='cart_total_price'>{{ $cartItem->total_price }}</span>
                                {{ number_format($cartItem->total_price,0,'.','.')}} đ
                            </td>
                            <td class='productDetail_storage{{ $cartItem->id }}' style='display:none'>
                                {{ $cartItem->productDetail->storage }}
                            </td>
                            {{-- <td onclick='deleteCartItem({{ $cartItem->id }})'>
                                <i class="fa-regular fa-circle-xmark"></i>
                            </td> --}}
                        </tr>
                        @endforeach                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="checkout_right">
        <h3>Đơn hàng</h3>
        <div class="cart_price">
            <span>Giá gốc</span> 
            <span class='change_price'>{{ number_format($sumTotalPrice,0,'.','.') }} đ</span>
        </div>
        <div class='total_price'>
            <span>Tổng tiền thanh toán</span>
            <span class='change_total_price'>{{ number_format($sumTotalPrice,0,'.','.') }} đ</span>
        </div>
        <div class='discount'>
            <p>Mã giảm giá / Thẻ quà tặng</p>
            <div>
                <input type="text" placeholder='Nhập mã'>
                <p>Áp dụng</p>
            </div>
            <p style='margin-top: 40px'>Sử dụng C-Point</p>
            <div>
                <input type="text" placeholder='Nhập số C-Point'>
                <p>Áp dụng</p>
            </div>
        </div>
        <div class='get_bill'>
            <button>Thanh toán</button>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $('.choose_pay').click(function() {
        $('.in_checkbox').removeClass('black')
        $(this).children().children().children().addClass('black')
        $('.choose_pay').removeClass('pay_chosen')
        $(this).addClass('pay_chosen')
    })
</script>
@endsection
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
    <form action="" method="post">
        @csrf
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
                    <p>Họ tên <span class="checkout_userId" style="display:none">{{ $user->id }}</span></p>
                    <input type="text" value="{{ $user->name}}" name="name">
                </div>
                <div class="order_infor_input">
                    <p>Số điện thoại</p>
                    <input class="checkout_phone" type="text" name='phone' value="{{ $user->phone}}">
                </div>
                <div class="order_infor_input">
                    <p>Nhập địa chỉ</p>
                    <input class='checkout_address' type="text" name="address" value="{{ $user->address}}">
                </div>
                <div class="order_infor_input">
                    <p>Ghi chú</p>
                    <input class='checkout_note' name="note" type="text">
                </div>
            </div>
            <div class='checkout_left_mid'>
                <h3>Phương thức thanh toán</h3>
                <input type="text" name="payment_method" id="payment_method_input" value="">
                <div onclick="cashPay()" class="choose_pay default_chosen_pay">               
                    <div>                   
                        <p class="checkbox">
                            <span class="in_checkbox">cod</span>
                        </p>
                        <p>Thanh toán khi nhận hàng ( COD )</p>
                    </div>
                    <img src="{{ asset('thumbnail/cast.png') }}" alt="">
                </div>
                <div onclick="showVNPayQr()" class="choose_pay">               
                    <div>
                        <p class="checkbox">
                            <span class="in_checkbox">vnpay</span>
                        </p>
                        <p>Thanh toán bằng VNPAY</p>
                    </div>
                    <img src="{{ asset('thumbnail/pay1.png') }}" alt="">
                </div>
                <div onclick="showShopeeQr()" class="choose_pay">
                    <div>
                        <p class="checkbox">
                            <span class="in_checkbox">shoppepay</span>
                        </p>
                        <p>Thanh toán bằng ShopeePay</p>
                    </div>
                    <img src="{{ asset('thumbnail/shoppepay.png') }}" alt="">
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
                            <input style="display: none" type="text" name='total' id='total_input' value=''>
                            <p style="display: none">{{ $sumTotalPrice = 0 }}</p>
                            <p style="display: none" class="checkout_total">{{ count($cartItems) }}</p>
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
                                                <p style="display:none">{{ $detailThumbnail = $cartItem->productDetail->thumbnail }}</p>
                                                <p class='cart_color' style="background: url('{{ asset("picture/$detailThumbnail") }}')"></p>
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
                                    <span class='total_number{{ $cartItem->id }}'>x{{ $cartItem->quantity }}</span>                                   
                                </td>
                                <td class='cart_product_price total_paid'>
                                    <span class='cart_total_price'>{{ $cartItem->total_price }}</span>
                                    {{ number_format($cartItem->total_price,0,'.','.')}} đ
                                </td>
                                <td class='productDetail_storage{{ $cartItem->id }}' style='display:none'>
                                    {{ $cartItem->productDetail->storage }}
                                </td>
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
                <span class='change_price'>{{ number_format($sumTotalPrice,0,',',',') }} đ</span>
            </div>
            <div class="cart_price">
                <span>Phí vận chuyển </span>
                <span class='change_price'>(Miễn phí vận chuyển)</span>
            </div>
            <div class="cart_price">
                <span>Giảm giá <span class='discount_or_not'></span></span>
                <span>
                    <span class="discount_put_here">0</span> đ
                </span>
            </div>
            <div class='total_price'> 
                <span>Tổng tiền thanh toán</span>
                <span class='change_total_price'>
                    <span class="totalprice_afterdiscount">
                        {{ number_format($sumTotalPrice,0,',',',') }}
                    </span> đ
                </span>            
            </div>
            <div class='discount'>
                <p>Mã giảm giá / Thẻ quà tặng</p>
                <div>
                    <select name="discount" id="select_voucher" value=''>
                        @foreach($vouchers as $voucher)
                        <option value="{{ $voucher->discount }}">{{ $voucher->name }}</option>
                        @endforeach
                        <option value="null">Không dùng</option>
                    </select>
                    <p onclick='useVoucher()'>Áp dụng</p>
                </div>
            </div>
            <div class='vnpay_qr_code'>
                <h3>Quét mã qua ứng dụng Ngân hàng / Ví điện tử</h3>
                <img src="{{ asset('thumbnail/vnpqrcode.jpg') }}">
            </div>
            <div class='shoppe_qr_code'>
                <h3><i class="fa-solid fa-wallet"></i> ShopeePay</h3>
                <img src="{{ asset('thumbnail/shopeepayqrcode.png') }}">
                <h3>Quét và thanh toán</h3>
            </div>
            <div class='get_bill'>
                <button type='submit'>Thanh toán</button>
            </div>
        </div>
    </form>
</div>
@endsection
@section('script')
<script>
    $('.default_chosen_pay').children().children().children().addClass('black')
    $('.default_chosen_pay').addClass('pay_chosen')
    var payment = $('.pay_chosen span').text()
    var total = $('.checkout_total').text()
    $('#payment_method_input').attr('value', payment)
    $('#total_input').attr('value', total)
    
    $('.choose_pay').click(function chosenPayment() {
        $('.in_checkbox').removeClass('black')
        $(this).children().children().children().addClass('black')
        $('.choose_pay').removeClass('pay_chosen')
        $(this).addClass('pay_chosen')
        payment = $('.pay_chosen span').text();
        $('#payment_method_input').attr('value', payment)
    })
    
    function useVoucher() {
        var sumTotalPrice = JSON.parse("{{ json_encode($sumTotalPrice) }}");
        if($('#select_voucher').val() !== 'null'){
            var afterDiscount = sumTotalPrice * $('#select_voucher').val() / 100
            $('.discount_put_here').text(afterDiscount.toLocaleString())
            $('.discount_or_not').text(`(${$('#select_voucher').val()}%)`)
            $('.totalprice_afterdiscount').text((sumTotalPrice - afterDiscount).toLocaleString())
        } else {
            var afterDiscount = 0
            $('.discount_put_here').text(afterDiscount.toLocaleString())
            $('.totalprice_afterdiscount').text((sumTotalPrice - afterDiscount).toLocaleString())
        }
    }

    function showVNPayQr(){
        $('.vnpay_qr_code').css('display', 'block')
        $('.shoppe_qr_code').css('display', 'none')
    }

    function showShopeeQr(){
        $('.vnpay_qr_code').css('display', 'none')
        $('.shoppe_qr_code').css('display', 'block')
    }

    function cashPay(){
        $('.vnpay_qr_code').css('display', 'none')
        $('.shoppe_qr_code').css('display', 'none')
    }
</script>
@endsection
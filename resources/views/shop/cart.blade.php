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
<div class="">
    <div class="cart_body">
        <div class="cart_body_left">
            <div class='freeship'>
                <p><i class="fa-solid fa-truck-fast"></i></p>
                <p>Miễn phí vận chuyển toàn bộ đơn hàng</p>
            </div>
            <h3><span>(10)</span> sản phẩm</h3>
            <div class="cart_body_table">
                <table>
                    <thead>
                        <tr>
                            <td>SAN PHAM</td>
                            <td>GIÁ TIỀN</td>
                            <td>SỐ LƯỢNG</td>
                            <td>TỔNG TIỀN</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $color }}</td>
                            <td>Gia tien</td>
                            <td>
                                <span class='minus'>
                                    <i class="fa-regular fa-square-minus"></i>
                                </span>
                                <span class='total_number'>3</span>
                                <span class='plus'>
                                    <i class="fa-regular fa-square-plus"></i>
                                </span>
                            </td>
                            <td>1.000.000</td>
                            <td>x</td>
                        </tr>
                        <tr>
                            <td>Hinh anh</td>
                            <td>Gia tien</td>
                            <td>
                                <span class='minus'>
                                    <i class="fa-regular fa-square-minus"></i>
                                </span>
                                <span class='total_number'>3</span>
                                <span class='plus'>
                                    <i class="fa-regular fa-square-plus"></i>
                                </span>
                            </td>
                            <td>1.000.000</td>
                            <td>x</td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
        <div class="cart_body_right">
            <div class="cart_right_top">
                <h3 style='margin-bottom:30px'>Đơn hàng</h3>
                <p class="cart_price"><span>Giá gốc</span> <span>1.714.000$</span></p>
                <p class="discount"><span>Giảm giá</span> <span>-194.400$</span></p>
                <p class='total_price'><span>Tổng tiền thanh toán</span> <span>1.519.600$</span></p>
                <p class="order">ĐẶT HÀNG</p>
            </div>
            <div class='cart_right_bottom'>
                <p>Chúng tôi chấp nhận thanh toán:</p>
                <img src="{{ asset('picture/thanhtoan.png') }}" alt="">
            </div>

        </div>
    </div>
</div>       
@endsection
@section('script')
<script>
    $('.plus').click(function(){
            var number = $(this).siblings('.total_number').text()*1 + 1;
            $(this).siblings('.total_number').text(number);
            console.log($(this).siblings('.total_number').text());
            
        })

        $('.minus').click(function(){
            var number = $(this).siblings('.total_number').text()*1 - 1;
            $(this).siblings('.total_number').text(number);
            console.log($(this).siblings('.total_number').text());
        })
</script>
@endsection
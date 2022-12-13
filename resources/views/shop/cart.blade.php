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
            <h3><span>( {{ count($cartItems) }} )</span> sản phẩm</h3>
            <div class="cart_body_table" id='cart_body_table'>
                <table>
                    <thead>
                        <tr>
                            <td id="product_td">SẢN PHẨM</td>
                            <td>GIÁ TIỀN</td>
                            <td>SỐ LƯỢNG</td>
                            <td>TỔNG TIỀN</td>
                            <td></td>
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
                                        <p class='cart_name'><a href="{{ route('shop.product',['id' => $cartItem->productDetail->product->id]) }}">{{ $cartItem->productDetail->product->name }}</a></p>
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
                                <span style='display: none' class='single_price{{ $cartItem->id }}'>{{ $cartItem->productDetail->price }}</span>
                            </td>
                            <td>
                                <span class='minus' onclick='minus({{ $cartItem->id }})'>
                                    <i class="fa-regular fa-square-minus"></i>
                                </span>
                                <span class='total_number{{ $cartItem->id }}'>{{ $cartItem->quantity }}</span>
                                <span class='plus' onclick='plus({{ $cartItem->id }})'>
                                    <i class="fa-regular fa-square-plus"></i>
                                </span>
                            </td>
                            <td class='cart_product_price total_paid'>
                                <span class='cart_total_price'>{{ $cartItem->total_price }}</span>
                                {{ number_format($cartItem->total_price,0,'.','.')}} đ
                            </td>
                            <td onclick='deleteCartItem({{ $cartItem->id }})'>
                                <i class="fa-regular fa-circle-xmark"></i>
                            </td>
                        </tr>
                        @endforeach                        
                    </tbody>
                </table>
            </div>
        </div>
        <div class="cart_body_right">
            <div class="cart_right_top">
                <h3 style='margin-bottom:30px'>Đơn hàng</h3>
                <p class="cart_price"><span>Giá gốc</span> <span>{{ number_format($sumTotalPrice,0,'.','.') }} đ</span></p>
                {{-- <p class="discount"><span>Giảm giá</span> <span>194.400</span></p> --}}
                <p class='total_price'><span>Tổng tiền thanh toán</span><span>{{ number_format($sumTotalPrice,0,'.','.') }} đ</span></p>
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
    function plus(id){
        var productDetailPrice = $(`.single_price${id}`).text()
        var quantity = $(`.total_number${id}`).text()*1 + 1
 
        $(`.total_number${id}`).text(quantity)
        
        $.get( '{{ route('cartItem.update') }}',
            {'quantity' : quantity, 'id' : id, 'productDetailPrice' : productDetailPrice}, 
            function( data ) {
                console.log(data);
                if ( data === 'true'){
                    $('#cart_body_table').load('{{ route('cartItem.view') }} #cart_body_table');
                }
                else {
                    console.log('false');
                }
            }
        ); 
    }

    function minus(id){
        var productDetailPrice = $(`.single_price${id}`).text()
        var quantity = $(`.total_number${id}`).text()*1 - 1

        if(quantity > 0 ){
            $(`.total_number${id}`).text(quantity)
        
            $.get( '{{ route('cartItem.update') }}',
                {'quantity' : quantity, 'id' : id, 'productDetailPrice' : productDetailPrice}, 
                function( data ) {
                    console.log(data);
                    if ( data === 'true'){
                        $('#cart_body_table').load('{{ route('cartItem.view') }} #cart_body_table');
                    }
                    else {
                        console.log('false');
                    }
                }
            ); 
        }
        else {
            deleteCartItem(id)
        }
        
    }

    function deleteCartItem(id) {
        $.get( '{{ route('cartItem.delete') }}',
            {'id' : id}, 
            function( data ) {
                if ( data === 'true'){
                    $('#cart_body_table').load('{{ route('cartItem.view') }} #cart_body_table');
                }
                else {
                    console.log('false');
                }
            }
        );
    }
</script>
@endsection
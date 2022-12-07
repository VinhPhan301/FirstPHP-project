@extends('Viewpage.viewhome')
@section('home_content')
<p class="userID_logged" style="display: none"></p>
<div class="header_category">
    <div class='in_header_category'>
        @foreach($category as $item)
            <a href="{{ route('shop.viewcate',['category' => $item->name]) }}">
                <p>{{ $item->name }}</p>
            </a>
        @endforeach    
    </div>
</div>
<div class="in_content_product">
    <div class='about_product'>
        <div class='product_thumbnail'>
            <img src="{{ asset("picture/$product->image") }}" alt="">
        </div>
        <div class='product_infor'>
            <div class='top_infor'>
                <h3>{{ $product->name }}</h3>
                <p>Mã sản phẩm: <span class="product_id">{{ $product->id}}</span></p>
                <h3>{{ number_format($product->price,0,'.','.') }} đ</h3>
            </div>
            <div class='mid_infor'>
                <p>Màu sắc: <span class='undefined_color'>Vui lòng chọn màu</span></p>
                @foreach ($detailColor as $color)
                    <span class="detail_color" style="background:{{ $color }}; color:{{ $color }}">{{ $color }}</span>
                @endforeach
                <p>Kích cỡ: <span class='undefined_size'>Vui lòng chọn kích cỡ</span></p>
                @foreach ($detailSize as $size)
                    <span class="detail_size">{{ $size }}</span>
                @endforeach
                <p>Số lượng:</p>
                <p class="quantity_tocart">
                    <span class='less'>
                        <i class="fa-regular fa-square-minus"></i>
                    </span>
                    <span class='choose_quantity'>1</span>
                    <span class='more'>
                        <i class="fa-regular fa-square-plus"></i>
                    </span>
                </p>
            </div>
            <div class='bot_infor'>
                <p><i class="fa-solid fa-check"></i><span>Fresship toàn bộ đơn hàng</span></p>
                <p><i class="fa-solid fa-check"></i><span>Đổi trả miễn phí trong vòng 30 ngày kể từ ngày mua</span></p>
                <div class='to_cart'>Thêm vào giỏ</div>
                <div class='buy_now'><a >Mua ngay</a></div>
                <div>
                    <i class="fa-regular fa-heart"></i>
                    <span>Thêm vào yêu thích</span>
                </div>
            </div>
            <div class='under_bot_infor'>
                <h5>Mô tả</h5>
                <p>Áo phông chất liệu 100% cotton, cố tròn tra bo, tay dài, phom regular.</p>
                <h5>Chất liệu</h5>
                <p>100% cotton</p>
                <h5>Hướng dẫn sử dụng</h5>
                <p>
                    Giặt máy ở chế độ nhẹ, nhiệt độ thường. <br>
                    Không sử dụng hóa chất tẩy có chứa Clo. <br>
                    Sấy thùng, chế độ nhẹ nhàng. <br>
                    Giặt với sản phẩm cùng màu. <br>
                </p>
            </div>
        </div>
    </div>
    <div class="related_product">
        <h1>Có thể bạn sẽ thích</h1>
        <div class='show_related_product'>
            @foreach($relatedProducts as $relatedProduct)
            <div class='related_box'>
                <div class='see_detail'>
                    <a href="{{ route('shop.product',['id' => $relatedProduct->id]) }}">Xem chi tiet</a>
                </div>
                <a href="{{ route('shop.product',['id' => $relatedProduct->id]) }}" > 
                    <img src="{{ asset("picture/$relatedProduct->image") }}" >
                    <div class='name_price'>
                        <p class='related_name'>{{ $relatedProduct->name }}</p>
                        <p class='related_price'>{{ $relatedProduct->price }}$</p>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>
<div class="success_tocart">
    <p><i class="fa-solid fa-circle-check"></i></p>
    <p>Bạn đã thêm <span>{{ $product->name }}{{ $user }}</span>vào giỏ hàng.</p>
</div>
@endsection
@section('script')
<script>
    $('.detail_size').click(function(){
        $('.undefined_size').css('display','none')
        $(this).siblings('.detail_size').removeClass('size_chosen')
        $(this).addClass('size_chosen');
    })

    $('.detail_color').click(function(){
        $('.undefined_color').css('display','none')
        $(this).siblings('.detail_color').removeClass('color_chosen')
        $(this).addClass('color_chosen')
    })

    $('.more').click(function(){
        var number = $(this).siblings('.choose_quantity').text()*1 + 1;
        $(this).siblings('.choose_quantity').text(number);
    })

    $('.less').click(function(){
        var number = $(this).siblings('.choose_quantity').text()*1 - 1;
        if (number < 1) {
            $(this).siblings('.choose_quantity').text(1);
        }
        else {
            $(this).siblings('.choose_quantity').text(number);
        }
    })

    $('.to_cart').click(function(){
        var size = $('.size_chosen').text();
        var color = $('.color_chosen').text();
        var productID = $('.product_id').text();
        var quantity = $('.choose_quantity').text();
        var userID = $('.userID_logged').text();

        if(color === ''){
            $('.undefined_color').css('display','inline')
        }
        else if(size === ''){
            $('.undefined_size').css('display','inline')
        }
        else{ 
            $.get( '{{ route('cart.create') }}',
                {'color': color, 'size': size, 'quantity': quantity, 'productID':productID}, 
                function( data ) {
                if ( data === 'false'){
                    $('#to_login').click()
                }
                }
            );
        }    
    })

    $('.buy_now').click(function(){
        var size = $('.size_chosen').text();
        var color = $('.color_chosen').text();
        var productID = $('.product_id').text();
        var quantity = $('.choose_quantity').text();
        var user = $('.user_logged').text();
        console.log(user);
        
        // if(color === ''){
        //     $('.undefined_color').css('display','inline')
        // }
        // else if(size === ''){
        //     $('.undefined_size').css('display','inline')
        // }
        // else if (user === ''){
        //     // $('.fa-circle-user').click()
        //     console.log('undefind');
        // }
        // else{ 
            

        //     var userID = $('.userID').text();
  
        //     $.post('{{ route('cartItem.create') }}', 
        //         {'_token': $('meta[name=csrf-token]').attr('content'),
        //         'color':color, 'productID':productID, 'size':size, 'quantity':quantity, 'userID':userID,}, 
        //         function (data) {
        //             console.log(data);
        //         }
        //     )
        //     // $('.fa-bag-shopping').click()
         
        // }
    })
</script>
@endsection


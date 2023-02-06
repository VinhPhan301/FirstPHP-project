@extends('Viewpage.viewhome')
@section('home_content')
<p class="userID_logged" style="display: none"></p>
<div class="view_msg">
    <div>
        <p class="logout_msg">{{ $msg }}</p>
        <p><i class="fa-solid fa-otter"></i></p>
    </div>
</div>
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
            <img class="main_thumbnail" src="{{ asset("picture/$product->image") }}">
        </div>
        <div class='productDetail_thumbnail'>
            <img onclick="showimg('{{ $product->image }}')" src="{{ asset("picture/$product->image") }}">
            @foreach($detailThumbnail as $thumbnail)
            <img  onclick="showimg('{{ $thumbnail }}')" src="{{ asset("picture/$thumbnail") }}">
            @endforeach
        </div>
        <div class='product_infor'>
            <div class='top_infor'>
                <h3>{{ $product->name }}</h3>
                <p>Mã sản phẩm: <span class="product_id">{{ $product->id}}</span></p>
                <h3>{{ number_format($product->price,0,'.','.') }} đ</h3>
            </div>
            <div class='mid_infor'>
                <p>Màu sắc: <span class='undefined_color'>Vui lòng chọn màu</span></p>
                @foreach ($detailThumbnail as $thumbnail)
                    <span color='{{ $thumbnail }}' class="detail_color" style="background: url('{{ asset("picture/$thumbnail") }}')">{{ $thumbnail }}</span>
                @endforeach
                <p>Kích cỡ: <span class='undefined_size'>Vui lòng chọn kích cỡ</span></p>
                @foreach ($detailSize as $size)
                    <span class="detail_size">{{ $size }}</span>
                @endforeach
                <p>Số lượng: <span class='product_storage'></span> <span class='product_storage_text'></span></p>
                <p class="quantity_tocart">
                    <span class='less'>
                        <i class="fa-regular fa-square-minus"></i>
                    </span>
                    <span class='choose_quantity'>1</span>
                    <span class='more'>
                        <i class="fa-regular fa-square-plus"></i>
                    </span>  
                </p>
                <p id='limited_storage'>Giới hạn số lượng trong kho</p>
                <p id='limited_quantity'>Thêm tối đa <span></span> sản phẩm</p>
            </div>
            <div class='bot_infor'>
                <p><i class="fa-solid fa-check"></i><span>Fresship toàn bộ đơn hàng</span></p>
                <p><i class="fa-solid fa-check"></i><span>Đổi trả miễn phí trong vòng 30 ngày kể từ ngày mua</span></p>
                <div class='to_cart'>Thêm vào giỏ</div>
                <div class='buy_now'>Mua ngay</div>
                <div class="favorite_product">
                    <p style="display:none" class="count_favorite">{{ count($favorite) }}</p>
                    <div class="add_to_favorite" onclick="addToFavorite({{ $product->id }})">
                        <i class="fa-regular fa-heart"></i>
                        <span>Thêm vào yêu thích</span>
                    </div>
                    <div class="remove_from_favorite" onclick="removeFromFavorite({{ $product->id }})">
                        <i class="fa-solid fa-heart"></i>
                        <span>Đã yêu thích</span>
                    </div>
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
                        <p class='related_price'>{{ number_format($relatedProduct->price,0,'.','.') }} đ</p>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>
<div class="success_tocart">
    <p><i class="fa-solid fa-circle-check"></i></p>
    <p>Bạn đã thêm <span> {{ $product->name }} </span> vào giỏ hàng.</p>
</div>
@endsection
@section('script')
<script>
    var favorite = $('.count_favorite').text();
    if( favorite === '1'){
        $(".add_to_favorite").css('display','none')
        $(".remove_from_favorite").css('display','block')
    } else {
        $(".add_to_favorite").css('display','block')
        $(".remove_from_favorite").css('display','none')
    }
    
    function showimg(thumbnail){
        var showThumbnail = thumbnail
        $('.main_thumbnail').attr('src',`http://localhost:8000/picture/${showThumbnail}`)
    }

    $('.detail_color').click(function(){
        console.log($(this).attr('color'));
        showimg($(this).attr('color'))
        $('#limited_quantity').css('opacity', '0')
        $('.choose_quantity').text('1')
        $('#limited_storage').css('opacity', '0')  
        $('.undefined_color').css('display','none')
        $(this).siblings('.detail_color').removeClass('color_chosen')
        $(this).addClass('color_chosen')

        if ($('.size_chosen').text() == '') {
            console.log('not');
        }
        else {
            var productID = $('.product_id').text();
            var color = $('.color_chosen').text()
            var size = $('.size_chosen').text()
      
            $.get( '{{ route('cart.getStorage') }}',
                {'color': color, 'size': size, 'productID':productID}, 
                function( data ) {
                    $('.product_storage').text(data)
                    $('.product_storage_text').text('Sản phẩm trong kho')
                }
            );
        }
        
    })

    $('.detail_size').click(function(){
        $('#limited_quantity').css('opacity', '0')
        $('.choose_quantity').text('1')
        $('#limited_storage').css('opacity', '0')  
        $('.undefined_size').css('display','none')
        $(this).siblings('.detail_size').removeClass('size_chosen')
        $(this).addClass('size_chosen');

        if ($('.color_chosen').text() == '') {
            console.log('not');
        }
        else {
            var productID = $('.product_id').text();
            var color = $('.color_chosen').text()
            var size = $('.size_chosen').text()
            
            $.get( '{{ route('cart.getStorage') }}',
                {'color': color, 'size': size, 'productID':productID}, 
                function( data ) {
                    $('.product_storage').text(data)
                    $('.product_storage_text').text('Sản phẩm trong kho')
                }
            );
        }
    })

    $('.more').click(function(){
        var size = $('.size_chosen').text();
        var color = $('.color_chosen').text();
        if (color === '') {

            $('.undefined_color').css('display','inline')
            $("html, body").animate({ scrollTop: 0 }, "slow");
            return false;
        } else if (size === '') {

            $('.undefined_size').css('display','inline')
            $("html, body").animate({ scrollTop: 0 }, "slow");
            return false;
        } else {

            var number = $(this).siblings('.choose_quantity').text()*1 + 1;
            var storage = $('.product_storage').text()

            if(number < storage) {
                $(this).siblings('.choose_quantity').text(number);
            }
            else if (number = storage) {
                $(this).siblings('.choose_quantity').text(storage);   
                $('#limited_storage').css('opacity', '1')      
            }
        }  
    })

    $('.less').click(function(){
        $('#limited_storage').css('opacity', '0')
        $('#limited_quantity').css('opacity', '0')

        var size = $('.size_chosen').text();
        var color = $('.color_chosen').text();

        if (color === '') {

            $('.undefined_color').css('display','inline')
            $("html, body").animate({ scrollTop: 0 }, "slow");
            return false;
        } else if (size === '') {

            $('.undefined_size').css('display','inline')
            $("html, body").animate({ scrollTop: 0 }, "slow");
            return false;
        } else { 

            var number = $(this).siblings('.choose_quantity').text()*1 - 1;
            if (number < 1) {
                $(this).siblings('.choose_quantity').text(1);
            }
            else {
                $(this).siblings('.choose_quantity').text(number);
            }
        }
    })

    $('.to_cart').click(function(){
        var size = $('.size_chosen').text();
        var color = $('.color_chosen').text();
        var productID = $('.product_id').text();
        var quantity = $('.choose_quantity').text();
        var userID = $('.userID_logged').text();

        if (color === '') {
            $('.undefined_color').css('display','inline')
            $("html, body").animate({ scrollTop: 0 }, "slow");
            return false;
        }
        else if (size === '') {
            $('.undefined_size').css('display','inline')
            $("html, body").animate({ scrollTop: 0 }, "slow");
            return false;
        }
        else {
            if($('.product_storage').text() !== '0') {
                $.get( '{{ route('cart.create') }}',
                    {'color': color, 'size': size, 'quantity': quantity, 'productID':productID}, 
                    function( data ) {
                        console.log(data);
                        if ( data === 'false') {

                            $('#to_login').click()

                        } else if ( data === 'true' || data === 'newcart' ){

                            $('.success_tocart').css('display','block')

                            setInterval(function() {
                                $('.success_tocart').slideUp();
                            },800)
                        } else if ( data === '0' ) {
                            $('#limited_quantity').text('Đã hết số lượng trong kho');
                            $('#limited_quantity').css('opacity', '1')

                        } else {
                            $('#limited_quantity').css('opacity', '1')
                            $('#limited_quantity span').text(data)
                        }
                    }
                );
            }
            else {
                console.log(123);
            }
        }    
    })

    $('.buy_now').click(function(){
        var size = $('.size_chosen').text();
        var color = $('.color_chosen').text();
        var productID = $('.product_id').text();
        var quantity = $('.choose_quantity').text();
        var userID = $('.userID_logged').text();
    
        if (color === '') {
            $('.undefined_color').css('display','inline')
            $("html, body").animate({ scrollTop: 0 }, "slow");
            return false;
        }
        else if (size === '') {
            $('.undefined_size').css('display','inline')
            $("html, body").animate({ scrollTop: 0 }, "slow");
            return false;
        }
        else { 
            $.get( '{{ route('cart.create') }}',
                {'color': color, 'size': size, 'quantity': quantity, 'productID':productID}, 
                function( data ) {
                    if ( data === 'false'){

                        $('#to_login').click()

                    } else if ( data === 'true' || data === 'newcart'){

                        $('.fa-bag-shopping').click()
                    } else {
                        
                        $('#limited_quantity').css('opacity', '1')
                        $('#limited_quantity span').text(data)
                    }
                }
            );
        } 
    })

    function addToFavorite(productId){
        $.get( '{{ route('shop.favoriteCreate') }}',
            {'productId': productId}, 
            function( data ) {
                if(data){
                    $(".add_to_favorite").css('display','none')
                    $(".remove_from_favorite").css('display','block')
                } else {
                    console.log(data);
                }
            }
        );
    }

    function removeFromFavorite(productId){
        $.get( '{{ route('shop.favoriteDelete') }}',
            {'productId': productId}, 
            function( data ) {
                if(data === '1'){
                    $(".add_to_favorite").css('display','block')
                    $(".remove_from_favorite").css('display','none')
                } else {
                    console.log(data);
                }
            }
        );
    }

    var message = $('.logout_msg').text()
    if(message === '') {
        $('.view_msg').css('display','none')
    } else {
        $('.view_msg').css('display','block')
        setInterval(function() {
            $('.view_msg').slideUp();
        },800)
    }
</script>
@endsection


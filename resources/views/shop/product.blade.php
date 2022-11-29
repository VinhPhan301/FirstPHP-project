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
<div class="in_content_product">
    <div class='about_product'>
        <div class='product_thumbnail'>
            <img src="{{ asset("picture/$product->image") }}" alt="">
        </div>
        <div class='product_infor'>
            <div class='top_infor'>
                <h3>{{ $product->name }}</h3>
                <p>Ma san pham: {{ $product->id}}</p>
                <h3>{{ $product->price }}$</h3>
            </div>
            <div class='mid_infor'>
                <p>Mau sac:</p>
                @foreach ($detailColor as $color)
                    <span class="detail_color" style="background:{{ $color }}; color:{{ $color }}">{{ $color }}</span>
                @endforeach
                <p>Kich co:</p>
                @foreach ($detailSize as $size)
                    <span class="detail_size">{{ $size }}</span>
                @endforeach
            </div>
            <div class='bot_infor'>
                <p><i class="fa-solid fa-check"></i><span>Fresship toàn bộ đơn hàng</span></p>
                <p><i class="fa-solid fa-check"></i><span>Đổi trả miễn phí trong vòng 30 ngày kể từ ngày mua</span></p>
                <div class='to_cart'>Thêm vào giỏ</div>
                <div class='buy_now'>Mua ngay</div>
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
                    Phơi trong bóng mát. <br>
                    Sấy thùng, chế độ nhẹ nhàng. <br>
                    Là ở nhiệt độ trung bình 150 độ C. <br>
                    Giặt với sản phẩm cùng màu. <br>
                    Không là lên chi tiết trang trí. <br>
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
@endsection
@section('script')
<script>
    $('.detail_size').click(function(){
        $(this).siblings('.detail_size').removeClass('size_chosen')
        $(this).addClass('size_chosen');
        console.log($('.size_chosen').text());
    })

    $('.detail_color').click(function(){
        $(this).siblings('.detail_color').removeClass('color_chosen')
        $(this).addClass('color_chosen')
        console.log($('.color_chosen').text());
    })
</script>
@endsection


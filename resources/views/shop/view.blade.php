@extends('Viewpage.viewhome')
@section('home_content')
<div class="view_msg">
    <div>
        <p class="logout_msg">{{ $msg }}</p>
        <p><i class="fa-solid fa-otter"></i></p>
    </div>
</div>
<div class="header_category">
    <div class='in_header_category'>
        @foreach($category as $item)
            <a href="{{ route('shop.viewcate',['category' => $item->name ,'type' => $type]) }}">
                <p>{{ $item->name }}</p>
            </a>
        @endforeach    
    </div>
</div>
<div class="in_content">
    <div class="top_image">
        <img src="{{ asset('thumbnail/banner1.webp') }}" alt="">
    </div>
    <div id='type{{ $type }}'>
        <div class="new_product" >
            Danh sách sản phẩm
        </div>
        <div class="choose_product">
            @foreach($productList as $item)
            <div>
                <a href="{{ route('shop.findProduct',['productName' => $item ,'type' => $type, 'category' => $categoryName]) }}"><p>{{ $item }}</p></a>
            </div>
            @endforeach
        </div>
    </div>
    <div class="new_product">
        SẢN PHẨM BÁN CHẠY
    </div>
    <div class='product_slide'>
        <div class="left_slide">
            <div id="carouselExampleInterval" class="carousel slide w-100" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="2000">
                    <img src="{{ asset('thumbnail/anh4.webp') }}" class="d-block w-100 h-100">
                    </div>
                    <div class="carousel-item active" data-bs-interval="2000">
                    <img src="{{ asset('thumbnail/anh5.webp') }}" class="d-block w-100 h-100">
                    </div>
                    <div class="carousel-item activ" data-bs-interval="2000">
                    <img src="{{ asset('thumbnail/anh6.webp') }}" class="d-block w-100 h-100">
                    </div>
                </div>
            </div>
        </div>
        <div class="right_slide">
            {{ $i = 0 }}
            @foreach ($products as $product)
            <div class='product_box'>
                <div class='see_detail'>
                    <a href="{{ route('shop.product',['id' => $product->id]) }}">Xem chi tiet</a>
                </div>
                <a href="{{ route('shop.product',['id' => $product->id]) }}" > 
                    <img src="{{ asset("picture/$product->image") }}" >
                    <div class='name_price'>
                        <p>{{ $product->name }}</p>
                        <p>{{ number_format($product->price,0,'.','.') }} đ</p>
                    </div>
                </a>
            </div>
            {{ $i++ }}
            @if ($i == 3)
                @break
            @endif
            @endforeach
        </div>
    </div>
    <div class="top_image">
        <img src="{{ asset('thumbnail/banner5.webp') }}" alt="">
    </div>
    <div class="new_product">
        SẢN PHẨM NỔI BẬT
    </div>
    <div class='product_slide'>
        <div class="left_slide">
            <div id="carouselExampleInterval" class="carousel slide w-100" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="2000">
                    <img src="{{ asset('thumbnail/anh1.webp') }}" class="d-block w-100 h-100">
                    </div>
                    <div class="carousel-item active" data-bs-interval="2000">
                    <img src="{{ asset('thumbnail/anh2.webp') }}" class="d-block w-100 h-100">
                    </div>
                    <div class="carousel-item activ" data-bs-interval="2000">
                    <img src="{{ asset('thumbnail/anh3.webp') }}" class="d-block w-100 h-100">
                    </div>
                </div>
            </div>
        </div>
        <div class="right_slide">
            {{ $i = 0 }}
            @foreach ($products as $product)
            <div class='product_box'>
                <div class='see_detail'>
                    <a href="{{ route('shop.product',['id' => $product->id]) }}">Xem chi tiet</a>
                </div>
                <a href="{{ route('shop.product',['id' => $product->id]) }}" > 
                    <img src="{{ asset("picture/$product->image") }}" >
                    <div class='name_price'>
                        <p>{{ $product->name }}</p>
                        <p>{{ number_format($product->price,0,'.','.') }} đ</p>
                    </div>
                </a>
            </div>
            {{ $i++ }}
            @if ($i == 3)
                @break
            @endif
            @endforeach
        </div>
    </div>
    <div class='mid_image'>
        <img src="{{ asset('thumbnail/banner4.webp')}}" alt="">
    </div>
    <div class='category_bar'>
        <div>
            @foreach($category as $item)
            <a href="{{ route('shop.viewcate',['category' => $item->name ,'type' => $type]) }}">
                <p class='show{{ $item->id }}'>{{ $item->name }}</p>
            </a>
            @endforeach
        </div>
    </div>
    <div class='category_product'>
        @foreach($products as $product)
        <div class='category_product_box'>
            <div class='see_detail'>
                <a href="{{ route('shop.product',['id' => $product->id]) }}">Xem chi tiet</a>
            </div>
            <a href="{{ route('shop.product',['id' => $product->id]) }}" > 
                <img src="{{ asset("picture/$product->image") }}" >
                <div class='name_price'>
                    <p>{{ $product->name }}</p>
                    <p>{{ number_format($product->price,0,'.','.') }} đ</p>
                </div>
            </a>
        </div>
        @endforeach
    </div>
    <div class='contact'>
        <div class='contact_email'>
            <p>Đăng ký nhận bản tin</p>
            <input type="text" placeholder='Enter your Email...'>
            <p class="paper_plane"><i class="fa-regular fa-paper-plane"></i></p>
        </div>
        <div class='contact_icon'>
            <p>Kết nối ngay</p>
            <a href='https://www.facebook.com/canifa.fanpage/'><i class="fa-brands fa-square-facebook"></i></a>
            <a href='https://www.instagram.com/canifa.fashion/'><i class="fa-brands fa-square-instagram"></i></a>
            <a href='https://www.youtube.com/CANIFAOfficial'><i class="fa-brands fa-square-youtube"></i></a>
        </div>
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
        },800)
    }
</script>
@endsection
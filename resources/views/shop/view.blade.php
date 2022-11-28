@extends('Viewpage.viewhome')
@section('home_content')
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
        <img src="{{ asset('picture/banner1.webp') }}" alt="">
    </div>
    <div id='type{{ $type }}'>
        <div class="new_product" >
            PRODUCT LIST
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
        BEST SELLER
    </div>
    <div class='product_slide'>
        <div class="left_slide">
            <div id="carouselExampleInterval" class="carousel slide w-100" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="2000">
                    <img src="{{ asset('picture/anh4.webp') }}" class="d-block w-100 h-100">
                    </div>
                    <div class="carousel-item active" data-bs-interval="2000">
                    <img src="{{ asset('picture/anh5.webp') }}" class="d-block w-100 h-100">
                    </div>
                    <div class="carousel-item activ" data-bs-interval="2000">
                    <img src="{{ asset('picture/anh6.webp') }}" class="d-block w-100 h-100">
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
                        <p>{{ $product->price }}$</p>
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
        <img src="{{ asset('picture/banner5.webp') }}" alt="">
    </div>
    <div class="new_product">
        FEATURED PRODUCTS
    </div>
    <div class='product_slide'>
        <div class="left_slide">
            <div id="carouselExampleInterval" class="carousel slide w-100" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="2000">
                    <img src="{{ asset('picture/anh1.webp') }}" class="d-block w-100 h-100">
                    </div>
                    <div class="carousel-item active" data-bs-interval="2000">
                    <img src="{{ asset('picture/anh2.webp') }}" class="d-block w-100 h-100">
                    </div>
                    <div class="carousel-item activ" data-bs-interval="2000">
                    <img src="{{ asset('picture/anh3.webp') }}" class="d-block w-100 h-100">
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
                        <p>{{ $product->price }}$</p>
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
        <img src="{{ asset('picture/banner4.webp')}}" alt="">
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
                    <p>{{ $product->price }}$</p>
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
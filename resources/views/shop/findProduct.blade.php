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
<div class='in_content_product'>
    <div class='in_content_left'> 
        {{-- @foreach ($allCategories as $category)
            <h2>{{ $category->name }}</h2>
            @foreach ($allProducts as $product)
                @if ($product->category_id == $category->id)
                    <a href=""><p>{{ $product->name }}</p></a>
                @endif
            @endforeach
        @endforeach --}}
    </div>
    <div class='in_content_right'>
        <div class='category_product'>
            @foreach($dataFound as $product)
            <div class='category_product_box found_data_box'>
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
    </div>
</div>
@endsection
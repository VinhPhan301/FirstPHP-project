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
<div class='in_content_product'>
    <div class='in_content_right'>
        <div class='category_product'>
            @foreach($findProduct as $product)
            <div class='category_product_box found_data_box found_product_box'>
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
<div class="pagination_box">
    {{ $findProduct->links() }}
</div>
@endsection
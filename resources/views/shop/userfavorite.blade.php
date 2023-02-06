@extends('Viewpage.viewuser')
@section('user_content')
<h3>Sản phẩm yêu thích của bạn</h3>
<div class="user_favorite_box">
    @foreach ($favorites as $favorite)
    <p style="display: none;">{{ $productThumbnail = $favorite->product->image}}</p>
    <div class='category_product_box found_data_box favorite_div'>
        <div class='see_detail'>
            <a href="{{ route('shop.product',['id' => $favorite->product->id]) }}">Xem chi tiet</a>
        </div>
        <a href="{{ route('shop.product',['id' => $favorite->product->id]) }}" > 
            <img src="{{ asset("picture/$productThumbnail") }}" >
            <div class='name_price'>
                <p>{{ $favorite->product->name }}</p>
                <p>{{ number_format($favorite->product->price,0,'.','.') }} đ</p>
            </div>
        </a>
    </div>
    @endforeach
</div>
@endsection
@section('script')
<script>
    $('.user_favorite_ticked a').css('color', '#63b1bc');
    $('.user_favorite_ticked i').css('color', '#63b1bc');
    $('.user_favorite_ticked').css('border-left', '4px solid #63b1bc');
    $('.user_favorite_ticked').css('padding-left', '26px');
</script>
@endsection
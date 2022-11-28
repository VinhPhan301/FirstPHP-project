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
                <p>Mau sac: </p>
                <p>Kich co:</p>
            </div>
        </div>
    </div>
</div>
@endsection
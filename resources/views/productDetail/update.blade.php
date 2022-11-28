@extends('ViewPage.viewpage')
@section('content')
<div class="create_detail_box">
    <h1>UPDATE PRODUCT-DETAIL</h1>
    <form action="" method="post" class="create_detail_form">
        @csrf
        <div class="productDetaild_name">
            <p>Product Name</p>
            <p id="for_default_id">{{ $product->name }} - {{ $product->type}}</p>
            <input class="product_default_id" type="text" name='product_id' value='{{ $product->id }}'>
        </div>
        <div class='detail_color'>
            <p>Detail Color</p>
            <input type="text" name="color" value={{ $productDetail->color }}>
        </div>
        <div class='detail_thumbnail'>
            <p>Detail thumbnail</p>
            <label for="upload_image" class="fake_file">
                <div class="select_file">Select file</div>
                <input type="text" >
            </label>
            <input type="file" name="thumbnail" id='upload_image' value={{ $productDetail->thumbnail }}>
        </div>
        <div class='detail_size'>
            <p>Detail size</p>
            <input type="text" name='size' value={{ $productDetail->size }}>
        </div>
        <div class='detail_storage'>
            <p>Detail storage</p>
            <input type="number" name='storage' value={{ $productDetail->storage }}>
        </div>
        <button type="submit" class="create_detail_btn">
            Update
        </button>
    </form>
</div>
@endsection
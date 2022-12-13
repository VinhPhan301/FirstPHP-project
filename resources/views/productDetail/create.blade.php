@extends('ViewPage.viewpage')
@section('content')
<div class="create_detail_box">
    <h1>CREATE NEW PRODUCT-DETAIL</h1>
    <form action="" method="post" class="create_detail_form">
        @csrf
        <div class="productDetaild_name">
            <p>Product Name</p>
            <p id="for_default_id">{{ $product->name }} - {{ $product->type}}</p>
            <input class="product_default_id" type="text" name='product_id' value='{{ $product->id }}'>
        </div>
        <div class='detail_color'>
            <p>Detail Color</p>
            <input type="text" name="color">
        </div>
        <div class='detail_thumbnail'>
            <p>Detail thumbnail</p>
            <label for="upload_image" class="fake_file">
                <div class="select_file">Select file</div>
                <input type="text">
            </label>
            <input type="file" name="thumbnail" id='upload_image'>
        </div>
        <div class='detail_size'>
            <p>Detail size</p>
            <input type="text" name='size'>
        </div>
        <div class='detail_storage'>
            <p>Detail storage</p>
            <input type="number" name='storage'>
        </div>
        <div class='detail_storage'>
            <p>Detail price</p>
            <input type="text" name='price' value='{{ $product->price }}'>
        </div>
        <button type="submit" class="create_detail_btn">
            Create
        </button>
    </form>
</div>
@endsection
@extends('ViewPage.viewpage')
@section('content')
<div class="create_product_box">
    <h1>UPDATE PRODUCT</h1>
    <form action="" method="post" class="create_product_form">
        @csrf
        <div class="category_id">
            <p>Category Type</p>
            <select name="category_id" id="">
                @foreach($category as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach 
            </select>
        </div>
        <div class='product_name'>
            <p>Product Name</p>
            <input type="text" name="name" value="{{ $product->name }}">
        </div>
        <div class='product_image'>
            <p>Product Image</p>
            <label for="upload_image" class="fake_file">
                <div class="select_file">Select file</div>
                <input type="text" value="{{ $product->image }}">
            </label>
            <input type="file" name="image" id='upload_image' value="{{ $product->image }}">
        </div>
        <div class='product_price'>
            <p>Product Price</p>
            <input type="number" name='price' value="{{ $product->price }}">
        </div>
        <div class='product_type'>
            <p>Product Type</p>
            <select name="type">
                <option value="men">Men</option>
                <option value="women">Women</option>
                <option value="girl">Girl</option>
                <option value="boy">Boy</option>
            </select>
        </div>
        <button type="submit">
            Update
        </button>
    </form>
</div>
@endsection
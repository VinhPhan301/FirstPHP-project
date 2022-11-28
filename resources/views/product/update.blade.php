@extends('ViewPage.viewpage')
@section('content')
<form action="" method="post" class="update_product_form">
    @csrf
    <div class='product_name_update'>
        <p>Product Name</p>
        <input type="text" value="{{ $product->name }}" name="name">
    </div>
    <div class='product_image_update'>
        <p>Product Image</p>
        <input type="file" name="image">
    </div>
    <div class='product_price_update'>
        <p>product Price</p>
        <input type="number" value="{{ $product->price }}" name="price">
    </div>
    <div class='product_type_update'>
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
@endsection
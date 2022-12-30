@extends('ViewPage.viewpage')
@section('content')
<div class="create_product_box">
    <h1>TẠO SẢN PHẨM MỚI</h1>
    <form action="" method="post" class="create_product_form">
        @csrf
        <div class="category_id">
            <p>Dòng sản phẩm</p>
            <select name="category_id" id="">
                @foreach($category as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach 
            </select>
        </div>
        <div class='product_name'>
            <p>Tên sản phẩm</p>
            <input type="text" name="name">
        </div>
        <div class='product_image'>
            <p>Hình ảnh</p>
            <input type="file" name="image" id='upload_image'>
        </div>
        <div class='product_price'>
            <p>Đơn giá sản phẩm</p>
            <input type="number" name='price'>
        </div>
        <div class='product_type'>
            <p>Phân loại</p>
            <select name="type">
                <option value="Nam">Nam</option>
                <option value="Nữ">Nữ</option>
                <option value="Bé Trai">Bé Trai</option>
                <option value="Bé Gái">Bé Gái</option>
            </select>
        </div>
        <button type="submit">
            Tạo mới
        </button>
    </form>
</div>
@endsection
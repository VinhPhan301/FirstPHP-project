@extends('ViewPage.viewpage')
@section('content')
<div class="create_detail_box">
    <h1>TẠO MỚI SẢN PHẨM CHI TIẾT</h1>
    <div id='create_product_box'>
        <form action="" method="post" class="create_detail_form">
            @csrf
            <div class="productDetaild_name create_detail_form_div">
                <p>Tên sản phẩm:</p>
                <p id="for_default_id">{{ $product->name }}</p>
                <input class="product_default_id" type="text" name='product_id' value='{{ $product->id }}'>
            </div>
            <div class='detail_color create_detail_form_div'>
                <p>Màu sắc: <span>@error('color') {{ $message }} @enderror</span></p>
                <input type="text" name="color">
            </div>
            <div class='detail_size create_detail_form_div'>
                <p>Kích cỡ: <span>@error('size') {{ $message }} @enderror</span></p>
                <input type="text" name='size'>
            </div>
            <div class='detail_thumbnail create_detail_form_div'>
                <p>Hình ảnh: <span>@error('thumbnail') {{ $message }} @enderror</span></p>
                <input type="file" name="thumbnail" id='sp_hinh'>
            </div>
            <div class='detail_storage create_detail_form_div'>
                <p>Số lượng kho: <span>@error('storage') {{ $message }} @enderror</span></p>
                <input type="number" name='storage'>
            </div>
            <div class='detail_storage create_detail_form_div'>
                <p>Đơn giá: <span>@error('price') {{ $message }} @enderror</span></p>
                <input type="text" name='price' value='{{ $product->price }}'>
            </div>
            <button type="submit" class="create_detail_btn">
                Tạo mới
            </button>
        </form>
        <div class="preview_picture">
            <img id='sp_hinh-upload'>
            <p>+</p>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#sp_hinh-upload').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Bắt sự kiện, ngay khi thay đổi file thì đọc lại nội dung và hiển thị lại hình ảnh mới trên khung preview-upload
    $("#sp_hinh").change(function(){
        readURL(this);
        $('.preview_picture p').css('display','none');
    });
</script>
@endsection
@extends('ViewPage.viewpage')
@section('content')
<div class="create_product_box">
    <h1>TẠO SẢN PHẨM MỚI</h1>
    <div id='create_product_box'>
        <form action="" method="post" class="create_product_form" enctype="multipart/form-data">
            @csrf
            <div class="category_id">
                <p>Dòng sản phẩm:</p>
                <select name="category_id" id="">
                    @foreach($category as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach 
                </select>
            </div>
            <div class='product_name'>
                <p>Tên sản phẩm: <span>@error('name') {{ $message }} @enderror</span></p>
                <input type="text" name="name" value="{{ old('name') }}">
            </div>
            <div class='product_image'>
                <p>Hình ảnh: <span>@error('image') {{ $message }} @enderror</span></p>
                <input type="file" name="image" id='sp_hinh' style="display:none">
                <label for="sp_hinh" class="label_for_form">Chọn hình ảnh </label>
            </div>
            <div class='product_price'>
                <p>Đơn giá sản phẩm: <span>@error('price') {{ $message }} @enderror</span></p>
                <input type="number" name='price' value="{{ old('price') }}">
            </div>
            <div class='product_type'>
                <p>Phân loại</p>
                <select name="type">
                    <option value="Nữ">Nữ</option>
                    <option value="Nam">Nam</option>
                    <option value="Bé Gái">Bé Gái</option>
                    <option value="Bé Trai">Bé Trai</option>
                </select>
            </div>
            <button type="submit">
                Tạo mới
            </button>
        </form>
        <div class="preview_picture">
            <img id='sp_hinh-upload'>
            <p>+</p>
        </div>
    </div>
</div>
@endsection
@section('script')
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

    $(document).ready(function(){
        $('#admin_ticked_product').css('background','#006977');   
    })
</script>
@endsection

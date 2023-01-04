@extends('ViewPage.viewpage')
@section('content')
<div class='category_content'>
    <h1>TẠO DANH MỤC MỚI</h1>
    <div id='create_product_box'>
        <form action="" method="post" class="create_category_form" enctype="multipart/form-data">
            @csrf
            <div class='category_name'>
                <p>Tên danh mục: <span>@error('name') {{ $message }} @enderror</span></p>
                <input type="text" name='name'>
            </div>
            <div class='category_image category_name'>
                <p>Hình ảnh: <span>@error('thumbnail') {{ $message }} @enderror</span></p>
                <input type="file" name="thumbnail" id='sp_hinh'>
            </div>
            <button type="submit" class='category_create'>
                Tạo mới
            </button>
        </form>
        <div class="preview_picture">
            <img id='sp_hinh-upload'/>
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
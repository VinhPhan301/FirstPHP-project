@extends('ViewPage.viewpage')
@section('content')
<div class='category_content'>
    <h1>CHỈNH SỬA DANH MỤC</h1>
    <form action="" method="post" class="create_category_form">
        @csrf
        <div class='category_name'>
            <p>Tên danh mục</p>
            <input type="text" name='name' value='{{ $categoryName }}'>
        </div>
        <div class='category_image'>
            <p>Hình ảnh</p>
            <label for="upload_image" class="fake_file">
                <div class="select_file">Select file</div>
                <input type="text" value='{{ $categoryThumbnail }}'>
            </label>
            <input type="file" name="thumbnail" id='upload_image'>
        </div>
        <button type="submit" class='category_create'>
            Chỉnh sửa
        </button>
    </form>
</div>
@endsection
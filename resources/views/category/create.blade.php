@extends('ViewPage.viewpage')
@section('content')
<div class='category_content'>
    <h1>TẠO DANH MỤC MỚI</h1>
    <form action="" method="post" class="create_category_form">
        @csrf
        <div class='category_name'>
            <p>Tên danh mục</p>
            <input type="text" name='name'>
        </div>
        <div class='category_image'>
            <p>Hình ảnh</p>
            <label for="upload_image" class="fake_file">
                <div class="select_file">Select file</div>
                <input type="text">
            </label>
            <input type="file" name="thumbnail" id='upload_image'>
        </div>
        <button type="submit" class='category_create'>
            Tạo mới
        </button>
    </form>
</div>
@endsection
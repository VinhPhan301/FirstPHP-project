@extends('ViewPage.viewpage')
@section('content')
<div class='category_content'>
    <h1>TẠO DANH MỤC MỚI</h1>
    <form action="" method="post" class="create_category_form" enctype="multipart/form-data">
        @csrf
        <div class='category_name'>
            <p>Tên danh mục</p>
            <input type="text" name='name' @error('name') placeholder="{{ $message }}" @enderror>
        </div>
        <div class='category_image'>
            <input type="file" name="thumbnail" id='image'>
        </div>
        @error('thumbnail')
            <span style="color:bla2ck">{{ $message }}</span>
        @enderror
        <button type="submit" class='category_create'>
            Tạo mới
        </button>
    </form>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function(e) {
        $('#image').change(function(){       
            let reader = new FileReader();
            reader.onload = (e) => { 
                $('#preview-image-before-upload').attr('src', e.target.result); 
            }
            reader.readAsDataURL(this.files); 
        });
    });
</script>
@endsection
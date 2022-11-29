@extends('ViewPage.viewpage')
@section('content')
<form action="" method="post" class="update_category_form">
    <p>Update Category Form</p>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
    @csrf
    <div class='category_name'>
        <p>Category Name</p>
        <input type="text" name="name">
    </div>
    <div class='category_image'>
        <p>Category Image</p>
        <input type="file" name="thumbnail">
    </div>
    <button type="submit">
        Update
    </button>
</form>
@endsection
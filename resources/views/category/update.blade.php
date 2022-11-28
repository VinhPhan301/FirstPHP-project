@extends('ViewPage.viewpage')
@section('content')
<form action="" method="post" class="update_category_form">
    <p>Update Category Form</p>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
    @csrf
    <div class='category_name'>
        <p>Category Name</p>
        <select name="name" id="" value=''>
            <option value="0">New Product</option>
            <option value="1">Daily fashion</option>
            <option value="2">Home wear</option>
            <option value="3">Special Products</option>
            <option value="4">Necessary Products</option>
        </select>
    </div>
    <div class='category_image'>
        <p>Category Image</p>
        <input type="file" name="thumbnail">
    </div>
    <div class='category_type'>
        <p>Category Type</p>
        <select name="type" id="">
            <option value="0">Men</option>
            <option value="1">Women</option>
            <option value="2">Girls</option>
            <option value="3">Boys</option>
        </select>
    </div>
    <button type="submit">
        Update
    </button>
</form>
@endsection
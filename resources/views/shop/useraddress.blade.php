@extends('Viewpage.viewuser')
@section('user_content')
<div class="user_address_header">
    <h3>Địa chỉ nhận hàng</h3>
    <a href=""><i class="fa-solid fa-circle-plus"></i> Thêm địa chỉ mới</a>
</div>
<div class="user_address_box">
   
</div>
@endsection
@section('script')
<script>
    $('.user_address_ticked a').css('color', '#63b1bc');
    $('.user_address_ticked i').css('color', '#63b1bc');
    $('.user_address_ticked').css('border-left', '4px solid #63b1bc');
    $('.user_address_ticked').css('padding-left', '26px');
</script>
@endsection
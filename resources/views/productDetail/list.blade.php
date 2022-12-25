@extends('ViewPage.viewpage')
@section('content')
<div class="listmsg">
    <div class="thongbao">
        <h3>Thông báo:</h3> 
        <p class="checkadd"><i class="fa-regular fa-circle-check"></i></p>
    </div>
    <p><span class="success">{{ $msg }}</span></p>
</div>
<div class="productname_in_detail">
    <p>{{ $product->name }} + {{ $product->type }}</p>
</div>
<div class='divtablefather' id='detail_divtablefather'>
    <div class='divtable' id='detail_table'>
        <table class="list_user_table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Màu sắc</th>
                    <th>Kích cỡ</th>
                    <th>Hình ảnh</th>
                    <th>Số lượng kho</th>
                    <th>Chỉnh sửa</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                 $index = 1;
                ?>
                @foreach($productDetail as $item)
                <tr>
                    <td>{{ $index++ }}</td>
                    <td>{{ $item->color }}</td>
                    <td>{{ $item->size }}</td>
                    <td><img src="{{ asset("picture/$item->thumbnail") }}" alt=""></td>
                    <td>{{ $item->storage }}</td>
                    <td>
                        <a style="color:black" onclick="confirmUpdate('{{ $item->id }}','{{ $item->product->name }}')">
                            <i class="fa-solid fa-screwdriver-wrench"></i>
                        </a>
                        <a href="{{ route('productDetail.update', ['id' => $item->id]) }}">
                            <p class='to_form_update_{{ $item->id }}'></p>
                        </a>
                    </td>
                    <td>
                        <a style="color:black" onclick="confirmDelete('{{ $item->id }}','{{ $item->product->name }}')">
                            <i class="fa-regular fa-trash-can"></i>
                        </a>
                        <a href="{{ route('productDetail.delete', ['id' => $item->id]) }}">
                            <p class='to_form_delete_{{ $item->id }}'></p>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <a id='createbut' style="color:black" href="{{ route('productDetail.create', ['id' => $product->id]) }}">
        <button class='tocreate_btn'>Tạo mới</button>
    </a>
</div>
<div class="alert_confirm_update">
    <p><i class="fa-solid fa-wrench"></i></p>
    <p>Xác nhận chỉnh sửa tài khoản <span class="span_name" style="font-weight: bold"></span></p>
    <p class="p_id_update"></p>
    <div>
        <button onclick="closeAlertUpdate()">Hủy</button>
        <button onclick="toFormUpdate()">Xác nhận</button>
    </div>
</div>
<div class="alert_confirm_delete">
    <p><i class="fa-regular fa-trash-can"></i></i></p>
    <p>Xác nhận xóa tài khoản <span class="span_name" style="font-weight: bold"></span></p>
    <p class="p_id_delete"></p>
    <div>
        <button onclick="closeAlertDelete()">Hủy</button>
        <button onclick="toFormDelete()">Xác nhận</button>
    </div>
</div>
<script>
    var message = document.querySelector('.success').innerHTML;

    if(message == ''){
        document.querySelector('.listmsg').style.display = 'none';
    }
    else{
        setInterval(function() {
        $('.listmsg').fadeOut(300);
        },1200)
    }

    function confirmUpdate(id, name){
        $('.alert_confirm_update').fadeOut(0)
        $('.alert_confirm_delete').fadeOut(0)
        $('.span_name').text(name)
        $('.p_id_update').text(id)
        $('.alert_confirm_update').fadeIn(300)
    }

    function closeAlertUpdate(){
        $('.alert_confirm_update').fadeOut(300)
    }
        
    function toFormUpdate(){
        var id = $('.p_id_update').text()
        $(`.to_form_update_${id}`).click()
        console.log(id);
    }

    function confirmDelete(id, name){
        $('.alert_confirm_delete').fadeOut(0)
        $('.alert_confirm_update').fadeOut(0)
        $('.span_name').text(name)
        $('.p_id_delete').text(id)
        $('.alert_confirm_delete').fadeIn(300)
    }

    function closeAlertDelete(){
        $('.alert_confirm_delete').fadeOut(300)
    }

    function toFormDelete(){
        var id = $('.p_id_delete').text()
        $(`.to_form_delete_${id}`).click()
    }
</script>
@endsection
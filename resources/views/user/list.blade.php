@extends('ViewPage.viewpage')
@section('content')
<div class="listmsg">
    <div class="thongbao">
        <h3>Thông báo:</h3> 
        <p class="checkadd"><i class="fa-regular fa-circle-check"></i></p>
    </div>
    <p><span class="success">{{ $msg }}</span></p>
</div>
<div class='divtablefather'>
    <div class='divtable'>
        <table class="list_user_table table-striped table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên tài khoản</th>
                    <th>Email</th>
                    <th>Địa chỉ</th>
                    <th>Số điện thoại</th>
                    <th>Ngày sinh</th>
                    <th>Quyền</th>
                    <th>Chỉnh sửa</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $index = 1;
                ?>
            @foreach($user as $item)
            <tr>
                <td>{{ $index++ }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->address }}</td>
                <td>{{ $item->phone }}</td>
                <td>{{ $item->date_of_birth }}</td>
                <td>
                    @if ($item->role == 'admin')
                    Quản trị viên
                    @elseif ($item->role == 'staff')
                    Nhân viên
                    @elseif ($item->role == 'manager')
                    Quản lý
                    @else
                    Người dùng
                    @endif                    
                </td>
                <td>
                    <a style="color:black" href="{{ route('user.account', ['id' => $item->id]) }}">
                        <i class="fa-solid fa-eye"></i>
                    </a>
                </td>
                <td id='hover_lock'>
                    @if(
                    ($userLogin->role == 'manager' && ($item->role == 'staff' || $item->role == 'user')) || 
                    ($userLogin->role == 'staff' && $item->role == 'user') || 
                    ($userLogin->role == 'admin' && $item->role !== 'admin')
                    )   
                        @if($item->status == 'locked')
                        <a style="color:black" onclick="confirmDelete('{{ $item->id }}','{{ $item->name }}')">
                            <i class="fa-solid fa-lock"></i>
                        </a>
                        <a href="{{ route('user.delete', ['id' => $item->id]) }}">
                            <span class="to_form_delete_{{ $item->id }}"></span>
                        </a>
                        @else
                        <a style="color:black" onclick="confirmUpdate('{{ $item->id }}','{{ $item->name }}')">
                            <i class="fa-solid fa-lock-open"></i>
                        </a>
                        <a href="{{ route('user.delete', ['id' => $item->id]) }}">
                            <span class="to_form_update_{{ $item->id }}"></span>
                        </a>
                        @endif
                    @else   
                    <a style="color:black" href="#" data-toggle="tooltip" data-placement="left" title="Không thể khóa">
                        <i class="fa-solid fa-ban"></i>
                    </a>

                    @endif
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <a id='createbut' style="color:black" href="create">
        <button class='tocreate_btn'>Tạo mới</button>
    </a>
    
</div>
<div class="alert_confirm_update">
    <p><i class="fa-solid fa-wrench"></i></p>
    <p>Xác nhận khóa tài khoản <span class="span_name" style="font-weight: bold"></span></p>
    <p class="p_id_update"></p>
    <div>
        <button onclick="closeAlertUpdate()">Hủy</button>
        <button onclick="toFormUpdate()">Xác nhận</button>
    </div>
</div>
<div class="alert_confirm_delete">
    <p><i class="fa-regular fa-trash-can"></i></i></p>
    <p>Xác nhận mở khóa tài khoản <span class="span_name" style="font-weight: bold"></span></p>
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

    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();   
    });
</script>
@endsection

@extends('ViewPage.viewpage')
@section('content')
<div class="listmsg">
    <div class="thongbao">
        <h3>Thông báo:</h3> 
        <p class="checkadd"><i class="fa-regular fa-circle-check"></i></p>
    </div>
    <p><span class="success">{{ $msg }}</span></p>
</div>
<div class="orderItem_box">
    <div class='orderItem_header'>
        <div class="in_orderItem_header">
            <h4><i class="fa-solid fa-box-open"></i> Thông tin đơn hàng</h4>
            <div>
                <p>Mã:</p>
                <p>CNF-DH-{{ $order->id }}</p>
            </div>
            <div>
                <p>Ngày tạo:</p>
                <p>{{ $order->created_at }}</p>
            </div>
            <div>
                <p>Trạng thái đơn hàng:</p>
                <p>
                    @if ($order->status == 'active')
                    Đơn hàng mới
                    @elseif($order->status == 'cancel')
                    Đơn bị hủy
                    @elseif($order->status == 'delivering')
                    Đã xuất kho
                    @else 
                    Hoàn thành
                    @endif
                </p>
            </div>
        </div>
        <div class="in_orderItem_header">
            <h4><i class="fa-solid fa-credit-card"></i> Thanh toán</h4>
            <div>
                <p>Hình thức thanh toán:</p>
                <p>{{ $order->payment_method }}</p>
            </div>
            <div>
                <p>Trạng thái thanh toán:</p>
                <p>
                    @if($order->status == 'complete' || $order->payment_method !== 'cod')
                    Đã thanh toán
                    @else
                    Chưa thanh toán
                    @endif
                </p>
            </div>
        </div>
        <div class="in_orderItem_header">
            <h4><i class="fa-solid fa-truck"></i> Giao hàng</h4>
            <div>
                <p>Hình thức giao hàng:</p>
                <p>Giao tận nơi</p>
            </div>
            <div>
                <p>Trạng thái giao hàng:</p>
                <p>
                    @if($order->status == 'complete')
                    Đã giao 
                    @elseif($order->status == 'delivering')
                    Đang giao
                    @else
                    Chưa giao 
                    @endif
                </p>
            </div>
        </div>
    </div>
</div>
<div class="orderItem_body">
    <div class="orderItem_body_right">
        <div>
            <h4><i class="fa-solid fa-location-dot"></i> Địa chỉ nhận hàng</h4>
            <input class="district" type="text" value="{{ $order->address }}">
        </div>
        <div class="user_infor_bill">
            <h4><i class="fa-regular fa-user"></i> Thông tin người mua</h4>
            <div>
                <p>Họ tên:</p>
                <h5>{{ $order->user->name }}</h5>
            </div>
            <div>
                <p>Email:</p>
                <h5>{{ $order->user->email }}</h5>
            </div>
            <div>
                <p>Số điện thoại:</p>
                <h5>{{ $order->user->phone }}</h5>
            </div>
            <div>
                <p>Địa chỉ:</p>
                <h5>{{ $order->user->address }}</h5>
            </div>
        </div>
    </div>
    <div class="orderItem_body_left">
        <h4><i class="fa-solid fa-cart-shopping"></i> Chi tiết đơn hàng</h4>
        <div class="orderItem_box_table">
            <table class="table table-striped in_orderItem_table">
                <thead>
                    <tr>
                        <th>Hình ảnh</th>
                        <th>Sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <p style="display:none">{{ $sum = 0 }}</p>
                    @foreach ($orderItems as $orderItem)
                    <p style="display:none">
                        {{ $orderItemThumbnail = $orderItem->productDetail->thumbnail }}
                    </p>
                    <tr>
                        <td>
                            <img src="{{ asset("picture/$orderItemThumbnail") }}">
                        </td>
                        <td>
                            <p>{{ $orderItem->productDetail->product->name }}</p>
                            <p style="display:none">{{ $img = $orderItem->productDetail->thumbnail }}</p>
                            <span id="orderItem_color"  style="background: url('{{ asset("picture/$img") }}')"></span>
                            <span>/</span>
                            {{ $orderItem->productDetail->size }}
                        </td>
                        <td>{{ $orderItem->quantity }}</td>
                        <td>{{ number_format($orderItem->price,0,'.','.')}} đ</td>
                        <td>{{ number_format($orderItem->total_price,0,'.','.') }} đ</td>
                    </tr>
                    <p style="display:none">{{ $sum += $orderItem->total_price }}</p>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class='create_bill'>
            <div class="create_bill_right">
                <h4><i class="fa-regular fa-clipboard"></i> Ghi chú đơn hàng</h4>
                <textarea>{{ $order->note }}</textarea>
            </div>
            <div class='create_bill_left'>
                <div>
                    <p>Tổng tiền hàng</p>
                    <p>{{ number_format($sum,0,'.','.') }} đ</p>
                </div>
                <div>
                    <p>Phí vận chuyển</p>
                    <p>0 đ</p>
                </div>
                <div>
                    @if($order->discount !== 'null')
                    <p>Giảm giá ({{ $order->discount }}%)</p>
                    <p style="color: red">                       
                        {{ number_format(($sum * $order->discount)/100,0,'.','.') }} đ               
                    </p>
                    @else
                    <p>Giảm giá</p>
                    <p style="color: red">                       
                        0 đ               
                    </p>
                    @endif
                </div>
                <div>
                    <p>Tổng giá trị đơn hàng</p>
                    <p>
                        @if ($order->discount !== 'null')
                            {{ number_format($sum - ($sum * $order->discount)/100,0,'.','.') }} đ
                        @elseif ($order->discount === 'null')
                            {{ number_format($sum,0,'.','.') }} đ
                        @endif
                    </p>
                </div>
                <div>
                    <p></p>
                    <button>
                        @if($order->status == 'active')
                            <a onclick="confirmDelete('{{ $order->id }}')">
                                <i class="fa-solid fa-ban"></i> Hủy đơn hàng
                            </a>
                            <a style="display: none" href="{{ route('order.adminUpdate', ['id' => $order->id, 'status' => 'soldout']) }}">
                                <p class='to_form_delete_{{ $order->id }}'></p>
                            </a>
                        </button>
                        <button>
                            <a onclick="confirmUpdate('{{ $order->id }}')">
                                <i class="fa-solid fa-money-bill-1-wave"></i> Xác nhận vận chuyển
                                <a style="display: none" href="{{ route('order.adminUpdate',['id' => $order->id, 'status' => $order->status]) }}">
                                    <p class='to_form_update_{{ $order->id }}'></p>
                                </a>
                            </a>                          
                        @elseif ($order->status == 'delivering')
                            <a id="complete_bill" href="{{ route('order.adminUpdate',['id' => $order->id, 'status' => $order->status]) }}">
                                <i class="fa-solid fa-money-bill-1-wave"></i> Hoàn tất đơn hàng
                            </a>                       
                        @elseif ($order->status == 'complete')
                        <a id="complete_bill" href="">
                            <i class="fa-solid fa-money-bill-1-wave"></i> Đơn hàng đã hoàn thành
                        </a>
                        @elseif ($order->status == 'cancelRequest')
                        <a id="cancel_bill" href="{{ route('order.adminUpdate',['id' => $order->id, 'status' => $order->status]) }}">
                            <i class="fa-solid fa-ban"></i> Xác nhận hủy
                        </a>
                        @else
                        <a id="cancel_bill" onclick="confirmDelete('{{ $order->id }}')">
                            <i class="fa-solid fa-trash-can"></i> Xóa đơn hàng
                            <a style="display: none" href="{{ route('order.adminUpdate',['id' => $order->id, 'status' => $order->status]) }}">
                                <p class='to_form_delete_{{ $order->id }}'></p>
                            </a>
                        </a>
                        @endif
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="alert_confirm_update">
    <p><i class="fa-solid fa-wrench"></i></p>
    <p style="margin-top: 15px">Xác nhận xuất kho <span class="span_name" style="font-weight: bold"></span></p>
    <p class="p_id_update"></p>
    <div>
        <button onclick="closeAlertUpdate()">Hủy</button>
        <button onclick="toFormUpdate()">Xác nhận</button>
    </div>
</div>
<div class="alert_confirm_delete">
    <p><i class="fa-regular fa-trash-can"></i></p>
    <p style="margin-top: 15px">Xác nhận hủy đơn hàng <span class="span_name" style="font-weight: bold"></span></p>
    <p class="p_id_delete"></p>
    <div>
        <button onclick="closeAlertDelete()">Hủy</button>
        <button onclick="toFormDelete()">Xác nhận</button>
    </div>
</div>
@endsection
@section('script')
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
        $('#admin_ticked_order').css('background','#006977');   
    })
</script>
@endsection
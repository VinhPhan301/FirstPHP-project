@extends('Viewpage.viewuser')
@section('user_content')
<div class='order_view'>
    <p class="userId" style="display: none">{{ $user->id }}</p>
    <div class='order_content'>
        <table>
            <thead>
                <tr>
                    <th>Mã đơn hàng</th>
                    <th>Số lượng</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Ngày mua</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <p style="display:none">{{ $sumtotal = 0 }}</p>
                <tr class='order_{{ $order->status }}_row' id='order_father'>
                    <td class="hiden_orderId">{{ $order->id }}</td>
                    <td onclick="showOrderItem({{ $order->id }})" class="order_code">CNF-DH-{{ $order->id }}</td>
                    <td onclick="showOrderItem({{ $order->id }})">{{ $order->total }}</td>
                    <p style="display:none">
                        @foreach($order->orderItem as $orderItem)
                        {{ $sumtotal += (int)$orderItem->total_price }}
                        @endforeach
                    </p>
                    <td onclick="showOrderItem({{ $order->id }})">
                        {{ number_format($sumtotal,0,'.','.') }} đ
                    </td onclick="showOrderItem({{ $order->id }})">
                    @if ($order->status == 'active')
                    <td onclick="showOrderItem({{ $order->id }})">Đã đặt</td>
                    @elseif ($order->status == 'cancel')
                    <td onclick="showOrderItem({{ $order->id }})">Đã hủy</td>
                    @elseif ($order->status == 'complete')
                    <td onclick="showOrderItem({{ $order->id }})">Hoàn thành</td>
                    @elseif ($order->status == 'delivering')
                    <td onclick="showOrderItem({{ $order->id }})">Đang giao</td>
                    @else
                    <td onclick="showOrderItem({{ $order->id }})">Chờ xác nhận hủy</td>
                    @endif
                    <td onclick="showOrderItem({{ $order->id }})">{{ date('d-m-Y', strtotime($order->created_at)) }}</td>
                    @if ($order->status == 'active')
                    <td>
                        <p class="can_cancel">
                            <i class="fa-solid fa-ban"></i> Hủy đơn
                            <span class='cancelRequest_button' style="display:none">{{ $order->status }}</span>
                        </p>
                    </td>
                    @else
                    <td>
                        <p class="cannot_cancel">
                            <i class="fa-solid fa-ban"></i> Hủy đơn
                            <span class='cancelRequest_button' style="display:none">{{ $order->status }}</span>
                        </p>
                    </td>
                    @endif
                </tr>
                <div class="show_orderItem order_father_{{ $order->id }}">
                    <div class="show_orderItem_header">
                        <p>CNF-DH-{{ $order->id }}</p>
                        <p>{{ $order->total }}</p>
                        <p>{{ number_format($sumtotal,0,'.','.') }} đ</p>
                        <p>
                            @if ($order->status == 'active')
                            <span style="color:rgb(0, 140, 255)">Đã đặt</span>
                            @elseif ($order->status == 'cancel')
                            <span style="color:rgb(255, 18, 18)">Đã hủy</span>
                            @elseif ($order->status == 'complete')
                            <span style="color:rgb(0, 206, 0)">Hoàn thành</span>
                            @elseif ($order->status == 'delivering')
                            <span style="color:rgb(255, 117, 32)">Đang giao</span>
                            @else
                            <span style="color:red">Chờ xác nhận hủy</span>
                            @endif
                        </p>
                        <p>{{ date('d-m-Y', strtotime($order->created_at)) }}</p>
                        <p style="border:none" class="backto_order"><i class="fa-solid fa-rotate-left"></i> Quay lại</p>
                    </div>
                    <p class="orderItem_detail">Chi tiết đơn hàng:</p>
                    <div class="show_orderItem_item">
                        @foreach($order->orderItem as $orderItem)
                        <div class='show_orderItem_item_div'>
                            <p style="display:none">{{ $thumbnail = $orderItem->productDetail->thumbnail }}</p>
                            <div>
                                <img class='orderItem_big_picture' src="{{ asset("picture/$thumbnail") }}">
                            </div>
                            <div class="vertical_center">
                                <p>
                                    <a href="{{ route('shop.product',['id' => $orderItem->productDetail->product->id]) }}">{{ $orderItem->productDetail->product->name }}</a>
                                </p>
                                <p>
                                    <span class="orderItem_small_picture" style="background: url({{ asset("picture/$thumbnail") }})"></span>
                                    <span>/</span>
                                    <span>{{ $orderItem->productDetail->size }}</span>
                                </p>
                            </div>
                            <div class="vertical_center">
                                <p>Đơn giá</p>
                                <p>{{ number_format($orderItem->price,0,'.','.') }} đ</p>
                            </div>
                            <div class="vertical_center">
                                <p>Số lượng</p>
                                <p>x{{ $orderItem->quantity }}</p>
                            </div>
                            <div class="vertical_center">
                                <p>Thành tiền</p>
                                <p>{{ number_format($orderItem->total_price,0,'.','.') }} đ</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class='order_status'>
        <p onclick='orderStatus("all")' class="all">Tất cả</p>
        @foreach ($orderStatus as $status)
        @if ($status == 'active')
        <p onclick='orderStatus("{{ $status }}")' class="{{ $status }}">Đã đặt</p>
        @elseif ($status == 'cancel')
        <p onclick='orderStatus("{{ $status }}")' class="{{ $status }}">Đã xóa</p>
        @elseif ($status == 'complete')
        <p onclick='orderStatus("{{ $status }}")' class="{{ $status }}">Hoàn thành </p>
        @else
        <p onclick='orderStatus("{{ $status }}")' class="{{ $status }}">Đang giao</p>
        @endif
        @endforeach
    </div>
</div>
<div class="confirm_cancel">
    <h3>Xác nhận hủy đơn hàng <span class="order_code_cancel"></span></h3>
    <h3>Lý do hủy đơn hàng</h3>
    <p class="hiden_cancel_orderId"></p>
    <div class="box_reason">
        <p><input type="checkbox"> Đặt nhầm đơn</p>
        <p><input type="checkbox"> Muốn thay đổi kích cỡ / màu sắc</p>
        <p><input type="checkbox"> Muốn đặt sản phẩm khác</p>
        <p><input type="checkbox"> Muốn thay đổi địa chỉ / thông tin nhận hàng</p>
        <p><input type="checkbox"> Không muốn đặt nữa</p>
        <p><input type="text" placeholder="Ghi chú" class="input_note"></p>
    </div>
    <div class="cancel_button">
        <button onclick="ConfirmCancel()">Xác nhận</button>
        <button onclick="closeCancelConfirm()">Quay lại</button>
    </div>
</div>
@endsection
@section('script')
<script>
    $('.user_order_ticked a').css('color', '#63b1bc');
    $('.user_order_ticked i').css('color', '#63b1bc');

    function orderStatus(status) {
        var url = "{{ route('shop.userorder', ":id") }}?status=" + status;
        url = url.replace(':id', {{ $user->id }});
        $('.order_content').load(`${url} .order_content`)    

        $('.order_status p').removeClass('order_status_chosen')
        $(`.${status}`).addClass('order_status_chosen')
    }

    $('.can_receive').click(function() {
        var orderId = $('.receive_button_id').text();
        var status = $('.receive_button').text();

        $.get('{{ route('order.update') }}', {'id': orderId, 'status': status},  function( data ) {
            if ( data !== null ) {
                $('.order_view').load('{{ route('shop.userorder', ['id => $user->id']) }} .order_view')
            
            } else {
                alert('Huy that bai')
            } 
        });
    })

    function closeCancelConfirm() {
        $(".confirm_cancel").slideUp(300)
    }

    $('.can_cancel').click(function() {
        var orderCode = $(this).parent().siblings('.order_code').text()
        var orderId = $(this).parent().siblings('.hiden_orderId').text()
        $('.order_code_cancel').text(orderCode)
        $('.hiden_cancel_orderId').text(orderId)
        $(".confirm_cancel").slideDown(300)
    })

    function ConfirmCancel() {
        var orderId = $('.hiden_cancel_orderId').text();
        var status = $('.cancelRequest_button').text();
        $.get('{{ route('order.update') }}', {'id': orderId, 'status': status},  function( data ) {
            if ( data !== null ) {
                $('.order_view').load('{{ route('shop.userorder', ['id => $user->id']) }} .order_view')
            closeCancelConfirm()
            } else {
                alert('Huy that bai')
            } 
        });
    }

    function showOrderItem(id){
        $(`.order_father_${id}`).slideDown(600)
    }

    $('.backto_order').click(function(){
        $('.show_orderItem').slideUp(600);
    })
</script>
@endsection
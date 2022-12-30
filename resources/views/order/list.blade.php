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
                    <th>Mã đơn</th>
                    <th>Khách hàng</th>
                    <th>Trạng thái</th>
                    <th>Thanh toán</th>
                    <th>Ngày tạo</th>
                    <th>Tổng tiền</th>
                    <th>Xem</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                @if($order->status !== 'deleted')
                <p style="display:none">{{ $sumtotal = 0 }}</p>
                <tr>
                    <td>CNF-DH-{{ $order->id }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td class='order_status_{{ $order->status }} order_status'>
                        @if ($order->status === 'active')
                        <p>
                            <i class="fa-solid fa-cart-shopping"></i> Đã đặt
                        </p>
                        @elseif ($order->status === 'delivering')
                        <p>
                            <i class="fa-solid fa-truck-fast"></i> Đang giao
                        </p>
                        @elseif ($order->status === 'cancel')
                        <p>
                            <i class="fa-solid fa-ban"></i> Đã hủy
                        </p>
                        @elseif ($order->status === 'complete')
                        <p>
                            <i class="fa-regular fa-circle-check"></i> Đã hoàn thành
                        </p>
                        @else
                        <p>
                            <i class="fa-regular fa-trash-can"></i> Yêu cầu hủy
                        </p>
                        @endif
                    </td>
                    <td class='payment_{{ $order->payment_method }}'>{{ $order->payment_method }}</td>
                    <td>{{ date('d-m-Y', strtotime($order->created_at)) }}</td>
                    <p style="display:none">
                        @foreach($order->orderItem as $orderItem)
                        {{ $sumtotal += (int)$orderItem->total_price }}
                        @endforeach
                    </p>
                    @if ($order->discount !== 'null')
                    <td>
                        <p style="font-size:11px; text-decoration: line-through; color:red; font-weight:bold">{{  number_format($sumtotal,0,'.','.')  }} đ</p>
                        <p style="font-size:17px; font-weight: bold">{{  number_format(($sumtotal-$sumtotal*$order->discount / 100 ),0,'.','.')  }} đ</p>
                    </td>
                    @else
                    <td style="font-weight: bold">
                        {{ number_format($sumtotal,0,'.','.') }} đ
                    </td>
                    @endif
                    <td>
                        <a class='order_item' href="{{ route('order.item',['id' => $order->id]) }}">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    var message = document.querySelector('.success').innerHTML;
    if(message == ''){
     document.querySelector('.listmsg').style.display = 'none';
    }
    else{
     setInterval(function() {
     $('.listmsg').slideUp();
    },2000)
    }
</script>
@endsection
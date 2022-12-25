@extends('ViewPage.viewpage')
@section('content')
<div class="listmsg">
    <div class="thongbao">
        <h3>Thong bao:</h3> 
        <p class="checkadd"><i class="fa-regular fa-circle-check"></i></p>
    </div>
    <p><span class="success">{{ $msg }}</span></p>
</div>
<div class='divtablefather'>
    <div class='divtable'>
        <table class="list_user_table">
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
                <p style="display:none">{{ $sumtotal = 0 }}</p>
                <tr>
                    <td>CNF-DH-{{ $order->id }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td class='order_status_{{ $order->status }} order_status'>
                        <p>
                            {{ $order->status }}
                        </p>
                    </td>
                    <td class='payment_{{ $order->payment_method }}'>{{ $order->payment_method }}</td>
                    <td>{{ date('d-m-Y', strtotime($order->created_at)) }}</td>
                    <p style="display:none">
                        @foreach($order->orderItem as $orderItem)
                        {{ $sumtotal += (int)$orderItem->total_price }}
                        @endforeach
                    </p>
                    @if ($order->status == 'cancel')
                    <td style="text-decoration: line-through">
                        {{ number_format($sumtotal,0,'.','.') }} đ
                    </td>
                    @else
                    <td>
                        {{ number_format($sumtotal,0,'.','.') }} đ
                    </td>
                    @endif
                    <td>
                        <a class='order_item' href="{{ route('order.item',['id' => $order->id]) }}">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                    </td>
                </tr>
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
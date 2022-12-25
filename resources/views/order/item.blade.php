@extends('ViewPage.viewpage')
@section('content')
<div class="listmsg">
    <div class="thongbao">
        <h3>Thong bao:</h3> 
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
                    Đang giao
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
                    @if($order->status == 'complete')
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
            <h4><i class="fa-solid fa-warehouse"></i> Kho xuất hàng</h4>
            <select name="" >
                <option value="">CANIFA - 24 Nguyễn Hữu Thọ</option>
                <option value="">CANIFA - 38 Kim Đồng, Hà Nội</option>
                <option value="">CANIFA - TTTM Royal city</option>
                <option value="">CANIFA - Times City</option>
            </select>
        </div>
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
            <table>
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
                            <span class="orderItem_color"style="background:{{ $orderItem->productDetail->color }}"></span>
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
                    <p>
                        @if($sum >= 1000000)
                        0 đ
                        @else
                        30.000 đ
                        @endif
                    </p>
                </div>
                <div>
                    <p>Giảm giá</p>
                    <p>
                        @if($sum >= 1000000)
                        {{ number_format(($sum * 7 )/ 100,0,'.','.') }} đ
                        @else
                        0 đ
                        @endif
                    </p>
                </div>
                <div>
                    <p>Tổng giá trị đơn hàng</p>
                    <p>
                        @if($sum >= 1000000)
                        {{ number_format($sum - ($sum * 7 )/ 100,0,'.','.') }} đ
                        @else
                        {{ number_format($sum + 30000,0,'.','.') }} đ
                        @endif
                    </p>
                </div>
                <div>
                    <p></p>
                    <button>
                        @if($order->status == 'active')
                        <a href="{{ route('order.adminUpdate',['id' => $order->id, 'status' => $order->status]) }}">
                            <i class="fa-solid fa-money-bill-1-wave"></i> Xác nhận vận chuyển
                        </a>
                        @elseif ($order->status == 'delivering')
                        <a id="delivering_bill" href="">
                            <i class="fa-solid fa-truck"></i> Đơn hàng đã xuất
                        </a>
                        @elseif ($order->status == 'complete')
                        <a id="complete_bill" href="{{ route('order.adminUpdate',['id' => $order->id, 'status' => $order->status]) }}">
                            <i class="fa-solid fa-money-bill-1-wave"></i> Hoàn tất đơn hàng
                        </a>
                        @elseif ($order->status == 'cancelRequest')
                        <a id="cancel_bill" href="{{ route('order.adminUpdate',['id' => $order->id, 'status' => $order->status]) }}">
                            <i class="fa-solid fa-ban"></i> Xác nhận hủy
                        </a>
                        @else
                        <a id="cancel_bill" href="{{ route('order.adminUpdate',['id' => $order->id, 'status' => $order->status]) }}">
                            <i class="fa-solid fa-trash-can"></i> Xóa đơn hàng
                        </a>
                        @endif
                    </button>
                </div>
            </div>
        </div>
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
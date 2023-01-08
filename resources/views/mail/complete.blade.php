<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/mail.css') }}">
    <title>Document</title>
</head>
<body style="width: 60%; margin: 0 auto;">
    <header style="
        font-size: 20px;
        background: #63b1bc;
        color: white;
        padding: 10px 20px;
        text-align: center;
        ">
        <h1 style="
        margin: 0px
        ">CNF SHOP</h1>
    </header>
    <h2 style="color:#27313a">Xin chào {{ $name }}</h2>
    <h2 style="color:#27313a">Đơn hàng CNF-DH-{{ $order->id }} của quý khách đã giao thành công.</h2>
    <h3 style="color:#27313a">Cảm ơn bạn vì đã sử dụng dịch vụ của chúng tôi và mong rằng bạn sẽ tiếp tục đồng hành cùng chúng tôi trong tương lai.</h3>
    <div style="
    padding: 10px 20px;
    border: 3px solid #63b1bc;
    ">
        <h3>THÔNG TIN ĐƠN HÀNG: </h3>
        <div style="
        display: flex;
        justify-content: space-around;
        ">
            <div>
                <p style="font-size:17px; font-weight:bold">Thông tin tài khoản</p>
                <p>Tên khách hàng: {{ $order->user->name }}</p>
                <p>Email: {{ $order->user->email }}</p>
                <p>Số điện thoại: {{ $order->user->phone }}</p>
            </div>
            <div style="margin-left: 150px">
                <p style="font-size:17px; font-weight:bold">Địa chỉ giao hàng</p>
                <p>Tên người nhận: {{ $order->user->name }}</p>
                <p>Số điện thoại: {{ $order->phone }}</p>
                <p>Địa chỉ: {{ $order->address }}</p>
            </div>
        </div>
        <p style="font-size:18px; font-weight:bold">Phương thức thanh toán: {{ $order->payment_method }}</p>
        <p style="font-size:18px; font-weight:bold">Ghi chú: {{ $order->note }}</p>
    </div>
    <h1 style="text-align:center">Thông tin chi tiết đơn hàng</h1>
    <table style="
    width: 100%;
    font-weight: bold;
    border-collapse: collapse;
    ">
        <thead>
            <tr style="
            background: #27313a;
            color: white;
            ">
                <th style='padding: 10px 20px'>Tên sản phẩm</th>
                <th style='padding: 10px 20px'>Số lượng</th>
                <th style='padding: 10px 20px'>Đơn giá</th>
                <th style='padding: 10px 20px'>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->orderItem as $orderItem)
            <tr style="text-align: center;border: 2px solid #27313a; border-top: none ">
                <td style="padding: 10px 20px;">
                    <p style='margin:0'>{{ $orderItem->productDetail->product->name }}</p>
                    <span>Kích cỡ:{{ $orderItem->productDetail->size }}/Màu sắc:{{ $orderItem->productDetail->color }}</span>
                </td>
                <td style="padding: 10px 20px;">{{ $orderItem->quantity }}</td>
                <td style="padding: 10px 20px;">{{ number_format($orderItem->price,0,'.','.')}} đ</td>
                <td style="padding: 10px 20px;">{{ number_format($orderItem->total_price,0,'.','.') }} đ</td>
            </tr>
            @endforeach
            <tr style="border: 2px solid #27313a; border-top: none ">
                <td style="padding: 10px 20px;">Tổng giá trị đơn hàng</td>
                <td style="padding: 10px 20px;"></td>
                <td style="padding: 10px 20px;"></td>
                <td style="text-align: right;padding: 10px 20px">
                    <?php
                    $sum = 0
                    ?>
                    @foreach($order->orderItem as $orderItem)
                    <?php
                    $sum += $orderItem->total_price
                    ?>
                    @endforeach
                    {{ number_format($sum,0,'.','.') }} đ
                </td>
            </tr>
            <tr style="border: 2px solid #27313a; border-top: none ">
                <td style="padding: 10px 20px;">Mã giảm giá</td>
                <td style="padding: 10px 20px;"></td>
                <td style="padding: 10px 20px;"></td>
                <td style="text-align: right;padding: 10px 20px">
                    @if ($order->discount !== 'null')
                    CNF-DC-{{ $order->discount }}
                    @else
                    Không có
                    @endif
                </td>
            </tr>
            <tr style="border: 2px solid #27313a; border-top: none ">
                <td style="padding: 10px 20px;">Giảm giá ( {{ $order->discount }}% )</td>
                <td style="padding: 10px 20px;"></td>
                <td style="padding: 10px 20px;"></td>
                <td style="text-align: right;padding: 10px 20px; color:red">
                    @if($order->discount !== 'null')
                    {{ number_format(($sum * $order->discount / 100),0,'.','.') }} đ
                    @else
                    0 đ
                    @endif
                </td>
            </tr>
            <tr style="border: 2px solid #27313a; border-top: none ">
                <td style="padding: 10px 20px;">Phí vận chuyển</td>
                <td style="padding: 10px 20px;"></td>
                <td style="padding: 10px 20px;"></td>
                <td style="text-align: right;padding: 10px 20px">
                    @if($sum >= 1000000)
                    Miễn phí vận chuyển
                    @else
                    30.000 đ
                    @endif
                </td>
            </tr>
            <tr style="border: 2px solid #27313a; border-top: none ">
                <td style="padding: 10px 20px;">Tổng thanh toán</td>
                <td style="padding: 10px 20px;"></td>
                <td style="padding: 10px 20px;"></td>
                <td style="text-align: right;padding: 10px 20px">
                    @if($sum >= 1000000)
                        @if ($order->discount !== 'null')
                        {{ number_format($sum - ($sum * $order->discount / 100),0,'.','.') }} đ
                        @else
                        {{ number_format($sum,0,'.','.') }} đ
                        @endif
                    @else
                        @if ($order->discount !== 'null')
                        {{ number_format($sum - ($sum * $order->discount / 100)+30000,0,'.','.') }} đ
                        @else
                        {{ number_format($sum+30000,0,'.','.') }} đ
                        @endif
                    @endif
                </td>
            </tr>
        </tbody>
    </table>
    <div style="
    text-align: center;
    margin-top: 40px;
    background: #63b1bc;
    padding: 20px;
    color:white
    ">
        <h2 style="margin:0">Kết nối với chúng tôi</h2>
        <h3>
            CÔNG TY CỔ PHẦN CANIFA <br>
            Trụ sở chính: Số 688, Đường Quang Trung, Phường La Khê, Quận Hà Đông, Hà Nội, Việt Nam <br>
            Số điện thoại: +8424 - 7303.0222 <br>
            Địa chỉ email: hello@canifa.com <br>
        </h3>
    </div>
</body>
</html>
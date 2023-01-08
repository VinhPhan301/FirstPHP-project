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
    <h1 style="color:#27313a">Cảm ơn bạn vì đã sử dụng dịch vụ của chúng tôi</h1>
    <h2 style="color:#27313a">Chúng tôi xin gửi tặng bạn 2 mã khuyến mãi cho 2 lần mua hàng đầu tiên khi thanh toán online</h2>
    <table style="
    width: 100%;
    margin-top: 30px;
    border-collapse: collapse;
    ">
        <thead>
            <tr style="
            background: #27313a;
            color: white;
            ">
                <th style='padding: 10px 20px'>STT</th>
                <th style='padding: 10px 20px'>Mã Khuyến mại</th>
                <th style='padding: 10px 20px'>Giảm giá</th>
                <th style='padding: 10px 20px'>Ngày tạo</th>
            </tr>
        </thead>
        <tbody>
            @php
                $index = 1
            @endphp
            @foreach($voucher as $item)
            <tr style="font-weight: bold">
                <td style="text-align: center;
                padding: 10px 20px;
                border: 2px solid #63b1bc;">{{ $index ++ }}</td>
                <td style="text-align: center;
                padding: 10px 20px;
                border: 2px solid #63b1bc;">{{ $item->name }}</td>
                <td style="text-align: center;
                padding: 10px 20px;
                border: 2px solid #63b1bc;">{{ $item->discount }}%</td>
                <td style="text-align: center;
                padding: 10px 20px;
                border: 2px solid #63b1bc;">{{ $item->created_at }}</td>
            </tr>
            @endforeach
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/user.css') }}">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>SHOP CNF</title>
</head>
<body>
    <form class="loginform" action="" method="post">
        @csrf
        <p class="login_paw"><i class="fa-solid fa-paw"></i></p>
        <div class="div_input">
            <p>Nhập Email: </p>
            <input type="text" @error('email') placeholder="{{ $message }}" @enderror name="email"/>
        </div>
        <div class="div_input">
            <p>Nhập mật khẩu: <span style="color:red; font-size:12px">{{ $msg }}</span></p>
            <input type="password" @error('password') placeholder="{{ $message }}" @enderror name="password">
        </div>
        <div class="div_button">
            <button type="submit">Đăng nhập</button>
        </div>
    </form>
</body>
</html>
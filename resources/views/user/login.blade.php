<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/user.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>SHOP CNF</title>
</head>
<body>
    <form class="loginform" action="" method="post">
        @csrf
        <p><i class="fa-solid fa-paw"></i></p>
        <input type="text" placeholder="Nhập Email" name="email">
        <br>
        <input type="password" placeholder="Nhập mật khẩu" name="password">
        <br>
        @if (session('status'))
        <p style="color:red" > {{ session('status') }}</p>
        @endif
        <div style="display: flex; justify-content: space-between">
            <button type="submit">Dăng nhập</button>
        </div>
    </form>
</body>
</html>
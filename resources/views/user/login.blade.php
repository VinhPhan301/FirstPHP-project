<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/user.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
</head>
<body>
    @if (session('status'))
        <p style="color:red" > {{ session('status') }}</p>
    @endif
    <form class="loginform" action="" method="post">
        @csrf
        <p><i class="fa-solid fa-paw"></i></p>
        <input type="text" placeholder="Enter email" name="email">
        <br>
        <input type="password" placeholder="Enter password" name="password">
        <br>
        <div style="display: flex; justify-content: space-between">
            <button type="submit">Log in</button>
        </div>
    </form>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/user.css') }}">
    <link rel = "icon" href ="{{ asset("thumbnail/favicon-16x16.ico") }}" type = "image/x-icon">
    <title>CNF ADMIN</title>
</head>
<header>
    <div class='headerleft'>
        <p class='dissidebar'>
            <i class="fa-solid fa-bars"></i>
        </p>
    </div>
    <div class="headermid">
        <div class="placeholder2">
            <i onclick="searchAccount()" class="fa-solid fa-magnifying-glass"></i>
        </div>
        <input class="whatyoulookingfor" type="text" placeholder="Tìm kiếm tài khoản ...">
        <div class="search_suggest">
            <ul>

            </ul>
        </div>
    </div>
    <div class='headerright'>
        <div><img class="pic" src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/21/Flag_of_Vietnam.svg/2000px-Flag_of_Vietnam.svg.png" alt=""></div>
        <div>
            <p class="disbookmark">
                <i class="fa-regular fa-bookmark "></i>
            </p>
            <p class='nonebookmark'>
                <i class="fa-solid fa-bookmark "></i>
            </p>
        </div>
        <div>
            <p class="disfind">
                <i class="fa-solid fa-magnifying-glass"></i>
            </p>
        </div>
        <div>
            <p class='disstar'>
                <i class="fa-regular fa-star "></i>
            </p>
            <p class='nonestar'>
                <i class="fa-solid fa-star "></i>
            </p>
        </div>
    </div>
</header>
<body>
    <div class="boxsidebar" id="toggle">
        <div class="sidebar">
            <div class="sidebarheader">
                <div>
                    <p><i class="fa-regular fa-gem"></i></p>
                </div>
                <div class="sideleftheader">
                    <p></p>
                    <p class="logout"><i class="fa-regular fa-circle-user"></i></p>
                </div>
                <div class="logoutchild">
                    <a href='{{ route('user.logout') }}'>Đăng xuất 
                        <span><i class="fa-solid fa-arrow-right-from-bracket"></i></span>
                    </a>
                    <a href="{{ route('user.update', ['id' => $id]) }}">Tài khoản
                        <span><i class="fa-solid fa-gear"></i></span></span>
                    </a>
                </div>
            </div>
            <div class="sidebaruserpic">
                @if ($userLogin->avatar === null )
                <img src="https://ps.w.org/user-avatar-reloaded/assets/icon-256x256.png?rev=2540745">
                @else
                <img src="{{ asset("picture/$userLogin->avatar") }}">
                @endif
                <p class="username">{{ $userLogin->name }}</p>
                <p class="about">
                    @if ($userLogin->role == 'admin')
                    Quản trị viên
                    @elseif($userLogin->role == 'manager') 
                    Quản lý
                    @elseif ($userLogin->role == 'staff')
                    Nhân viên
                    @endif
                    : 
                    {{ $userLogin->email }}
                </p>
            </div>
            <div class="dashbar">
                <h1>Quản lý chung</h1>
            </div>
            @if($userLogin->role !== 'staff')
            <div class='actions'>
                <div class="actionicon">
                    <div class="fatherlist" id="admin_ticked_account">
                        <p><i class="fa-regular fa-clipboard"></i></p>
                        <p>Tài khoản</p>
                    </div>
                    <div class='childlist'>
                        <ul>
                            <li> 
                                <a href="{{ route('user.list') }}">
                                    <i class="fa-solid fa-users"></i> 
                                    <span>
                                    Danh sách
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('user.create') }}">
                                    <i class="fa-solid fa-users"></i> 
                                    <span>
                                    Tạo mới
                                    </span>
                                </a>
                            </li>                           
                        </ul>
                    </div>
                </div>
                <div class="actionicon">
                    <div class="fatherlist" id="admin_ticked_category">
                        <p><i class="fa-regular fa-clipboard"></i></p>
                        <p>Danh mục</p>
                    </div>
                    <div class='childlist' >
                        <ul>
                            <li >
                                <a href="{{ route('category.list') }}">
                                    <i class="fa-solid fa-users"></i> 
                                    <span>
                                    Danh sách
                                    </span>
                                </a>
                            </li>
                            <li >
                                <a href="{{ route('category.create') }}">
                                    <i class="fa-solid fa-users"></i> 
                                    <span>
                                    Thêm mới
                                    </span>
                                </a>
                            </li>                        
                        </ul>
                    </div>
                
                </div>
                <div class="actionicon">
                    <div class="fatherlist" id="admin_ticked_product">
                        <p><i class="fa-regular fa-clipboard"></i></p>
                        <p>Sản phẩm</p>
                    </div>
                    <div class='childlist'>
                        <ul>
                            <li>
                                <a href="{{ route('product.list') }}">
                                    <i class="fa-solid fa-users"></i> 
                                    <span>
                                    Danh sách
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('product.create') }}">
                                    <i class="fa-solid fa-users"></i> 
                                    <span>
                                    Thêm mới
                                    </span>
                                </a>
                            </li>                   
                        </ul>
                    </div>
                
                </div>
            </div>
            @else
            <div class='actions'>
                <div class="actionicon">
                    <div class="fatherlist" id="admin_ticked_account">
                        <p><i class="fa-regular fa-clipboard"></i></p>
                        <p>Tài khoản</p>
                    </div>
                    <div class='childlist'>
                        <ul>
                            <li> 
                                <a href="">
                                    <i class="fa-solid fa-users"></i> 
                                    <span>
                                    Danh sách
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <i class="fa-solid fa-users"></i> 
                                    <span>
                                    Tạo mới
                                    </span>
                                </a>
                            </li>                           
                        </ul>
                    </div>
                </div>
                <div class="actionicon">
                    <div class="fatherlist" id="admin_ticked_category">
                        <p><i class="fa-regular fa-clipboard"></i></p>
                        <p>Danh mục</p>
                    </div>
                    <div class='childlist' >
                        <ul>
                            <li >
                                <a href="">
                                    <i class="fa-solid fa-users"></i> 
                                    <span>
                                    Danh sách
                                    </span>
                                </a>
                            </li>
                            <li >
                                <a href="">
                                    <i class="fa-solid fa-users"></i> 
                                    <span>
                                    Thêm mới
                                    </span>
                                </a>
                            </li>                        
                        </ul>
                    </div>
                
                </div>
                <div class="actionicon">
                    <div class="fatherlist" id="admin_ticked_product">
                        <p><i class="fa-regular fa-clipboard"></i></p>
                        <p>Sản phẩm</p>
                    </div>
                    <div class='childlist'>
                        <ul>
                            <li>
                                <a href="">
                                    <i class="fa-solid fa-users"></i> 
                                    <span>
                                    Danh sách
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <i class="fa-solid fa-users"></i> 
                                    <span>
                                    Thêm mới
                                    </span>
                                </a>
                            </li>                   
                        </ul>
                    </div>
                
                </div>
            </div>
            @endif
            <div class="dashbar" >
                <h1>Quản lý đơn hàng</h1>
            </div>
            <div class='actions'>
                <div class="actionicon">
                    <a href="{{ route('order.list') }}">
                        <div class="fatherlist" id='admin_ticked_order'>
                            <p><i class="fa-regular fa-clipboard"></i></p>
                            <p>Đơn hàng</p>
                        </div>
                    </a>
                </div>   
                <div class="actionicon">
                    <a href="{{ route('user.viewpage') }}">
                        <div class="fatherlist" id='admin_ticked_chart'>
                            <p><i class="fa-solid fa-hand-holding-dollar"></i></p> 
                            <p>Thống kê</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        @yield('content')
    </div>
    

   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
   <script>
    $('.disbookmark').click(function(){
        $(this).fadeOut(1);
        $('.nonebookmark').fadeIn(1);   
    }) 

    $('.nonebookmark').click(function(){
        $(this).fadeOut(1);
        $('.disbookmark').fadeIn(1);  
    })

    $('.disstar').click(function(){
        $(this).fadeOut(1);
        $('.nonestar').fadeIn(1);
    }) 

    $('.nonestar').click(function(){
        $(this).fadeOut(1);
        $('.disstar').fadeIn(1);  
    })

    $('.disfind').click(function(){
        $('.headermid').fadeToggle(1);
    })

    $('.dissidebar').click(function(){ 
        $('.sidebar').show("slide", { direction: "left" }, 10000);
        // $('.sidebar').slideRight(100);
    })

    $('.fatherlist').click(function(){
        $('.childlist').not($(this).siblings()).slideUp(200);
        $(this).siblings().slideToggle(200); 
    })

    $('.logout').click(function(){
        $('.logoutchild').slideToggle(200);
    })

    function searchAccount(){
        var userName = $('.whatyoulookingfor').val();
        $.get( '{{ route('user.search') }}',
            {'userName': userName}, 
            function( id ) {
                console.log(id);
                var url = 'http://localhost:8000/admin/user/account' + id
                window.location.href = url;
            }
        );  
    }

    $('.whatyoulookingfor').keyup(function() {
        var search = $('.whatyoulookingfor').val();
        console.log(search.length);
        if(search.length > 0){
            $.get( '{{ route('user.searchName') }}',
                {'search' : search}, 
                function( data ) {
                    if(data.length > 0){
                        $('.search_suggest ul').empty()
                        $('.search_suggest').css('opacity', '1')
                        var count = 0
                        for (var i = 0; i < data.length; i++) {
                            count++
                            $('.search_suggest ul').append(`<li id='choosenSearch' >${data[i]}</li>`);
                            if(count == 5){
                                break;
                            }
                        }
                    } else {
                        $('.search_suggest').css('opacity', '0')
                    }
                }
            )
        }
        if (search.length == 0) {
            $('.search_suggest').css('opacity', '0')
        }
    })

    $(document).on("click", "#choosenSearch", function(){
        var userName = $(this).text()
        $.get( '{{ route('user.search') }}',
            {'userName': userName}, 
            function( id ) {
                console.log(id);
                var url = 'http://localhost:8000/admin/user/account' + id
                window.location.href = url;
            }
        )
    });
   </script>
   @yield('script')
</html>
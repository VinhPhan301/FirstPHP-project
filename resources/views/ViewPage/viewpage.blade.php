<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
        <input type="text">
        <div class="placeholder">
            <i class="fa-solid fa-magnifying-glass"></i>
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
        <div class="father">
            <p><i class="fa-regular fa-envelope"></i></p>
            <div class="son">1</div>
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
                    <p><i class="fa-regular fa-bell"></i></p>
                    <p class="logout"><i class="fa-regular fa-circle-user"></i></p>
                </div>
                <div class="logoutchild">
                    <a href='{{ route('user.logout') }}'>Logout <span><i class="fa-solid fa-arrow-right-from-bracket"></i></span></a>
                    <a>Setting <span><i class="fa-solid fa-gear"></i></span></a>
                    <a>Setting <span><i class="fa-solid fa-gear"></i></span></a>
                    <a>Setting <span><i class="fa-solid fa-gear"></i></span></a>
                </div>
            </div>
            <div class="sidebaruserpic">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT7K7I2HBandSavKMZEI0tkyVDztS2ryFViOA&usqp=CAU" alt="">
                <p class="username">Most Beautiful</p>
                <p class="about">Something about me and my life</p>
            </div>
            <div class="dashbar">
                <h1>Trang chủ</h1>
            </div>
            <div class='actions'>
                <div class="actionicon">
                    <div class="fatherlist">
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
                            <li>
                                <a href="test">
                                    <i class="fa-solid fa-users"></i> 
                                    <span>
                                    User Test
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="actionicon">
                    <div class="fatherlist">
                        <p><i class="fa-regular fa-clipboard"></i></p>
                        <p>Danh mục</p>
                    </div>
                    <div class='childlist'>
                        <ul>
                            <li>
                                <a href="{{ route('category.list') }}">
                                    <i class="fa-solid fa-users"></i> 
                                    <span>
                                    Danh sách
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('category.create') }}">
                                    <i class="fa-solid fa-users"></i> 
                                    <span>
                                    Thêm mới
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="test">
                                    <i class="fa-solid fa-users"></i> 
                                    <span>
                                    Cate Test
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                
                </div>
                <div class="actionicon">
                    <div class="fatherlist">
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
                            <li>
                                <a>
                                    <i class="fa-solid fa-users"></i> 
                                    <span>
                                    Product Detail
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                
                </div>
            </div>
            <div class="dashbar" >
                <h1>APPLICATIONS</h1>
            </div>
            <div class='actions'>
                <div class="actionicon">
                    <a href="{{ route('order.list') }}">
                        <div class="fatherlist">
                            <p><i class="fa-regular fa-clipboard"></i></p>
                            <p>Đơn hàng</p>
                        </div>
                    </a>
                </div>   
                <div class="actionicon">
                    <div class="fatherlist">
                        <p><i class="fa-solid fa-hand-holding-dollar"></i></p> 
                        <p>Income Money</p>
                    </div>
                </div>
                <div class="actionicon">
                    <div class="fatherlist">
                        <p><i class="fa-solid fa-hand-holding-dollar"></i></p> 
                        <p>Income Money</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        @yield('content')
    </div>
    

   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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

    // $('.fa-bars').click(function() {
    //     $( "#toggle" ).toggle( "slide" );
    //     $('header').css('width', '98.8%');
    //     $('.content').css('width', '100%');
    // });

   </script>
</body>
</html>
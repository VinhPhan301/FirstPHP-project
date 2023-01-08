<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/home.css') }}">
    <link rel = "icon" href ="{{ asset("thumbnail/favicon-16x16.ico") }}" type = "image/x-icon">
    <title>CNF SHOP</title>
</head>
<body>
    <p class="user_logged" style="display: none">{{ $userLogin }}</p>
    <div class="header" id="header">
        <div class="header_img">
            <img src="{{ asset('thumbnail/blackfriday.png') }}" alt="">
        </div>
        <div class="header_type">
            <div class='name_type'>
                <a class="to_main" href="{{ route('shop.view',['category' => $category]) }}"><p>TRANG CHỦ</p></a>
                @foreach($productType as $item)
                <a class="to_other" href="{{ route('shop.view',['type' => $item]) }}">
                    <p>{{ strtoupper($item) }}</p>
                </a>
                @endforeach
            </div>
            <div class='icon_type'>
                <div class='search'>
                    <p onclick="searchProduct()"><i class="fa-solid fa-magnifying-glass"></i></p>
                    <input class="whatyoulookingfor" type="text" placeholder="Tìm sản phẩm ...">
                    <div class="search_suggest">
                        <ul>

                        </ul>
                    </div>
                </div>
                <p>
                    <a href="{{ route('shop.view',['category' => $category]) }}">
                        <i class="fa-solid fa-store"></i>
                    </a> 
                </p>
                <p>
                    <a href="{{ route('shop.userfavorite', ['id' => $id]) }}">
                        <i class="fa-regular fa-heart"></i>
                    </a>
                </p>
                <p>
                    @if ($userLogin == 'none')
                    <i class="fa-regular fa-circle-user show_user_action"></i>
                    @else
                    <img id='avatar_user' class='show_user_action' src="{{ asset("picture/$avatar") }}">
                    @endif
                </p>
                <p>
                    <a href="{{ route('cartItem.view') }}">
                        <i class="fa-solid fa-bag-shopping"></i>
                    </a>
                </p>
                <div id='user_action'>
                    <p class='undefind'><a href="{{ route('shop.login') }}"><span id='to_login'>Đăng nhập</span></a></p>
                    <p class='undefind'><a href="{{ route('shop.signup') }}">Đăng ký</a></p>
                    <p class='logged'><a href="{{ route('shop.userinfor', ['id' => $id]) }}">Tài khoản</a></p>
                    <p class='logged'><a href='{{ route('shop.logout') }}'>Đăng xuất</a></p>
                </div>
            </div>
        </div> 
    </div>
    <div class="home_content">
        @yield('home_content')
    </div>
    <div class="footer">
        <div class="top_footer">
            <div class="canifa">
                <h3>CÔNG TY CỔ PHẦN CANIFA</h3>
                <p>Số ĐKKD: 0107574310, ngày cấp: 23/09/2016, nơi cấp: Sở Kế hoạch và đầu tư Hà Nội</p>
                <p>Trụ sở chính: Số 688, Đường Quang Trung, Phường La Khê, Quận Hà Đông, Hà Nội, Việt Nam</p>
                <p>Địa chỉ liên hệ: Phòng 301 Tòa nhà GP Invest, 170 La Thành, P. Ô Chợ Dừa, Q. Đống Đa, Hà Nội</p>
                <p>Số điện thoại: +8424 - 7303.0222</p>
                <p>Fax: +8424 - 6277.6419</p>
                <p>Địa chỉ email: hello@canifa.com</p>
            </div>
            <div class="side_canifa">
                <h3>THƯƠNG HIỆU</h3>
                <p>Giới thiệu</p>
                <p>Tin tức</p>
                <p>Tuyển dụng</p>
                <p>Với cộng đồng</p>
                <p>Hệ thống cửa hàng</p>
                <p>Liên hệ</p>
            </div>
            <div class="side_canifa">
                <h3>HỖ TRỢ</h3>
                <p>Hỏi đáp</p>
                <p>Chính sách KHTT</p>
                <p>Chính sách vận chuyển</p>
                <p>Hướng dẫn chọn size</p>
                <p>Kiểm tra đơn hàng</p>
                <p>Quy định đổi hàng</p>
                <p>Tra cứu điểm thẻ</p>
                <p>Chính sách bảo mật</p>
            </div>
            <div class="side_canifa security_icon">
                <h3>Chính sách bảo mật</h3>
                <img class="qrcode" src="{{ asset('thumbnail/bancode.png') }}">
                <img src="{{ asset('thumbnail/appstore.png') }}">
                <img src="{{ asset('thumbnail/googleplay.png') }}">
                <h3 class="payway">PHƯƠNG THỨC THANH TOÁN</h3>
                <p><img class='paywaypic' src="{{ asset('thumbnail/payway.png') }}"></p>
                <p><img src="{{ asset('thumbnail/bocongthuong.png') }}"></p>
            </div>
        </div>
        <div class="bot_footer">
            <p>© 2022 CANIFA</p>
            <p>
                <span>Visit Us</span>
                <span><a href="https://www.facebook.com/canifa.fanpage/"><i class="fa-brands fa-square-facebook"></i></a></span>
                <span><a href="https://www.instagram.com/canifa.fashion/"><i class="fa-brands fa-square-instagram"></i></a></span>
            </p>
        </div>
    </div>
    <div class='to_top_box'>
        <div>
            <a href="https://www.facebook.com/canifa.fanpage/">
                <p><i class="fa-solid fa-headset"></i></p>
                <p>Hỗ trợ</p>
            </a>
        </div>
        <div class="scroll_to_top">
            <a href="#top">
                <p><i class="fa-solid fa-chevron-up"></i></p>
                <p >Đầu trang</p>
            </a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $("a[href='#top']").click(function() {
            $("html, body").animate({ scrollTop: 0 }, "slow");
            return false;
        });

        $('.show_user_action').click(function() {
            var user = $('.user_logged').text()
            
            if(user === 'none'){
                $('.logged').css('display', 'none')
                $('.undefind').css('display', 'block')
            }
            else {
                $('.logged').css('display', 'block')
                $('.undefind').css('display', 'none')
            }

            $('#user_action').slideToggle(200)

        })

        $('.whatyoulookingfor').keyup(function() {
            var search = $('.whatyoulookingfor').val();
            console.log(search.length);
            if(search.length > 0){
                $.get( '{{ route('shop.searchProduct') }}',
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
            var productName = $(this).text()
            var url = '{{ route('shop.findProduct') }}' + '?productName=' + productName;
            window.location.href = url
        });

        function searchProduct(){
            var productName = $('.whatyoulookingfor').val();
            var url = '{{ route('shop.findProduct') }}' + '?productName=' + productName;
            window.location.href = url
        }
    </script>
    @yield('script')
</body>
</html>
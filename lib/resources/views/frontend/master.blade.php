<!DOCTYPE html>
<html>
<head>
	<base href="{{ asset('public/layout/frontend') }}/"
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>Chiến Đồ Nam - @yield('title')</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/home.css">
	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script type="text/javascript">
		$(function() {
			var pull        = $('#pull');
			menu        = $('nav ul');
			menuHeight  = menu.height();

			$(pull).on('click', function(e) {
				e.preventDefault();
				menu.slideToggle();
			});
		});

		$(window).resize(function(){
			var w = $(window).width();
			if(w > 320 && menu.is(':hidden')) {
				menu.removeAttr('style');
			}
		});
	</script>
        <style>
            .logout-btn {
                position: absolute;
                right: 107px;
                top: 15px;
                font-size: 17px;
                color: aliceblue;
            }
            .logout-btn  a{
                font-size: 17px;
                color: aliceblue;
                text-decoration: none;
            }
			a:hover{
				text-decoration: none !important;
			}
			.subnav li {
                color: black;
                padding: 10px;
                font-size: 17px;
        	}

			.user {
				position: relative;
				padding: 0 20px;
			}
			.icon {
				font-size: 35px;
				padding: 27px;
				color: white;
				cursor: pointer;
                margin-left: 7px;
			}
			.subnav li:hover {
				background-color: rgba(184, 166, 146, 0.2);
			}
            .subnav a {
                color: #ff7b07;
            }

			.user:hover .subnav {
				display: block;
			}

			.user .subnav {
				display: none;
				top: 81px;
				position: absolute;
				list-style-type: none;
				background-color: white;
				box-shadow: 0 0 5px #333;
				border-radius: 3px;
				width: 175px;
				z-index: 1;
			}

			#logo img {
                width: 100px;
                padding: 15px 0px;
        	}

			input {
                padding: 10px;
                border: none;
                cursor: pointer;
                border-radius: 3px;
			}

			.input {
				width: 550px;
				margin-top: 34px;
			}

			.submit {
				background-color: #fff;
			}
            .login-btn {
                position: absolute;
                top: 33px;
                right: 153px;
                color: #fff;
                font-size: 17px;
                border: 1px solid #ddd;
                height: fit-content;
                padding: 6px 10px;
                border-radius: 5px;
                box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
            }
        </style>
</head>
<body>
	<!-- header -->
	<header id="header">
		<div class="container">
			<div style="flex-wrap: unset !important;" class="row">
                <!-- <div class="logout-btn">
					<i class="fa fa-arrow-right"></i>
                    <a href="{{ asset('logout') }}">Đăng xuất</a></li>
                </div> -->
				<div id="logo" class="col-md-3 col-sm-12 col-xs-12">
					<a style="text-decoration: none;" href="{{ asset('/') }}">
					    <img src="img/home/logomain.png" alt="">
					</a>
				</div>

				<div>
					<form action="{{asset('/search/')}}" method="get">
						<input class="input" type="text" name="result" placeholder="Nhập tên sản phẩm ..." required>
						<input class="submit"type="submit" name="submit" value="Tìm Kiếm">
					</form>
				</div>

				<div class="cart icon">
					<a style="color:white;margin-left:10px" class="display" href="{{ asset('cart/show') }}">
						<i class="fa fa-shopping-cart" aria-hidden="true"></i>
					</a>
					<a style="font-size: 18px; color:white" href="{{ asset('cart/show') }}">{{ Cart::count() }}</a>
        		</div>

				<div @if(Auth::check()) class="user icon">
					<i class="fa fa-user-circle-o" aria-hidden="true"></i>
					<ul class="subnav">
                        <li><a href="{{ asset('list-order') }}">Đơn hàng của tôi</a></li>
                        <li><a href="{{ asset('change-password') }}">Đổi mật khẩu</a></li>
                        <li><a href="{{ asset('logout') }}">Đăng xuất</a></li>
					</ul>
                    @endif
        		</div>

			</div>
            <a @if(!Auth::check()) href="{{ asset('/login') }}" class="login-btn">Đăng nhập</a>@endif
		</div>
	</header><!-- /header -->
	<!-- endheader -->

	<!-- main -->
	<section id="body">
		<div class="container">
			<div class="row">
				<div id="sidebar" class="col-md-3">
					<nav id="menu">
						<ul>
							<li class="menu-item">Danh mục sản phẩm</li>
							@foreach($categories as $category)
							<li class="menu-item"><a style="text-decoration: none;" href="{{ asset('category/' . $category->cate_id) }}">{{ $category->cate_name }}</a></li>
							@endforeach
						</ul>
						<!-- <a href="#" id="pull">Danh mục</a> -->
					</nav>

					<div id="banner-l" class="text-center">
						<div class="banner-l-item">
							<a href="{{ asset('/') }}"><img src="img/home/banner1.jpg" alt="" class="img-thumbnail"></a>
						</div>
						<div class="banner-l-item">
							<a href="{{ asset('/') }}"><img src="img/home/banner2.jpg" alt="" class="img-thumbnail"></a>
						</div>
						<div class="banner-l-item">
							<a href="{{ asset('/') }}"><img src="img/home/banner3.jpg" alt="" class="img-thumbnail"></a>
						</div>
						<div class="banner-l-item">
							<a href="{{ asset('/') }}"><img src="img/home/banner4.jpg" alt="" class="img-thumbnail"></a>
						</div>
						<div class="banner-l-item">
							<a href="{{ asset('/') }}"><img src="img/home/banner5.jpg" alt="" class="img-thumbnail"></a>
						</div>
						<div class="banner-l-item">
							<a href="{{ asset('/') }}"><img src="img/home/banner6.jpg" alt="" class="img-thumbnail"></a>
						</div>
						{{-- <div class="banner-l-item">
							<a href="#"><img src="img/home/banner-l-7.png" alt="" class="img-thumbnail"></a>
						</div> --}}
					</div>
				</div>
				<div id="main" class="col-md-9">
					<!-- main -->
					<!-- phan slide la cac hieu ung chuyen dong su dung jquey -->
					<div id="slider">
						<div id="demo" class="carousel slide" data-ride="carousel">

							<!-- Indicators -->
							<ul class="carousel-indicators">
								<li data-target="#demo" data-slide-to="0" class="active"></li>
								<li data-target="#demo" data-slide-to="1"></li>
								<li data-target="#demo" data-slide-to="2"></li>
							</ul>

							<!-- The slideshow -->
							<div class="carousel-inner">
								<div class="carousel-item active">
									<img width="100%" height="415px" src="img/home/slider1.jpg" alt="Los Angeles" >
								</div>
								<div class="carousel-item">
									<img width="100%" height="415px" src="img/home/slider2.jpg" alt="Chicago">
								</div>
								<div class="carousel-item">
									<img width="100%" height="415px" src="img/home/slider3.jpg" alt="New York" >
								</div>
							</div>

							<!-- Left and right controls -->
							<a class="carousel-control-prev" href="#demo" data-slide="prev">
								<span class="carousel-control-prev-icon"></span>
							</a>
							<a class="carousel-control-next" href="#demo" data-slide="next">
								<span class="carousel-control-next-icon"></span>
							</a>
						</div>
					</div>

					<div id="banner-t" class="text-center">
						<div class="row">
							<div class="banner-t-item col-md-6 col-sm-12 col-xs-12">
								<a href="{{ asset('/') }}"><img width="100%" style=" height: 162px !important" src="img/home/qc1.jpg" alt="" class="img-thumbnail"></a>
							</div>
							<div class="banner-t-item col-md-6 col-sm-12 col-xs-12">
								<a href="{{ asset('/') }}"><img width="100%"  style=" height: 162px !important" src="img/home/qc2.jpg" alt="" class="img-thumbnail"></a>
							</div>
						</div>
					</div>

                    @yield('main')

                    </div>
                </div>
            </div>
        </div>
    </section>
        <!-- endmain -->

        <!-- footer -->
        <footer id="footer">
            <div id="footer-t">
                <div class="container">
                    <div class="row">
                        <div id="logo" class="col-md-3 col-sm-12 col-xs-12">
							<a style="text-decoration: none;" href="{{ asset('/') }}">
                                <img src="img/home/logomain.png" alt="">
                            </a>
                        </div>
                        <div id="about" class="col-md-3 col-sm-12 col-xs-12">
                            <h3>About us</h3>
                            <p class="text-justify">Chiến Đồ Nam thành lập năm 2022. Chúng tôi là nhà cung cấp các sản phẩm công nghệ hàng đầu Việt Nam cũng như trên toàn thế giới.</p>
                        </div>
                        <div id="hotline" class="col-md-3 col-sm-12 col-xs-12">
                            <h3>Hotline</h3>
                            <p>Phone1: (+84) 633543311</p>
                            <p>Phone2: (+84) 553652543</p>
                            <p>Email: chien@gmail.com</p>
                        </div>
                        <div id="contact" class="col-md-3 col-sm-12 col-xs-12">
                            <h3>Contact Us</h3>
                            <p>Address 1: Số 87 Hạ Đình - Thanh Xuân - Hà Nội</p>
                            <p>Address 2: Số 226 Định Công - Hoàng Mai - Hà Nội</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- endfooter -->
    </body>
    </html>

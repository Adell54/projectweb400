<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Responsive E-commerce Website">

	<!-- title -->
	<title>Easy Shop</title>

	<!-- favicon -->
			
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">

<!-- fontawesome -->
<link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
<!-- bootstrap -->
<link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
<!-- owl carousel -->
<link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.css') }}">
<!-- magnific popup -->
<link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
<!-- animate css -->
<link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
<!-- mean menu css -->
<link rel="stylesheet" href="{{ asset('assets/css/meanmenu.min.css') }}">
<!-- main style -->
<link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
<!-- responsive -->
<link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">

</head>
<body>
	
	<!--PreLoader-->
    <div class="loader">
        <div class="loader-inner">
            <div class="circle"></div>
        </div>
    </div>
    <!--PreLoader Ends-->
	
	<!-- header -->
	<div class="top-header-area" id="sticker">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-sm-12 text-center">
					<div class="main-menu-wrap">
						<!-- Menu Start -->
<nav class="main-menu">
    <ul>
        <li><a href="/home">Home</a></li>
        <li><a href="/products">Products</a></li>
        <li><a href="/categories">Categories</a></li>
        <li><a href="/about">About</a></li>
        <li>
            <div class="header-icons">
                <a class="shopping-cart" href="#" id="cart-button">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="badge" id="cart-item-count">{{ $cartItemCount() }}</span>
                </a>
                

                @auth
                <!-- Display Username if Logged In -->
                <a class="mobile-hide" href="/profile">
                    <i class="fas fa-user"></i> {{ Auth::user()->name }}
                </a>
                @else
                <!-- Login/Register Button if Not Logged In -->
                <a class="mobile-hide" href="#" data-toggle="modal" data-target="#loginModal">
                    <i class="fas fa-sign-in-alt"></i> Login/Register
                </a>
                @endauth
            </div>
        </li>
    </ul>
</nav>
<div class="mobile-menu"></div>
<!-- Menu End -->


					</div>
				</div>
			</div>
		</div>
	</div>
	
	<!-- end header -->

<!-- Login/Register Modal -->

<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login/Register</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Tabs for Login and Register -->
                <ul class="nav nav-tabs" id="loginRegisterTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="login-tab" data-toggle="tab" href="#login" role="tab" aria-controls="login" aria-selected="true">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="false">Register</a>
                    </li>
                </ul>
                <div class="tab-content" id="loginRegisterTabContent">
                    <!-- Login Tab -->
                    <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
                        <form action="{{ route('login') }}" method="POST" class="mt-3">
                            @csrf
                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter E-mail" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label class="form-check-label" for="remember">Remember Me</label>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </form>
                    </div>

                    <!-- Register Tab -->
                    <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                        <form action="{{ route('register') }}" method="POST" class="mt-3">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Create a password" required>
                            </div>
                            <div class="form-group">
                                <label for="password-confirm">Confirm Password</label>
                                <input type="password" class="form-control" id="password-confirm" name="password_confirmation" placeholder="Confirm password" required>
                            </div>
                            <button type="submit" class="btn btn-success btn-block">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

	
  

   @yield('content')


    
	<!-- footer -->
	<div class="footer-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6">
					<div class="footer-box about-widget">
						<h2 class="widget-title">About us</h2>
						<p>Ut enim ad minim veniam perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae.</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box get-in-touch">
						<h2 class="widget-title">Get in Touch</h2>
						<ul>
							<li>34/8, East Hukupara, Gifirtok, Sadan.</li>
							<li>support@fruitkha.com</li>
							<li>+00 111 222 3333</li>
						</ul>
					</div>
				</div>
				
			</div>
		</div>
	</div>
	<!-- end footer -->
	
	<!-- copyright -->
	<div class="copyright">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-12">
					<p>Copyrights &copy; 2025</p> 
					
					
				</div>
				
			</div>
		</div>
	</div>
	<!-- end copyright -->
	
	<!-- jQuery -->
<script src="{{ asset('assets/js/jquery-1.11.3.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- Countdown -->
<script src="{{ asset('assets/js/jquery.countdown.js') }}"></script>
<!-- Isotope -->
<script src="{{ asset('assets/js/jquery.isotope-3.0.6.min.js') }}"></script>
<!-- Waypoints -->
<script src="{{ asset('assets/js/waypoints.js') }}"></script>
<!-- Owl Carousel -->
<script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
<!-- Magnific Popup -->
<script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
<!-- Mean Menu -->
<script src="{{ asset('assets/js/jquery.meanmenu.min.js') }}"></script>
<!-- Sticker JS -->
<script src="{{ asset('assets/js/sticker.js') }}"></script>
<!-- Main JS -->
<script src="{{ asset('assets/js/main.js') }}"></script>

<script>
    $(document).ready(function () {
        $('#cart-button').on('click', function (e) {
            e.preventDefault();

            $.ajax({
                url: '/cart',
                method: 'GET',
                success: function (response) {
                    window.location.href = '/cart'; // Redirect to cart page if authenticated
                },
                error: function (xhr) {
                    if (xhr.status === 401) {
                        $('#loginModal').modal('show'); // Show the login modal if not authenticated
                    }
                }
            });
        });
    });
</script>

</body>
</html>

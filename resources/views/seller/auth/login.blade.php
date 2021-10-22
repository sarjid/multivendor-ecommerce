<!doctype html>
<html lang="en">


<!-- Mirrored from www.wrraptheme.com/templates/lucid/html/light/page-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 11 May 2021 21:50:22 GMT -->
<head>
<title>Seller Login</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="description" content="Lucid Bootstrap 4.1.1 Admin Template">
<meta name="author" content="WrapTheme, design by: ThemeMakker.com">

<link rel="icon" href="favicon.ico" type="image/x-icon">
<!-- VENDOR CSS -->
<link rel="stylesheet" href="{{ asset('backend/') }}/assets/vendor/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('backend/') }}/assets/vendor/font-awesome/css/font-awesome.min.css">

<!-- MAIN CSS -->
<link rel="stylesheet" href="{{ asset('backend/') }}/assets/css/main.css">
<link rel="stylesheet" href="{{ asset('backend/') }}/assets/css/color_skins.css">
</head>

<body class="theme-cyan">
	<!-- WRAPPER -->
<div id="wrapper">
    <div id="main-content">
        <div class="container-fluid">
                <div class="row">
                    <div class="auth-box mt-5">
                        <div class="card">
                            <div class="header m-auto">
                                <img src="{{ get_setting('logo') }}" alt="">
                                <p class="lead text-center">Seller Login</p>
                            </div>
                            <div class="body">
                                <div class="col-lg-12">
                                    @include('backend.layouts.notification')
                                </div>
                                <form class="form-auth-small" action="{{ route('seller.login') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="signin-email" class="control-label sr-only">Email</label>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="signin-email"  placeholder="Email Address" value="{{ old('email') }}">

                                        @error('email')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="signin-password" class="control-label sr-only">Password</label>
                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" id="signin-password" placeholder="Password">
                                        @error('password')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group clearfix">
                                        <label class="fancy-checkbox element-left">
                                            <input type="checkbox">
                                            <span>Remember me</span>
                                        </label>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">LOGIN</button>
                                </form>
                            </div>
                        </div>
                    </div>
	            </div>
	    </div>
	</div>
</div>
    <!-- END WRAPPER -->
    <script src="{{ asset('frontend/js') }}/jquery.min.js"></script>
    <script>
        setTimeout(function(){
            $('#alert').slideUp();
        }, 4000);
    </script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Haven Of Wisdom Academy</title>

        <!-- Meta-Tags -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">
        <meta name="keywords" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script>
            addEventListener("load", function() {
                setTimeout(hideURLbar, 0);
            }, false);

            function hideURLbar() {
                window.scrollTo(0, 1);
            }
        </script>
        <link href=" {{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('global_assets/css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
        <link href=" {{ asset('assets/css/bootstrap_limitless.min.css') }}" rel="stylesheet" type="text/css">
        <script src="{{ asset('global_assets/js/main/jquery.min.js') }} "></script>
        <script src="{{ asset('global_assets/js/main/bootstrap.bundle.min.js') }} "></script>


        <link rel="icon" href="{{ asset('global_assets/images/favicon.png') }}">
        <!-- //Meta-Tags -->
        <!-- Index-Page-CSS -->
        <link rel="stylesheet" href="css1/style.css" type="text/css" media="all">
        <!-- //Custom-Stylesheet-Links -->
        <!--fonts -->
        <!-- //fonts -->
        <link rel="stylesheet" href="css1/font-awesome.min.css" type="text/css" media="all">
        <!-- //Font-Awesome-File-Links -->

        <!-- Google fonts -->
        <link href="//fonts.googleapis.com/css?family=Quattrocento+Sans:400,400i,700,700i" rel="stylesheet">
        <link href="//fonts.googleapis.com/css?family=Mukta:200,300,400,500,600,700,800" rel="stylesheet">
        <!-- Google fonts -->
</head>

<body>
@section('content')
    <section class="main">
        <div class="layer1">

            <div class="bottom-grid">
                <div class="logo">
                    <h1> <a href="/login"> Haven of Wisdom Academy</a></h1>
                </div>
                <div class="links">
                    <ul class="links-unordered-list">

                        <li class="active">
                            <a href="/guest" class="">Home</a>
                        </li>

                    </ul>
                </div>
            </div>
            <div class="content-w3ls">
                <div class="text-center icon" >
                    <img src="global_assets/images/HWA.jpg" style="border-radius: 150px;" width="150">

                </div>
                <div class="content-bottom">
                    <form class="login-form" action="{{ route('login') }}" method="post">
                        @csrf
                        @if ($errors->any())
                                <div class="alert alert-danger alert-styled-left alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                                    <span class="font-weight-semibold">Oops!</span> {{ implode('<br>', $errors->all()) }}
                                </div>
                         @endif
                         @if (\Session::has('wait'))
                            <div class="alert alert-danger alert-styled-left alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                                <ul>
                                    <span class="font-weight-semibold">Oops!</span><li>{!! \Session::get('wait') !!}</li>
                                </ul>
                            </div>
                        @endif
                                                <div class="field-group">
                            <span class="fa fa-user" aria-hidden="true"></span>
                            <div class="wthree-field">
                                <input type="text" class="form-control" name="identity" value="{{ old('identity') }}" placeholder="Login ID or Email" autocomplete="off">
                            </div>
                        </div>
                        <div class="field-group">
                            <span class="fa fa-lock" aria-hidden="true"></span>
                            <div class="wthree-field">
                                <input required name="password" type="password" class="form-control" placeholder="{{ __('Password') }}">
                            </div>
                        </div>
                        <div class="wthree-field">
                            <button type="submit" class="btn">Login</button>
                        </div>
                        <ul class="list-login">
                            <li class="switch-agileits">
                                <label class="switch">
                                    <input type="checkbox" name="remember" class="form-input-styled" {{ old('remember') ? 'checked' : '' }} data-fouc>
								<span class="slider round"></span>
								Remember me
							</label>
                            </li>
                            <li>
                                <a href="{{ route('password.request') }}" class="ml-auto">Forgot password?</a>
                            </li>
                            <li class="clearfix"></li>
                        </ul>
                        <ul class="list-login-bottom"style="text-align:center;">

                            <li class=""  >
                                <a href="#" class="text-right">Need Help?</a>
                            </li>
                            <li class="clearfix"></li>
                        </ul>
                    </form>
                </div>
            </div>
            <div class="bottom-grid1">
                <div class="links">
                    <ul class="links-unordered-list">
                        <li class="active">
                            <a href="#" class="">About Us</a>
                        </li>
                        <li class="active">
                            <a href="#" class="">Privacy Policy</a>
                        </li>
                        <li class="active">
                            <a href="#" class="">Terms of Use</a>
                        </li>
                    </ul>
                </div>
                <div class="copyright">

                </div>
            </div>
        </div>
    </section>

</body>
<!-- //Body -->

</html>


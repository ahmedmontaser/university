<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset("assets/images/favicon.ico") }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset("assets/css/bootstrap.min.css") }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset("assets/css/icons.min.css") }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset("assets/css/app.min.css") }}" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body>

<!-- Loader -->
<div id="preloader"><div id="status"><div class="spinner"></div></div></div>

<!-- Begin page -->
<div class="accountbg" style="background: url('{{ asset("assets/images/bg-2.jpg") }}'); background-size: cover; background-repeat: no-repeat; background-position: right;"></div>

<div class="wrapper-page account-page-full">

    <div class="card shadow-none">
        <div class="card-block">
            <div class="account-box">
                <div class="card-box shadow-none p-4">
                    <div class="p-2">
                        <div class="text-center mt-4">
                            <a href="{{ asset("") }}"><img src="{{ asset("assets/images/logo.png") }}" height="30" alt="logo"></a>
                        </div>

                        <h4 class="font-size-18 mt-5 text-center">Welcome Back !</h4>
                        <p class="text-muted text-center">Sign in to continue to Montaser University System.</p>

                        <form class="mt-4" action="{{ route("login") }}" method="POST">
                            @csrf

                            <div class="form-group">
                                @error("email")
                                    {{ $message }}
                                @enderror
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" placeholder="Enter username" name="email">
                            </div>

                            <div class="form-group">
                                <label for="userpassword">Password</label>
                                <input type="password" class="form-control" id="userpassword" placeholder="Enter password" name="password">
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customControlInline">
                                        <label class="custom-control-label" for="customControlInline">Remember me</label>
                                    </div>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <input value="Log In" class="btn btn-primary w-md waves-effect waves-light" type="submit">
                                </div>
                            </div>

                            <div class="form-group mt-2 mb-0 row">
                                <div class="col-12 mt-3">
                                    <a href="pages-recoverpw-2.html" class="text-muted"><i class="mdi mdi-lock"></i> Forgot your password?</a>
                                </div>
                            </div>
                        </form>

                        <div class="mt-5 pt-4 text-center">
                            <p>Don't have an account ? <a href="{{ route("register") }}" class="font-weight-medium text-primary"> Signup now </a> </p>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

</div>


<!-- JAVASCRIPT -->
<script src="{{ asset("assets/libs/jquery/jquery.min.js") }}"></script>
<script src="{{ asset("assets/libs/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
<script src="{{ asset("assets/libs/metismenu/metisMenu.min.js") }}"></script>
<script src="{{ asset("assets/libs/simplebar/simplebar.min.js") }}"></script>
<script src="{{ asset("assets/libs/node-waves/waves.min.js") }}"></script>

<script src="{{ asset("assets/js/app.js") }}"></script>

</body>
</html>

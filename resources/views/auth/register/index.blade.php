<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Register | Admiria - Responsive Bootstrap 4 Admin Dashboard</title>
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
<div class="accountbg" style="background: url('{{asset("assets/images/bg.jpg")}}');background-size: cover;background-position: center;"></div>

<div class="account-pages mt-5 pt-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <div class="p-3">
                            <h4 class="font-size-18 mt-2 text-center">Free Register</h4>
                            <p class="text-muted text-center mb-4">Get your account now.</p>


                            <div class="row">
                                <div class="col-md-4 offset-1">
                                    <a href="{{ route("register.student") }}" class="btn btn-outline-success btn-block">Student Register</a>
                                </div>

                                <div class="col-md-4 offset-2">
                                    <a href="{{ route("register.professor") }}" class="btn btn-outline-success btn-block">Professor Register</a>
                                </div>

                            </div>

<!--
                            <form class="form-horizontal" action="index.html">

                                <div class="form-group">
                                    <label for="useremail">Email</label>
                                    <input type="email" class="form-control" id="useremail" placeholder="Enter email">
                                </div>

                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" placeholder="Enter username">
                                </div>

                                <div class="form-group">
                                    <label for="userpassword">Password</label>
                                    <input type="password" class="form-control" id="userpassword" placeholder="Enter password">
                                </div>

                                <div class="form-group">
                                    <div class="text-right">
                                        <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Register</button>
                                    </div>
                                </div>

                                <div class="form-group mb-0 row">
                                    <div class="col-12 mt-4">
                                        <p class=" text-muted mb-0">By registering you agree to the Admiria <a href="#">Terms of Use</a></p>
                                    </div>
                                </div>
                            </form>
                            -->
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

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <title>Register | Admiria - Responsive Bootstrap 4 Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description"/>
    <meta content="Themesbrand" name="author"/>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset("assets/images/favicon.ico") }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset("assets/css/bootstrap.min.css") }}" id="bootstrap-style" rel="stylesheet" type="text/css"/>
    <!-- Icons Css -->
    <link href="{{ asset("assets/css/icons.min.css") }}" rel="stylesheet" type="text/css"/>
    <!-- App Css-->
    <link href="{{ asset("assets/css/app.min.css") }}" id="app-style" rel="stylesheet" type="text/css"/>

</head>

<body>

<!-- Loader -->
<div id="preloader">
    <div id="status">
        <div class="spinner"></div>
    </div>
</div>

<!-- Begin page -->
<div class="accountbg"
     style="background: url('{{asset("assets/images/bg.jpg")}}');background-size: cover;background-position: center;"></div>

<div class="account-pages mt-5 pt-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-10 col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="p-3">
                            <h4 class="font-size-18 mt-2 text-center">Free Register</h4>
                            <p class="text-muted text-center mb-4">Get your account now.</p>


                            <form class="form-horizontal" action="{{ route("register") }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="user_type" value="student">

                                <!-- Name -->
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Name: </label>
                                    <div class="col-sm-10">
                                        <input class="form-control @error("name") is-invalid @enderror" type="text" id="name" name="name" value="{{ old("name") }}">
                                        @error("name")
                                        <span class="error">
                                        {{ $message }}
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Password -->
                                <div class="form-group row">
                                    <label for="password" class="col-sm-2 col-form-label">Password: </label>
                                    <div class="col-sm-10">
                                        <input class="form-control @error("password") is-invalid @enderror" type="password" id="password" name="password">
                                        @error("password")
                                        <span class="error">
                                        {{ $message }}
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="cpassword" class="col-sm-2 col-form-label">Confirm Password: </label>
                                    <div class="col-sm-10">
                                        <input class="form-control @error("cpassword") is-invalid @enderror" type="password" id="cpassword" name="cpassword">
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="form-group row">
                                    <label for="email" class="col-sm-2 col-form-label">Email: </label>
                                    <div class="col-sm-10">
                                        <input class="form-control @error("email") is-invalid @enderror" type="text" id="email" name="email" value="{{ old("email") }}">
                                        @error("email")
                                        <span class="error">
                                        {{ $message }}
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Phone -->
                                <div class="form-group row">
                                    <label for="phone" class="col-sm-2 col-form-label">Phone: </label>
                                    <div class="col-sm-10">
                                        <input class="form-control @error("phone") is-invalid @enderror" type="text" id="phone" name="phone" value="{{ old("phone") }}">
                                        @error("phone")
                                        <span class="error">
                                        {{ $message }}
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Faculty -->
                                <div class="form-group row">
                                    <label for="faculty" class="col-sm-2 col-form-label">Faculty: </label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="faculty" name="faculty">
                                            @foreach( $faculties as $faculty )
                                                <option value="{{ $faculty->id }}"
                                                        @if( $faculty->id == old("faculty") )
                                                        selected
                                                    @endif>
                                                    {{ $faculty->faculty }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Department -->
                                <div class="form-group row">
                                    <label for="department" class="col-sm-2 col-form-label">Department: </label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="department" name="department">
                                            @foreach( $departments as $department )
                                                <option value="{{ $department->id }}"
                                                        @if( $department->id == old("department") )
                                                        selected
                                                    @endif>
                                                    {{ $department->department }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Level -->
                                <div class="form-group row">
                                    <label for="level" class="col-sm-2 col-form-label">Level: </label>
                                    <div class="col-sm-10">
                                        <input class="form-control @error("level") is-invalid @enderror" type="text" id="level" name="level" value="{{ old("level") }}">
                                        @error("level")
                                        <span class="error">
                                        {{ $message }}
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Image -->
                                <div class="form-group row">
                                    <label for="image" class="col-sm-2 col-form-label">Image</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="filestyle" id="image" name="image" data-buttonname="btn-secondary">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <input type="submit" class="btn btn-outline-success">
                                </div>
                            </form>

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
<script src="{{ asset("assets/libs/admin-resources/bootstrap-filestyle/bootstrap-filestyle.min.js") }}"></script>

<script src="{{ asset("assets/js/app.js") }}"></script>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Enzo admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Enzo admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{ url('') }}/html/assets/images/favicon/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="{{ url('') }}/html/assets/images/favicon/favicon.png" type="image/x-icon">
    <title>Enzo - Premium Admin Template</title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/html/assets/css/vendors/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/html/assets/css/vendors/icofont.css">
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/html/assets/css/vendors/themify.css">
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/html/assets/css/vendors/flag-icon.css">
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/html/assets/css/vendors/feather-icon.css">
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/html/assets/css/vendors/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/html/assets/css/style.css">
    <link id="color" rel="stylesheet" href="{{ url('') }}/html/assets/css/color-1.css" media="screen">
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/html/assets/css/responsive.css">
</head>
<body>
    <!-- Loader starts-->
    <div class="loader-wrapper">
        <div class="loader"></div>
    </div>
    <!-- Loader ends-->
    <!-- login page start-->
    <div class="container-fluid p-0">
        <div class="row m-0">
            <div class="col-12 p-0">
                <div class="login-card">
                    <div>
                        <div>
                            <a class="logo text-center" href="index.html">
                                <img class="img-fluid for-light" src="{{ url('') }}/html/assets/images/logo/login.png" alt="loginpage">
                            </a>
                        </div>
                        <div class="login-main">
                            <!-- Adjust form action to point to the register route -->
                            <form class="theme-form" method="POST" action="{{ route('register') }}">
                                @csrf
                                <h4 class="text-center">Create your account</h4>
                                <p class="text-center">Enter your personal details to create account</p>

                                <div class="form-group">
                                    <label class="col-form-label pt-0">Your Name</label>
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <input class="form-control" type="text" name="name" required="" placeholder="Full name" value="{{ old('name') }}">
                                            @error('name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-6">
                                            <input class="form-control" type="text" name="username" required="" placeholder="Username" value="{{ old('username') }}">
                                            @error('username')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label">Email Address</label>
                                    <input class="form-control" type="email" name="email" required="" placeholder="Test@gmail.com" value="{{ old('email') }}">
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label">Phone Number</label>
                                    <input class="form-control" type="text" name="phone" required="" placeholder="Your Phone" value="{{ old('phone') }}">
                                    @error('phone')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label">Password</label>
                                    <div class="form-input position-relative">
                                        <input class="form-control" type="password" name="password" required="" placeholder="*********">
                                        @error('password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <div class="show-hide"><span class="show"></span></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label">Confirm Password</label>
                                    <div class="form-input position-relative">
                                        <input class="form-control" type="password" name="password_confirmation" required="" placeholder="*********">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-primary btn-block w-100 mt-3" type="submit">Create Account</button>
                                </div>

                                <p class="mt-4 mb-0 text-center">Already have an account?<a class="ms-2" href="{{ route('login') }}">Sign in</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- latest jquery-->
        <script src="{{ url('') }}/html/assets/js/jquery-3.6.0.min.js"></script>
        <!-- Bootstrap js-->
        <script src="{{ url('') }}/html/assets/js/bootstrap/bootstrap.bundle.min.js"></script>
        <!-- feather icon js-->
        <script src="{{ url('') }}/html/assets/js/icons/feather-icon/feather.min.js"></script>
        <script src="{{ url('') }}/html/assets/js/icons/feather-icon/feather-icon.js"></script>
        <!-- scrollbar js-->
        <!-- Sidebar jquery-->
        <script src="{{ url('') }}/html/assets/js/config.js"></script>
        <!-- Theme js-->
        <script src="{{ url('') }}/html/assets/js/script.js"></script>
    </div>
</body>
</html>

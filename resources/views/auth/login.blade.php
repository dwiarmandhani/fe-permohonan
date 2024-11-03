<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Enzo Admin Template</title>
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/html/assets/css/vendors/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/html/assets/css/style.css">
    <!-- Include other styles as needed -->
</head>
<body>
    <!-- Loader starts-->
    <div class="loader-wrapper">
        <div class="loader"></div>
    </div>
    <!-- Loader ends-->

    <div class="container-fluid p-0">
        <div class="row m-0">
            <div class="col-12 p-0">
                <div class="login-card">
                    <div>
                        <div><a class="logo" href="index.html"><img class="img-fluid for-light" src="{{ url('') }}/html/assets/images/logo/login.png" alt="loginpage"></a></div>
                        <div class="login-main">
                            <form class="theme-form" method="POST" action="{{ route('login') }}">
                                @csrf
                                <h4 class="text-center">Sign in to account</h4>
                                <p class="text-center">Enter your email & password to login</p>

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        {{ $errors->first() }}
                                    </div>
                                @endif

                                <div class="form-group">
                                    <label class="col-form-label">Email Address</label>
                                    <input class="form-control" type="email" name="email" required placeholder="Test@gmail.com">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Password</label>
                                    <div class="form-input position-relative">
                                        <input class="form-control" type="password" name="password" required placeholder="*********">
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <div class="checkbox p-0">
                                        <input id="checkbox1" type="checkbox">
                                        <label class="text-muted" for="checkbox1">Remember password</label>
                                    </div>
                                    <div class="text-end mt-3">
                                        <button class="btn btn-primary btn-block w-100" type="submit">Sign in</button>
                                    </div>
                                </div>
                                <p class="mt-4 mb-0 text-center">Don't have account?<a class="ms-2" href="{{ route('register') }}">Create Account</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ url('') }}/html/assets/js/jquery-3.6.0.min.js"></script>
    <script src="{{ url('') }}/html/assets/js/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="{{ url('') }}/html/assets/js/script.js"></script>
</body>
</html>

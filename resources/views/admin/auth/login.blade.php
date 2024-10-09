<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login admin</title>

    <link rel="stylesheet" href="{{ asset('admin_asset/css/customize.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_asset/css/color.css') }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
    <link rel="stylesheet" href="{{ asset('admin_asset/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_asset/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_asset/css/adminlte.min2167.css?v=3.2.0') }}">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href=""><b>Thế Giới Nội Thất</b></a>
        </div>

        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Đăng nhập để sử dụng</p>
                <form action="{{ route('auth.login') }}" method="post">
                    @csrf
                    <div class="form-gruop mb-3">
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Email" name="email"
                                value="{{ old('email') }}">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        @if ($errors->has('email'))
                            <small class="error text-danger">{{ $errors->first('email') }}</small>
                        @endif
                    </div>
                    <div class="form-gruop mb-3">
                        <div class="input-group">
                            <input type="password" class="form-control" class="form-control" placeholder="Password"
                                name="password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        @if ($errors->has('password'))
                            <small class="error text-danger">{{ $errors->first('password') }}</small>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Nhớ tôi
                                </label>
                            </div>
                        </div>

                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">login</button>
                        </div>

                    </div>
                </form>
                <div class="social-auth-links text-center mb-3">
                    <p>- Hoặc -</p>
                    <a href="#" class="btn btn-block btn-danger">
                        <i class="fab fa-google mr-2"></i> Đăng nhập bằng Google 
                    </a>
                </div>

                <p class="mb-1">
                    <a href="forgot-password.html">Quên mật khẩu</a>
                </p>
            </div>

        </div>
    </div>


    <script src="{{ asset('admin_asset/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin_asset/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin_asset/js/adminlte.min2167.js?v=3.2.0') }}"></script>
</body>

</html>

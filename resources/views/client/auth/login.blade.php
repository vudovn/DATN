<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('/client_asset/library/bootstrap5.3/dist/css/theme.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('/client_asset/custom/css/color.css') }}" />
    <link rel="stylesheet" href="{{ asset('/client_asset/custom/css/auth.css') }}" />
    <link rel="stylesheet" href="{{ asset('/client_asset/library/icon/feather-webfont/dist/feather-icons.css') }}" />
    <link href="https://cdn.jsdelivr.net/gh/vudevweb/my-library/able_pro/plugins/message/message.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/vudevweb/my-library/able_pro/plugins/message/message.js"></script>
    <title>Đăng nhập</title>
    <style>

    </style>
</head>

<body class="auth container text-white" style="">
    <div class="card border-0">
        <div class="row g-0">
            <div class="col-md-6 left">
                <div class="d-flex justify-content-center align-items-center h-100" style="flex-direction: column">
                    <p class="text-white">Chào mừng bạn đến với {{ env('CMS_NAME') }}. Nếu bạn chưa có tài khoản, có thể đăng ký ở đây</p>
                    <a href="{{ route('client.auth.register') }}" class="btn btn btn-tgnt w-100">Đăng ký</a>
                </div>
            </div>
            <div class="col-md-6 right">
                <h2 class="mb-4 text-center text-white">Đăng nhập</h2>
                <form action="#" method="POST">
                    <div class="form-group mb-3">
                        <input type="text" name="email" class="form-control input-tgnt"
                            placeholder="Địa chỉ Email">
                        @error('email')
                            <small class="text-danger">*{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" class="form-control input-tgnt" placeholder="Mật khẩu">
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="remember">
                        <label class="form-check-label text-white" for="remember">
                            Lưu tài khoản
                        </label>
                    </div>
                    <button type="submit" class="btn btn-tgnt w-100">Đăng nhập</button>
                </form>

                <div class="text-center mt-3">
                    <a href="{{ route('client.auth.forget') }}" class="text-white">Quên mật khẩu?</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

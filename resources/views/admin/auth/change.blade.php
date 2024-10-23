<!DOCTYPE html>
<html lang="vi">

<head>
    <title>Đăng nhập</title>
    <!-- [Meta] -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="icon" href="{{ asset('admin_asset/images/favicon.svg') }}" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('admin_asset/fonts/inter/inter.css') }}" id="main-font-link" />
    <link rel="stylesheet" href="{{ asset('admin_asset/fonts/phosphor/duotone/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin_asset/fonts/tabler-icons.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin_asset/fonts/feather.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin_asset/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin_asset/fonts/material.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin_asset/css/style.css') }}" id="main-style-link" />
    <script src="{{ asset('admin_asset/js/tech-stack.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('admin_asset/css/style-preset.css') }}" />
    <script src="{{ asset('admin_asset/js/jquery-3.1.1.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('admin_asset/plugins/sweetalert2/sweetalert2.min.css') }}">
    <script src="{{ asset('admin_asset/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('admin_asset/library/cusSweetAlert.js') }}"></script>
</head>

<body data-pc-preset="preset-1" data-pc-sidebar-caption="true" data-pc-layout="vertical" data-pc-direction="ltr"
    data-pc-theme_contrast="" data-pc-theme="light">
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->
    <div class="auth-main">
        <div class="auth-wrapper v1">
            <form action="{{ route('change.password') }}" method="POST" class="auth-form">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="card my-5">
                    <div class="card-body">
                        <a href="#">
                            {{-- <img src="../assets/images/logo-dark.svg" class="mb-4 img-fluid" alt="img"> --}}
                        </a>
                        <div class="mb-4">
                            <h3 class="mb-2">
                                <b>Reset Password</b>
                            </h3>
                            <p class="text-muted">Please choose your new password</p>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                       
                            <input type="hidden" name="email" value="{{ $email }}"  class="form-control disabled" id="floatingInput"
                            placeholder="">
                            <input type="hidden" name="token"  value="{{ $token }}" class="form-control" id="floatingInput"
                            placeholder="">

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="floatingInput"
                                placeholder="Password">
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" id="floatingInput1"
                                placeholder="Confirm Password">
                            @error('password_confirmation')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary">Reset Password</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @include('admin.components.alert')
    <!-- [ Main Content ] end -->
    <!-- Required Js -->
    <script src="{{ asset('admin_asset/js/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('admin_asset/js/plugins/simplebar.min.js') }}"></script>
    <script src="{{ asset('admin_asset/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin_asset/js/fonts/custom-font.js') }}"></script>
    <script src="{{ asset('admin_asset/js/pcoded.js') }}"></script>
    <script src="{{ asset('admin_asset/js/plugins/feather.min.js') }}"></script>

    <script>
        layout_change("light");
    </script>
    <script>
        change_box_container("false");
    </script>
    <script>
        layout_caption_change("true");
    </script>
    <script>
        layout_rtl_change("false");
    </script>
    <script>
        preset_change("preset-9");
    </script>
    <script>
        main_layout_change("vertical");
    </script>

</body>
<!-- [Body] end -->

</html>

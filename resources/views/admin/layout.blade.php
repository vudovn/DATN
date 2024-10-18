<!-- 
     ----------------------------------------------
    |         Đừng Bao Giờ Đi Ăn Một Mình !        |
     ----------------------------------------------
            \   ^__^
             \  (oo)\_______
                (__)\       )\/\
                    ||----w |
                    ||     ||
======V=====V=V=========V===========VV=V=======V========= 
-->
<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.components.head')
    {{-- <link rel="stylesheet" href="https://atugatran.github.io/FontAwesome6Pro/css/all.min.css" > --}}
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('admin.components.loader')
        @include('admin.components.nav')
        @include('admin.components.sidebar')
        <div class="content-wrapper">
            <section class="content animate__animated animate__fadeIn">
                <div class="container-fluid">
                    @yield('template')  {{-- dao diện sẽ được render ra đây --}}
                </div>
            </section>
        </div>
        @include('admin.components.footer')
        <aside class="control-sidebar control-sidebar-dark"></aside>
    </div>
    <input type="hidden" name="model" id="model" value="{{ ucfirst($config['model']??'model') }}">
    {{-- sweetalert --}}
    @include('admin.components.alert')
    {{-- end sweetalert --}}
    @include('admin.components.script')
    <script src="https://cdn.jsdelivr.net/gh/LieutenantPeacock/SmoothScroll@1.2.0/src/smoothscroll.min.js" integrity="sha384-UdJHYJK9eDBy7vML0TvJGlCpvrJhCuOPGTc7tHbA+jHEgCgjWpPbmMvmd/2bzdXU" crossorigin="anonymous"></script>
</body>

</html>

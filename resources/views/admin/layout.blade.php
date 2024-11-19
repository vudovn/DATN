<!--
     ----------------------------------------------
    |       Muốn đi chung thì đừng đi riêng!      |
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
    @include('admin.components.head_cdn')
</head>

<body data-pc-preset="preset-1" data-pc-sidebar-caption="true" data-pc-layout="vertical" data-pc-direction="ltr"
    data-pc-theme_contrast="" data-pc-theme="light">
    @include('admin.components.loader')
    @include('admin.components.sidebar')
    @include('admin.components.nav')

    <div class="pc-container">
        <div class="pc-content">
            @yield('template')
            <input type="hidden" name="model" id="model" value="{{ ucfirst($config['model'] ?? 'model') }}">
        </div>
    </div>
    @include('admin.components.footer')
    @include('admin.components.alert')
    @include('admin.components.script_cdn')
</body>

</html>

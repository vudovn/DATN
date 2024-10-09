<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.components.head')
    <link rel="stylesheet" href="https://atugatran.github.io/FontAwesome6Pro/css/all.min.css" >
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('admin.components.loader')
        @include('admin.components.nav')
        @include('admin.components.sidebar')
        <div class="content-wrapper">
            <section class="content">
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
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    @include('client.components.head')
    <link rel="stylesheet" href="/client_asset/custom/css/loading.css">
    <title>Trang chủ</title>
</head>

<body>
    @include('client.components.loading')
    @include('client.components.header')
    <main class="m-0">
        @yield('content')
    </main>
    @include('client.components.footer')
    @include('client.components.modal')
    @include('client.components.alert')
    @include('client.components.script')
</body>

</html>

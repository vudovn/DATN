<!DOCTYPE html>
<html lang="en">

<head>
    @include('client.components.head')
    <title>Trang chủ</title>
</head>

<body>
    @include('client.components.header')
    <main class="m-0">
        @yield('content')
    </main>
    @include('client.components.footer')
    @include('client.components.script')
    @include('client.components.alert')
</body>

</html>

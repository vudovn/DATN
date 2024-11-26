<!DOCTYPE html>
<html lang="en">

<head>
    @include('client.components.head')
    <link rel="stylesheet" href="/client_asset/custom/css/loading.css">
    <link rel="stylesheet" href="/client_asset/custom/css/search.css">
    <link rel="shortcut icon" href="{{ asset('logo_tgnt.ico') }}" type="image/x-icon">
    <title>Trang chủ</title>
    @yield('seo')
</head>

<body>
    @include('client.components.loading')
    @include('client.components.header')
    <main class="m-0 pt-2">
        @yield('content')
    </main>

    {{-- include footer nếu có route('client.account.index') --}}
    @if (!Route::currentRouteName() == 'client.account.index')
        @include('client.components.footer')
    @endif
    @include('client.components.footer')
    @include('client.components.modal')
    @include('client.components.alert')
    @include('client.components.script')

</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    @yield('seo')
    @include('client.components.head')
    <title>{{ $title ?? 'Thế giới nội thất' }}</title>
    <link rel="stylesheet" href="/client_asset/custom/css/loading.css">
    <link rel="stylesheet" href="/client_asset/custom/css/search.css">
    <link rel="shortcut icon" href="{{ asset('logo_tgnt.ico') }}" type="image/x-icon">
</head>

<body>
    {{-- @include('client.components.loading') --}}
    @include('client.components.header')
    <main class="m-0">
        @yield('content')
    </main>

    @if (!Route::currentRouteName() == 'client.account.index')
        @include('client.components.footer')
    @endif
    @include('client.components.footer')
    @include('client.components.modal')
    @include('client.components.alert')
    @include('client.components.script')
    <a href="#" class="scroll-up text-white" id="scroll-up" style="opacity: 0"><i
            class="fa-solid fa-arrow-up"></i></a>
</body>

</html>

<!DOCTYPE html>
<html>
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">


        <title>INSPINIA | Dashboard v.4</title>

        <link href="{{ asset('backend/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('backend/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
        

        <link href="{{ asset('backend/css/animate.css') }}" rel="stylesheet">
        <link href="{{ asset('backend/css/style.css') }}" rel="stylesheet">

        @if(isset($config['css']) &&  count($config['css']))
            @foreach($config['css'] as $key => $val)
                <link href="{{ asset($val) }}"  rel="stylesheet" />
            @endforeach
        @endif
        <link href="{{ asset('backend/css/customize.css') }}" rel="stylesheet">
        <script src="{{ asset('backend/js/jquery-3.1.1.min.js') }}"></script>
    </head>
    <body>
        <div id="wrapper">
            @include('backend.components.sidebar')
            @include('backend.components.nav')
            <div id="page-wrapper" class="gray-bg">
                <div class="row border-bottom">
                   
                </div>

                @yield('template')

                @include('backend.components.footer')

            </div>
        </div>

        <!-- Mainly scripts -->
       
        <script src="{{ asset('backend/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('backend/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
        <script src="{{ asset('backend/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

        <!-- Custom and plugin javascript -->
        <script src="{{ asset('backend/js/inspinia.js') }}"></script>
        {{-- <script src="{{ asset('backend/js/plugins/pace/pace.min.js') }}"></script> --}}
        <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
        <script src="{{ asset('backend/library/library.js') }}"></script>
        

        @if(isset($config['js']) &&  count($config['js']))
            @foreach($config['js'] as $key => $val)
                <script src="{{ asset($val) }}"></script>
            @endforeach
        @endif

    </body>
</html>

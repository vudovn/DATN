<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Dashboard - TGNT</title>
<link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
<link rel="stylesheet" href="{{ asset('/backend/plugins/fontawesome-free/css/all.min.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet"
    href="{{ asset('/backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
<link rel="stylesheet" href="{{ asset('/backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('/backend/css/adminlte.min2167.css?v=3.2.0') }}">
<link rel="stylesheet" href="{{ asset('/backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/plugins/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/css/customize.css') }}">
@if (isset($config['css']) && count($config['css']))
    @foreach ($config['css'] as $key => $val)
        <link href="{{ asset($val) }}" rel="stylesheet" />
    @endforeach
@endif

<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"
/>

<script src="{{ asset('backend/js/jquery-3.1.1.min.js') }}"></script>
<script src="{{ asset('/backend/library/cusSweetAlert.js') }}"></script>
<script src="{{ asset('backend/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>

<script>
    $(document).ready(function() {
        const sweet = new CusSweetAlert();
        Fancybox.bind('[data-fancybox="gallery"]', {
            infinite: false,
            buttons: [
                "zoom",
                "close",
            ],
        });

    })
</script>

<style>
    td {
        vertical-align: middle !important;
    }
</style>

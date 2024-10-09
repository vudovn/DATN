<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Dashboard - TGNT</title>
<link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
<link rel="stylesheet" href="{{ asset('admin_asset/css/color.css') }}">
<link rel="stylesheet" href="{{ asset('admin_asset/plugins/fontawesome-pro/all.min.css') }}">
{{-- <link rel="stylesheet" href="https://atugatran.github.io/FontAwesome6Pro/css/all.min.css" > --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="{{ asset('admin_asset/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin_asset/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin_asset/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin_asset/plugins/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin_asset/plugins/tagify/tagify.css') }}">
<link rel="stylesheet" href="{{ asset('admin_asset/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin_asset\plugins\select2\css\select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin_asset/plugins/fancybox/fancybox.css') }}">
<link rel="stylesheet" href="{{ asset('admin_asset/css/adminlte.min2167.css?v=3.2.0') }}">
{{-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.0/themes/base/jquery-ui.css"> --}}
<link rel="stylesheet" href="{{ asset('admin_asset/css/customize.css') }}">

<script src="{{ asset('admin_asset/js/jquery-3.1.1.min.js') }}"></script>
<script src="{{ asset('admin_asset/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('/admin_asset/library/cusSweetAlert.js') }}"></script>

<script src="{{ asset('admin_asset/plugins/fancybox/fancybox.umd.js') }}"></script>

@if (isset($config['css']) && count($config['css']))
    @foreach ($config['css'] as $key => $val)
        <link href="{{ asset($val) }}" rel="stylesheet" />
    @endforeach
@endif

<script>
    $(document).ready(function() {
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

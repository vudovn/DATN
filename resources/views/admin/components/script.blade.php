{{-- <script src="{{ asset('/backend/plugins/jquery/jquery.min.js') }}"></script> --}}
<script src="{{ asset('/backend/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('/backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('/backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('/backend/js/adminlte2167.js?v=3.2.0') }}"></script>

<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>


<script src="{{ asset('backend/library/library.js') }}"></script>
@if (isset($config['js']) && count($config['js']))
    @foreach ($config['js'] as $key => $val)
        <script src="{{ asset($val) }}"></script>
    @endforeach
@endif

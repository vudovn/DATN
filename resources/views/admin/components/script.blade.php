{{-- <script src="{{ asset('/admin_asset/plugins/jquery/jquery.min.js') }}"></script> --}}
<script src="{{ asset('/admin_asset/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('/admin_asset/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('/admin_asset/plugins/tagify/tagify.min.js') }}"></script>
<script src="{{ asset('/admin_asset/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('/admin_asset/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('/admin_asset/js/adminlte2167.js?v=3.2.0') }}"></script>

<script>
    $.widget.bridge('uibutton', $.ui.button)
    const BASE_URL = '{{ url('/') }}';
</script>

<script src="/admin_asset/plugins_tgnt/ckeditor/ckeditor.js"></script>
<script src="/admin_asset/plugins_tgnt/ckfinder/ckfinder.js"></script>
<script src="/admin_asset/library/finder.js"></script>
<script src="/admin_asset/library/seo.js"></script>

<script src="{{ asset('admin_asset/library/library.js') }}"></script>
@if (isset($config['js']) && count($config['js']))
    @foreach ($config['js'] as $key => $val)
        <script src="{{ asset($val) }}"></script>
    @endforeach
@endif

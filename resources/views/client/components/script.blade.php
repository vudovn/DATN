<script src="https://cdn.jsdelivr.net/gh/vudevweb/my-library/client_asset/library/jquery/jquery-3.7.1.min.js"></script>
<script
    src="https://cdn.jsdelivr.net/gh/vudevweb/my-library/client_asset/library/bootstrap5.3/dist/js/bootstrap.bundle.min.js">
</script>
<script src="https://cdn.jsdelivr.net/gh/vudevweb/my-library/client_asset/library/bootstrap5.3/dist/js/theme.min.js">
</script>
<script src="https://cdn.jsdelivr.net/gh/vudevweb/my-library//client_asset/library/smoothscroll/SmoothScroll.js">
</script>
<script type="https://cdn.jsdelivr.net/gh/vudevweb/my-library/text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script
    src="https://cdn.jsdelivr.net/gh/vudevweb/my-library//client_asset/library/bootstrap5.3/dist/umd/owl.carousel.min.js">
</script>
<script type="text/javascript" src="https://freshcart.codescandy.com/assets/libs/slick-carousel/slick/slick.min.js">
</script>
<script src="https://freshcart.codescandy.com/assets/js/vendors/slick-slider.js"></script>
<script src="https://cdn.jsdelivr.net/gh/vudevweb/my-library//client_asset/custom/home.js"></script>

@if (isset($config['js']) && count($config['js']))
    @foreach ($config['js'] as $key => $val)
        <script src="{{ asset($val) }}"></script>
    @endforeach
@endif

<script>
    $(window).on("load", function() {
        $(".loading_tgnt").fadeOut("slow");
    });

</script>


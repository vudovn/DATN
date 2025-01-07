{{-- <script src="https://cdn.jsdelivr.net/gh/vudevweb/my-library/client_asset/library/jquery/jquery-3.7.1.min.js"></script> --}}
{{-- <script
    src="https://cdn.jsdelivr.net/gh/vudevweb/my-library/client_asset/library/bootstrap5.3/dist/js/bootstrap.bundle.min.js">
</script> --}}
<script src="https://freshcart.codescandy.com/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://freshcart.codescandy.com/assets/libs/simplebar/dist/simplebar.min.js"></script>
<script src="https://freshcart.codescandy.com/assets/js/vendors/countdown.js"></script>
<script src="https://freshcart.codescandy.com/assets/js/vendors/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/gh/vudevweb/my-library/able_pro/plugins/select2/js/select2.full.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/vudevweb/my-library/client_asset/library/bootstrap5.3/dist/js/theme.min.js">
</script>
{{-- <script src="https://cdn.jsdelivr.net/gh/vudevweb/my-library//client_asset/library/smoothscroll/SmoothScroll.js">
</script> --}}
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
<script>
    $("#slide-featured").slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 2,
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    infinite: true,
                },
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                },
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                },
            },
        ],
    });
</script>
<script>
    window.onscroll = function() {
        var scrollLink = document.getElementById("scroll-up");
        if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
            scrollLink.style.opacity = "1";
        } else {
            scrollLink.style.opacity = "0";
        }
    };
</script>
<script>
    $(document).ready(function() {
        $('.slick-prev').html('<i class="fa-solid fa-chevron-left"></i>');
        $('.slick-next').html('<i class="fa-solid fa-chevron-right"></i>');
    });
</script>
<script src="/client_asset/custom/js/library.js"></script>
<script src="/client_asset/custom/js/product/search.js"></script>
<script src="/client_asset/custom/js/product/wishlist.js"></script>
<script src="/client_asset/custom/js/cart/addToCart.js"></script>

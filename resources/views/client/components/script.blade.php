
<script src="https://cdn.jsdelivr.net/gh/vudevweb/my-library/able_pro/js/jquery-3.1.1.min.js"></script>

<script src="/client_asset/library/bootstrap5.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="/client_asset/library/smoothscroll/SmoothScroll.js"></script>
{{-- <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script> --}}
{{-- <script src="/client_asset/library/bootstrap5.3/dist/umd/owl.carousel.min.js"></script> --}}
<script type="text/javascript"
    src="https://freshcart.codescandy.com/client_asset/libs/slick-carousel/slick/slick.min.js"></script>
<script src="https://freshcart.codescandy.com/client_asset/js/vendors/slick-slider.js"></script>
<script src="/client_asset/custom/home.js"></script>

@if (isset($config['js']) && count($config['js']))
    @foreach ($config['js'] as $key => $val)
        <script src="{{ asset($val) }}"></script>
    @endforeach
@endif

<script type="text/javascript">
    // $(document).ready(function() {
    //     $('.slide_test').slick({
    //         dots: true,
    //         infinite: true,
    //         speed: 300,
    //         slidesToShow: 3,
    //         slidesToScroll: 3,
    //         responsive: [{
    //                 breakpoint: 1024,
    //                 settings: {
    //                     slidesToShow: 3,
    //                     slidesToScroll: 3,
    //                     infinite: true,
    //                     dots: true
    //                 }
    //             },
    //             {
    //                 breakpoint: 600,
    //                 settings: {
    //                     slidesToShow: 2,
    //                     slidesToScroll: 2
    //                 }
    //             },
    //             {
    //                 breakpoint: 480,
    //                 settings: {
    //                     slidesToShow: 1,
    //                     slidesToScroll: 1
    //                 }
    //             }
    //             // You can unslick at a given breakpoint now by adding:
    //             // settings: "unslick"
    //             // instead of a settings object
    //         ]
    //     });
    // });
    $(document).ready(function() {
        const colors = [
            "#FFB6C1",
            "#ADD8E6",
            "#90EE90",
            "#FFD700",
            "#FF6347",
            "#7B68EE",
            "#48D1CC",
        ]; // Mảng màu

        function getContrastYIQ(hexcolor) {
            hexcolor = hexcolor.replace("#", "");
            const r = parseInt(hexcolor.substr(0, 2), 16);
            const g = parseInt(hexcolor.substr(2, 2), 16);
            const b = parseInt(hexcolor.substr(4, 2), 16);
            const yiq = (r * 299 + g * 587 + b * 114) / 1000;
            return yiq >= 128 ? "black" : "white";
        }

        $(".slide_cmt .card").each(function(index) {
            let randomColor;
            do {
                randomColor = colors[Math.floor(Math.random() * colors.length)];
            } while (index > 0 && randomColor === $(this).prev().css("background-color"));
            $(this).css("background-color", randomColor);
            const textColor = getContrastYIQ(randomColor);
            $(this).css("color", textColor);
        });

        $(".slide_cmt").slick({
            infinite: true,
            autoplay: true,
            autoplaySpeed: 3000,
            speed: 300,
            slidesToShow: 3,
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
    });
</script>

@extends('client.layout')

@section('content')
    <main>
        <!-- banner -->
        <!-- <section class="container-fluid">
                                                                                        <div class="row">
                                                                                            <div class="col-8 p-0">
                                                                                                <img class="w-100" style="height: 540px;" src="/assets/image/banner/collection_banner.png" alt="">
                                                                                            </div>
                                                                                            <div class="col-4 p-0 position-relative">
                                                                                                <img class="w-100" style="height: 540px;" src="/assets/image/banner/collection_banner1.png" alt="">
                                                                                                <p class="overlay-text-center-collect">Phủ lên mọi căn phòng một phong cách nghỉ lễ vui vẻ, từ những
                                                                                                    bộ sưu tập mới cho đến tất cả đồ trang trí lễ hội.</p>
                                                                                                <div class="overlay-bottom">
                                                                                                    <p class="collect-light-text">Bộ sưu tập</p>
                                                                                                    <i class="bi bi-chevron-right"></i>
                                                                                                    <p>Ngày lễ</p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </section> -->
        <!-- end banner -->

        <section class="container collection_tgnt">
            <div class="d-none d-xxl-block mp-5">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="trangchu.html" class="text-stnt">Trang chủ</a></li>
                        <!-- <li class="breadcrumb-item"><a href="product.html" class="text-stnt">Sản phẩm</a></li> -->
                        <li class="breadcrumb-item active" aria-current="page">Bộ sưu tập</li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-md-3 col-md-3">
                    <div class="bg-light p-5 rounded mb-5">
                        <h5 class="mt-1">Bộ sưu tập Thế giới nội thất</h5>
                        <hr class="border-top border-3 w-25 my-2">
                        <div class="row">
                            @for ($i = 0; $i < 5; $i++)
                                <div class="col-6 col-md-12 mb-2">
                                    <a href="">Mây mới</a>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="row mt-5">
                        @for ($j = 0; $j < 5; $j++)
                            <div class="col-md-6 col-sm-12 mb-5">
                                <div class="card card-blog">
                                    <div class="card-image">
                                        <a href="#"> <img class="img card-image-top"
                                                src="https://www.nitori.com.vn/cdn/shop/files/250115918000-01_700x700.jpg?v=1708337884">
                                        </a>
                                    </div>
                                    <div class="table mt-2 p-3">
                                        <a href="#" class="card-caption">Quisque id elit maximus, pretium diam at
                                            mollis elit sadsadasd ádsadasda</a>
                                        <hr class="border-3 w-25 my-2">
                                        <p class="card-description"> Lorem ipsum dolor sit amet, consectetur adipis
                                            cingelit.
                                            Etiam
                                            lacinia elit et placerat finibus. Praesent justo metus, pharetra vel nibh
                                            sit amet,
                                            tincidunt posuere nulla. </p>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </section>
        <script>
            $(document).ready(function() {
                $('.collection_slick').slick({
                    infinite: true,
                    speed: 300,
                    autoplay: true,
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    responsive: [{
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 3,
                                slidesToScroll: 3,
                                infinite: true,
                                dots: true
                            }
                        },
                        {
                            breakpoint: 600,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 2
                            }
                        },
                        {
                            breakpoint: 480,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 1
                            }
                        }

                    ]
                });
            });
        </script>
    </main>
@endsection

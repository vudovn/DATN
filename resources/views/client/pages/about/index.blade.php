@extends('client.layout')

@section('content')
    <section class="container">
        <!-- end header -->
        <main>
            <div class="about">
                <section class="banner position-relative">
                    <div class="text-center" style="background-color: #3d3733;">
                        <p class="py-3 text-white mb-0">GIẢM GIÁ 20% cho đơn hàng đầu tiên. Đăng ký nhận thông báo
                            của chúng tôi!
                            <a href="" class="text-white fw-bold text-decoration-none"><span>Đăng
                                    ký</span> &rarr;</a>
                        </p>
                    </div>
                    <img src=".\client_asset\image\banner\Hero img.png" class="w-100 h-75" alt="">
                    <label for="">Để mọi người có thể trân trọng cách họ sống trong những thời gian quan
                        trọng.</label>
                </section>
                <section class="about-content">
                    <div class="container about-item1">
                        <h2 class="text-center fw-bold my-4">Giới thiệu về chúng tôi</h2>
                        <div class="my-lg-5 my-md-5 my-sm-2">
                            <p>
                                Chúng tôi là thành viên của Tập đoàn Otto và có 7.500 cộng sự. Với hơn 100 cửa hàng và đối
                                tác nhượng quyền tại 9 quốc gia, chúng tôi là điểm đến quốc tế về đồ nội thất, đồ gia dụng
                                và đồ trang trí hiện đại và hiện đại giúp mọi người Chào đón Cuộc sống.
                            </p>
                            <p>
                                Các thương hiệu phong cách sống của chúng tôi mang đến cuộc sống đầy cảm hứng thông qua các
                                sản phẩm chất lượng cao, thiết kế độc quyền và phong cách vượt thời gian - tất cả đều được
                                hỗ trợ bởi các công cụ trực quan và thiết kế kỹ thuật số cung cấp các giải pháp mua sắm liền
                                mạch tại cửa hàng và trực tuyến.
                            </p>
                            <p>
                                Với gu thẩm mỹ kiến ​​trúc khác biệt, môi trường cửa hàng trực tiếp và cộng đồng trực tuyến,
                                chúng tôi tương tác với khách hàng thông qua mạng xã hội, mua sắm trên thiết bị di động,
                                dịch vụ thiết kế, đăng ký quà tặng và hơn thế nữa.
                            </p>
                        </div>
                    </div>
                    <div class="container about-item2 w-75">
                        <h2 class="text-center fw-bold my-3">Mỗi ngày, mọi việc ta làm, ta đều kiếm tìm</h2>
                        <div class="row text-center my-lg-5 my-md-5 my-sm-2">
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <figure>
                                    <blockquote class="blockquote">
                                        <p class="fw-medium">CẢM HỨNG</p>
                                    </blockquote>
                                    <figcaption class="blockquote-footer mt-3">
                                        <cite title="Source Title">Ý tưởng đẹp cho cuộc sống thực, từ trang web của chúng
                                            tôi đến các cửa hàng của chúng
                                            tôi.</cite>
                                    </figcaption>
                                </figure>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <figure>
                                    <blockquote class="blockquote">
                                        <p class="fw-medium">CHẤT LƯỢNG</p>
                                    </blockquote>
                                    <figcaption class="blockquote-footer mt-3">
                                        <cite title="Source Title">Được thiết kế để làm hài lòng và được chế tạo để tồn
                                            tại.</cite>
                                    </figcaption>
                                </figure>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <figure>
                                    <blockquote class="blockquote">
                                        <p class="fw-medium">BỀN VỮNG</p>
                                    </blockquote>
                                    <figcaption class="blockquote-footer mt-3">
                                        <cite title="Source Title">Được thực hiện có trách nhiệm
                                            và có nguồn gốc đạo đức.</cite>
                                    </figcaption>
                                </figure>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <figure>
                                    <blockquote class="blockquote">
                                        <p class="fw-medium">DỊCH VỤ</p>
                                    </blockquote>
                                    <figcaption class="blockquote-footer mt-3">
                                        <cite title="Source Title">Chúng tôi ở đây để giúp đỡ, từ
                                            cảm hứng để cài đặt.</cite>
                                    </figcaption>
                                </figure>
                            </div>
                        </div>
                    </div>
                    <div class="about-item3 overflow-hidden">
                        <div class="text-center bg-black" style="background-color: black !important;">
                            <p class="py-4 text-white fs-4 mb-0">Chúng tôi cống hiến bằng tâm hồn trong từng sản phẩm</p>
                        </div>
                        <div class="row">
                            <img class="w-25" src=".\client_asset\image\banner\img_about1.png" alt="">
                            <img class="w-25" src=".\client_asset\image\banner\img_about3.png" alt="">
                            <img class="w-25" src=".\client_asset\image\banner\img_about1.png" alt="">
                            <img class="w-25" src=".\client_asset\image\banner\img_about3.png" alt="">
                        </div>
                        <div class="text-center bg-black" style="background-color: black !important;">
                            <p class="py-4 text-white fs-4 mb-0">... từ kho hàng đến phòng trưng bày</p>
                        </div>
                    </div>
                </section>
            </div>
        </main>
    </section>
@endsection

@extends('client.layout')

@section('content')
    <div class="home">
        <!-- 1. SECTION 1 -->
        <section class="notice container-fluid text-center py-3">
            <p class="d-inline text-light">
                GIẢM GIÁ 20% cho đơn hàng đầu tiên của bạn. Đăng ký để nhận thống
                báo của chúng tôi!
            </p>
            <a href="#" class="d-inline text-light text-decoration-underline">Đăng ký <span><i
                        class="bi bi-arrow-right"></i></span></a>
        </section>
        <!-- 2. SECTION 2 -->
        <div class="demo home-slick-arrow">
            {{-- <button class="slick-prev slick-arrow" aria-label="Previous" type="button" style="">Previous</button>
            <button class="slick-next slick-arrow" aria-label="Next" type="button" style="">Previous</button> --}}
            @foreach ($slides as $slide)
                <div class="banner-content container-fluid p-0 position-relative">
                    <img class="w-100" height="600" src="{{ asset($slide->collection->thumbnail) }}" alt="Banner Image" />
                    <div class="banner-title" style="max-width: 800px">
                        <p class="text-white fw-bold" style="filter: drop-shadow(0px 5px 15px black)">
                            {{ $slide->collection->name }}
                        </p>
                        <p class="banner-subtitle lh-lg mt-3" style="filter: drop-shadow(0px 5px 15px black)">
                            {{ $slide->collection->short_description }}
                        </p>
                    </div>
                    <div class="d-flex gap-2 banner-title-btn">
                        <a href="{{ route('client.collection.detail', $slide->collection->slug) }}"
                            class="d-block btn banner-btn">
                            Xem thêm <span><i class="bi bi-arrow-right"></i></span>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- 4. SECTION 4 -->
        <section class="title-forward">
            <p class="fw-bold text-center w-75">
                "Một số người tìm kiếm một nơi đẹp đẽ, còn người sành điệu chọn biến
                nơi ở của mình đẹp đẽ hơn"
            </p>
        </section>

        <section class="container mb-5">
            <h3 class="fw-bold pb-4">Sản phẩm nổi bật</h3>
            <div class="row animate__animated animate__fadeIn listProduct mb-4" id="slide-featured">
                @foreach ($product_featureds->take(8) as $product_featured)
                    <x-product_card :data="$product_featured" />
                @endforeach
            </div>
        </section>
        <section class="container mb-5">
            <h3 class="fw-bold pb-4">Sản phẩm bán chạy</h3>
            <div class="row animate__animated animate__fadeIn listProduct mb-4" id="slide-bestseller">
                @foreach ($product_bestsellers->take(8) as $product_bestseller)
                    <x-product_card :data="$product_bestseller" />
                @endforeach
            </div>
        </section>

        <!-- 6. SECTION 6 -->
        <section class="title-forward-bg">
            <p class="fw-bold text-center w-50 m-0">
                Xem sản phẩm của chúng tôi theo loại phòng
            </p>
        </section>
        <!-- 7.SECTION 7 -->
        <section class="banner-collection">
            <!-- 7. Living room -->
            @foreach ($categoryRoom->take(4) as $room)
                <div class="banner mb-2">
                    <img src="{{ asset($room->thumbnail) }}" alt="Banner Image" />
                    <div class="overlay"></div>
                    <div class="banner-collection-title">
                        <h1 class="text-white">{{ $room->name }}</h1>
                        <a href="{{ route('client.category.index', $room->slug) }}" class="lead text-white">Xem sản phẩm
                            <i class="bi bi-chevron-right"></i></a>
                    </div>
                </div>
            @endforeach
        </section>
        <!-- 8. SECTION 8 -->
        <section class="title-forward">
            <p class="fw-bold text-center w-50">
                “Tôi sẽ làm cho mọi thứ trở nên tươi đẹp, đó sẽ là cuộc sống của
                tôi!”
            </p>
        </section>
        <!-- 10. SECTION 10 -->
        <section class="home-category">
            <div class="container">
                <div class="testimonial-title container p-md-5 p-3">
                    <h2 class="text-white">Bộ sưu tập</h2>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipiscing elit semper dalar
                        elementum tempus hac tellus libero accumsan.
                    </p>
                </div>
                <div class="category-content">
                    <div class="item">
                        <img src="/client_asset/image/home/cate-1.jpg" alt="Item Image" />
                        <p class="text-dark fw-semibold">Ghế bành</p>
                    </div>
                    <div class="item">
                        <img src="/client_asset/image/home/cate-2.jpg" alt="Item Image" />
                        <p class="text-dark fw-semibold">Ghế đôn</p>
                    </div>
                    <div class="item">
                        <img src="https://mdsf.vn/wp-content/uploads/2022/12/ghe-go-nha-hang.jpg" alt="Item Image" />
                        <p class="text-dark fw-semibold">Ghế</p>
                    </div>
                    <div class="item">
                        <img src="/client_asset/image/home/cate-4.jpg" alt="Item Image" />
                        <p class="text-dark fw-semibold">Ghế sofa</p>
                    </div>
                    <div class="item">
                        <img src="/client_asset/image/home/cate-5.jpg" alt="Item Image" />
                        <p class="text-dark fw-semibold">Bàn</p>
                    </div>
                    <div class="item">
                        <img src="/client_asset/image/home/cate-6.jpg" alt="Item Image" />
                        <p class="text-dark fw-semibold">Bàn có ngăn kéo</p>
                    </div>
                    <div class="item">
                        <img src="/client_asset/image/home/cate-7.jpg" alt="Item Image" />
                        <p class="text-dark fw-semibold">Đèn</p>
                    </div>
                    <div class="item">
                        <img src="/client_asset/image/home/cate-8.jpg" alt="Item Image" />
                        <p class="text-dark fw-semibold">Thảm trải sàn</p>
                    </div>
                    <div class="item">
                        <img src="/client_asset/image/home/cate-9.jpg" alt="Item Image" />
                        <p class="text-dark fw-semibold">Gối</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- 14.Comment -->
        <section class="comment-client ">
            <div class="container p-5 text-center">
                <h2>Khách hàng nói về chúng tôi</h2>
                <p>
                    Những phản hồi từ khách hàng của chúng tôi cho thấy sự hài lòng về
                    chất lượng sản phẩm và dịch vụ tận tâm, chuyên nghiệp.
                </p>
            </div>
            <div class="container">
                <div class="slide_cmt">
                    <div class="card col shadow-sm">
                        <div class="card-body">
                            <p class="card-text feedback">
                                "Tôi thực sự ấn tượng với Thế Giới Nội Thất! Trang web không chỉ dễ dàng sử dụng mà còn cung
                                cấp rất nhiều lựa chọn nội thất đẹp mắt, phù hợp với phong cách hiện đại của tôi. Mỗi sản
                                phẩm đều được mô tả chi tiết, giúp tôi dễ dàng chọn lựa. Tôi rất hài lòng với chất lượng các
                                sản phẩm, chúng không chỉ đẹp mà còn rất bền bỉ!"
                            </p>
                            <div class="d-flex align-items-center pt-4">
                                <img src="/client_asset/image/home/user-1.jpg" class="rounded-circle icon-xl"
                                    alt="" />
                                <div>
                                    <h5 class="card-title fw-bold">Đỗ Văn Vũ</h5>
                                    <span class="text-success">vũ văn vở</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card col shadow-sm">
                        <div class="card-body">
                            <p class="card-text">
                                "Với Thế Giới Nội Thất, tôi tìm thấy những món đồ hoàn hảo cho ngôi nhà của mình. Trang web
                                rất dễ tìm kiếm và chọn lựa sản phẩm. Tôi đặc biệt yêu thích bộ sưu tập nội thất đa dạng, từ
                                cổ điển đến hiện đại, mọi thứ đều đáp ứng đúng nhu cầu của tôi. Đây chắc chắn là địa chỉ uy
                                tín để mua sắm nội thất cho
                                không gian sống của mình!"
                            </p>
                            <div class="d-flex align-items-center pt-4">
                                <img src="/client_asset/image/home/user-2.jpg" class="rounded-circle icon-xl"
                                    alt="" />
                                <div>
                                    <h5 class="card-title fw-bold">Thái Hoàng Quân</h5>
                                    <span class="text-success">quân quằn quại</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card col shadow-sm">
                        <div class="card-body">
                            <p class="card-text">
                                "Chất lượng sản phẩm tuyệt vời và thiết kế vô cùng tinh tế! Tôi đã mua một số món đồ từ Thế
                                Giới Nội Thất cho ngôi nhà mới và chúng thực sự làm cho không gian của tôi thêm phần sang
                                trọng. Hơn nữa, trang web rất dễ dàng để tìm kiếm các sản phẩm và tôi luôn nhận được thông
                                tin chính xác về sản phẩm. Một trải nghiệm mua sắm tuyệt vời!"
                            </p>
                            <div class="d-flex align-items-center pt-4">
                                <img src="/client_asset/image/home/user-3.jpg" class="rounded-circle icon-xl"
                                    alt="" />
                                <div>
                                    <h5 class="card-title fw-bold">Phạm Gia Ân</h5>
                                    <span class="text-success">ân ảo ảnh</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card col shadow-sm">
                        <div class="card-body">
                            <p class="card-text">
                                "Dịch vụ của Thế Giới Nội Thất thật sự ấn tượng. Tôi đã tìm thấy những món đồ nội thất phù
                                hợp với từng không gian trong ngôi nhà của mình. Các sản phẩm đều rất chất lượng và thiết kế
                                hiện đại, dễ dàng kết hợp với nhau. Hơn nữa, giao hàng nhanh chóng và đội ngũ nhân viên rất
                                nhiệt tình, giúp tôi có trải nghiệm mua sắm tuyệt vời!"
                            </p>
                            <div class="d-flex align-items-center pt-4">
                                <img src="/client_asset/image/home/user-2.jpg" class="rounded-circle icon-xl"
                                    alt="" />
                                <div>
                                    <h5 class="card-title fw-bold">Nguyễn Trần Khánh Vi</h5>
                                    <span class="text-success">vi vui vẻ</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card col shadow-sm">
                        <div class="card-body">
                            <p class="card-text">
                                "Với Thế Giới Nội Thất, tôi không chỉ mua được những sản phẩm đẹp mà còn được trải nghiệm
                                dịch vụ chăm sóc khách hàng tuyệt vời. Từ khâu tư vấn sản phẩm đến giao hàng, mọi thứ đều
                                rất chuyên nghiệp. Tôi đã mua nhiều món đồ cho phòng khách và phòng ngủ, tất cả đều rất ưng
                                ý và tạo nên không gian sống hoàn hảo!"
                            </p>
                            <div class="d-flex align-items-center pt-4">
                                <img src="/client_asset/image/home/user-2.jpg" class="rounded-circle icon-xl"
                                    alt="" />
                                <div>
                                    <h5 class="card-title fw-bold">Bùi Tuyết Ngân</h5>
                                    <span class="text-success">ngân ngại ngùng</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 15.Contact us -->
        <section class="container py-10">
            <div class="row contact-us">
                <div class="contact-us-text col-12 col-md-6 ">
                    <h2 class="pb-4 text-tgnt">Liên hệ</h2>
                    <p class="mb-3">
                        Nguyên mẫu cũng có thể được miễn một số yêu cầu sẽ áp dụng cho
                        sản phẩm cuối cùng.
                    </p>
                    <a href="mailto:{{ getSetting()->site_email }}" class=" mb-3">
                        <span><i class="bi bi-envelope me-2"></i></span>
                        {{ getSetting()->site_email }}</a><br />
                    <a href="tel:{{ getSetting()->site_phone }}" class=" mb-3">
                        <span><i class="bi bi-telephone me-2"></i></span>
                        {{ getSetting()->site_phone }}</a><br />
                    <p class="mb-3">
                        <i class="bi bi-geo-alt me-2"></i>
                        {{ getSetting()->site_address }}
                    </p>
                </div>
                <div class="contact-us-iframe col-12 col-md-6 p-0">
                    {!! getSetting()->site_map !!}
                    {{-- <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3833.801789055265!2d108.16736761086088!3d16.075772239198137!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314218e6e72e66f5%3A0x46619a0e2d55370a!2zMTM3IE5ndXnhu4VuIFRo4buLIFRo4bqtcCwgVGhhbmggS2jDqiBUw6J5LCBMacOqbiBDaGnhu4N1LCDEkMOgIE7hurVuZywgVmlldG5hbQ!5e0!3m2!1sen!2s!4v1710949332685!5m2!1sen!2s"
                        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> --}}
                </div>
            </div>
        </section>
    </div>
@endsection

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
        <section class="banner-content container-fluid p-0 position-relative">
            <img class="w-100" src="/client_asset/image/home/banner_home.jpeg" alt="Banner Image" />
            <div class="banner-title" style="max-width: 800px">
                <p class="text-white fw-bold">Sự ấm cúng <br />đang đến gần !!</p>
                <p class="banner-subtitle lh-lg mt-3">
                    Ánh sáng vàng dịu từ đèn treo và nến tạo nên bầu không khí gần
                    gũi, thân thiện. Những chiếc ghế sofa êm ái, gối tựa mềm mại và
                    thảm trải sàn mang lại sự ấm cúng.
                </p>
            </div>
            <div class="d-flex gap-2 banner-title-btn">
                <button class="d-block btn banner-btn">
                    Xem thêm <span><i class="bi bi-arrow-right"></i></span>
                </button>
                <button class="d-block btn btn-outline custom-outline">
                    Hỗ trợ
                </button>
            </div>
        </section>
        <!-- 3. SECTION 3 -->
        <!-- <section class="container-fluid p-0 mt-xxl-10 mt-3 mt-0" style="background-color: #f3deba;">
    <div class="container">
      <div class="row">
        <div class="testimonial-title col-xxl-4 col-12 mt-5 text-xxl-start text-md-center">
          <h2 class="fw-bold">
            Mùa thu đang đến gần
          </h2>
          <p>
            Hướng dẫn trực quan sẽ cung cấp cho khách hàng cái nhìn tổng quan về website hoặc dự án của họ
          </p>
        </div>
        <div class="testimonial-slider col-xxl-8 col-12">
          <div id="carouselExampleControls" class="carousel">
            <div class="testimonial-button d-flex">
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Trở về</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Bước tiếp</span>
              </button>
            </div>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <div class="product-card">
                  <a href="#">
                    <img src="/client_asset/image/home/best _seller_1.jpg" alt="Product 1" />
                  </a>
                  <p class="best-seller-title">Bán chạy</p>
                </div>
              </div>
              <div class="carousel-item">
                <div class="product-card">
                  <a href="#"><img src="/client_asset/image/home/best _seller_2.jpg" alt="Product 1" /></a>
                  <p class="best-seller-title">Bán chạy</p>
                </div>
              </div>
              <div class="carousel-item">
                <div class="product-card">
                  <a href="#"><img src="/client_asset/image/home/best _seller_3.jpg" alt="Product 1" /></a>
                  <p class="best-seller-title">Bán chạy</p>
                </div>
              </div>
              <div class="carousel-item">
                <div class="product-card">
                  <a href="#"><img src="/client_asset/image/home/best _seller_1.jpg" alt="Product 1" /></a>
                  <p class="best-seller-title">Bán chạy</p>
                </div>
              </div>
              <div class="carousel-item">
                <div class="product-card">
                  <a href="#"><img src="/client_asset/image/home/best _seller_2.jpg" alt="Product 1" /></a>
                  <p class="best-seller-title">Bán chạy</p>
                </div>
              </div>
              <div class="carousel-item">
                <div class="product-card">
                  <a href="#"><img src="/client_asset/image/home/best _seller_3.jpg" alt="Product 1" /></a>
                  <p class="best-seller-title">Bán chạy</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </section> -->

        <!-- 4. SECTION 4 -->
        <section class="title-forward">
            <p class="fw-bold text-center w-75">
                "Một số người tìm kiếm một nơi đẹp đẽ, còn người sành điệu chọn biến
                nơi ở của mình đẹp đẽ hơn"
            </p>
        </section>
        <!-- 5. SECTION 5 -->
        <section class="banner">
            <img src="/client_asset/image/home/banner_home_2.png" alt="Banner Image" />
            <div class="banner-text">
                <p class="fw-bold">Các sản phẩm bán chạy của chúng tôi</p>
                <span class="mb-3">
                    Sản phẩm bán chạy nhất của chúng tôi mang đến chất lượng vượt
                    trội, được khách hàng trên khắp cả nước yêu thích và tin dùng.
                </span>
                <button class="d-block btn banner-btn mt-4">
                    Xem ngay <span><i class="bi bi-arrow-right"></i></span>
                </button>
            </div>
        </section>
        <!-- 6. SECTION 6 -->
        <section class="title-forward-bg">
            <p class="fw-bold text-center w-50">
                Xem sản phẩm của chúng tôi theo loại phòng
            </p>
        </section>
        <!-- 7.SECTION 7 -->
        <section class="banner-collection">
            <!-- 7. Living room -->
            <div class="banner mb-2">
                <img src="/client_asset/image/home/livingroom.jpg" alt="Banner Image" />
                <div class="overlay"></div>
                <div class="banner-collection-title">
                    <h1 class="text-white">Phòng khách</h1>
                    <a href="#" class="lead text-white">Xem sản phẩm <i class="bi bi-chevron-right"></i></a>
                </div>
            </div>
            <!-- 8. Dining room -->
            <div class="banner my-2">
                <img src="/client_asset/image/home/diningroom.jpg" alt="Banner Image" />
                <div class="overlay"></div>
                <div class="banner-collection-title">
                    <h1 class="text-white">Phòng ăn</h1>
                    <a href="#" class="lead text-white text-end"><i class="bi bi-chevron-left"></i>Xem sản
                        phẩm
                    </a>
                </div>
            </div>
            <!-- 9. Kitchen room -->
            <div class="banner my-2">
                <img src="/client_asset/image/home/kitchen.jpg" alt="Banner Image" />
                <div class="overlay"></div>
                <div class="banner-collection-title">
                    <h1 class="text-white">Phòng bếp</h1>
                    <a href="#" class="lead text-white text-end">Xem sản phẩm <i
                            class="bi bi-chevron-right"></i></a>
                </div>
            </div>
            <!-- 10. Bed room -->
            <div class="banner my-2">
                <img src="/client_asset/image/home/bedroom.jpg" alt="Banner Image" />
                <div class="overlay"></div>
                <div class="banner-collection-title text-white">
                    <h1 class="text-white">Phòng ngủ</h1>
                    <a href="#" class="lead text-white text-end"><i class="bi bi-chevron-left"></i> Xem sản
                        phẩm
                    </a>
                </div>
            </div>
        </section>
        <!-- 8. SECTION 8 -->
        <section class="title-forward">
            <p class="fw-bold text-center w-50">
                “Tôi sẽ làm cho mọi thứ trở nên tươi đẹp, đó sẽ là cuộc sống của
                tôi!”
            </p>
        </section>
        <!-- 9. SECTION 9 -->
        <!-- <section class="collection-content">
    <div class="testimonial-title container p-md-5 p-3">
      <h2 class="text-white">Bộ sưu tập</h2>
      <p>
        Lorem ipsum dolor sit amet consectetur adipiscing elit semper dalar
        elementum tempus hac tellus libero accumsan.
      </p>
    </div>
    <div class="collection-group container-fluid p-0">
      <div class="row m-0">
        <div class="col-md-3 col-6 p-0 position-relative">
          <img src="/client_asset/image/home/collect-1.jpg" alt="" />
          <div class="position-absolute collection-item text-center">
            <p>Kids lighting</p>
            <a href="#" class="btn">See more</a>
          </div>
        </div>
        <div class="col-md-3 col-6 p-0 position-relative">
          <img src="/client_asset/image/home/collect-2.jpg" alt="" />
          <div class="position-absolute collection-item text-center">
            <p>Woven decor</p>
            <a href="#" class="btn">See more</a>
          </div>
        </div>
        <div class="col-md-3 col-6 p-0 position-relative">
          <img src="/client_asset/image/home/collect-3.jpg" alt="" />
          <div class="position-absolute collection-item text-center">
            <p>Xmas decor</p>
            <a href="#" class="btn">See more</a>
          </div>
        </div>
        <div class="col-md-3 col-6 p-0 position-relative">
          <img src="/client_asset/image/home/collect-4.jpg" alt="" />
          <div class="position-absolute collection-item text-center">
            <p>Halloween</p>
            <a href="#" class="btn">See more</a>
          </div>
        </div>
      </div>
    </div>
    </section> -->
        <!-- 10. SECTION 10 -->
        <!-- <section class="home-category">
    <div class="container">
      <h2 class="p-5 text-white">Ours stock</h2>
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
    </section> -->

        <!-- 14.Comment -->
        <section class="comment-client">
            <div class="container p-5 text-center">
                <h2>Khách hàng của chúng tôi nói gì</h2>
                <p>
                    Những phản hồi từ khách hàng của chúng tôi cho thấy sự hài lòng về
                    chất lượng sản phẩm và dịch vụ tận tâm, chuyên nghiệp.
                </p>
            </div>
            <div class="container">
                <div class="slide_cmt">
                    <div class="card col shadow-sm">
                        <div class="card-body">
                            <p class="card-text">
                                "Hướng dẫn trực quan có thể là một wireframe, bố cục quảng
                                cáo, hoặc kiến ​​trúc thông tin."
                            </p>
                            <div class="d-flex align-items-center pt-4">
                                <img src="/client_asset/image/home/user-1.jpg" class="rounded-circle icon-xl"
                                    alt="" />
                                <div>
                                    <h5 class="card-title fw-bold">John Carter</h5>
                                    <span class="text-success">Head of Marketing</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card col shadow-sm">
                        <div class="card-body">
                            <p class="card-text">
                                "Hướng dẫn trực quan có thể là một wireframe, bố cục quảng
                                cáo, hoặc kiến ​​trúc thông tin. Một thiết bị cho phép cộng
                                tác sẽ làm giảm nguy cơ công việc phải làm lại hoàn toàn."
                            </p>
                            <div class="d-flex align-items-center pt-4">
                                <img src="/client_asset/image/home/user-2.jpg" class="rounded-circle icon-xl"
                                    alt="" />
                                <div>
                                    <h5 class="card-title fw-bold">Matt Cannon</h5>
                                    <span class="text-success">Testimonial Role</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card col shadow-sm">
                        <div class="card-body">
                            <p class="card-text">
                                "Hướng dẫn trực quan có thể là một wireframe, bố cục quảng
                                cáo, hoặc kiến ​​trúc thông tin. Một thiết bị cho phép cộng
                                tác sẽ làm giảm nguy cơ công việc phải làm lại hoàn toàn."
                            </p>
                            <div class="d-flex align-items-center pt-4">
                                <img src="/client_asset/image/home/user-3.jpg" class="rounded-circle icon-xl"
                                    alt="" />
                                <div>
                                    <h5 class="card-title fw-bold">Sophie Moore</h5>
                                    <span class="text-success">Lead Developer</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card col shadow-sm">
                        <div class="card-body">
                            <p class="card-text">
                                "Hướng dẫn trực quan có thể là một wireframe, bố cục quảng
                                cáo, hoặc kiến ​​trúc thông tin. Một thiết bị cho phép cộng
                                tác sẽ làm giảm nguy cơ công việc phải làm lại hoàn toàn."
                            </p>
                            <div class="d-flex align-items-center pt-4">
                                <img src="/client_asset/image/home/user-2.jpg" class="rounded-circle icon-xl"
                                    alt="" />
                                <div>
                                    <h5 class="card-title fw-bold">Jane Doeji</h5>
                                    <span class="text-success">CEO, Example Company</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card col shadow-sm">
                        <div class="card-body">
                            <p class="card-text">
                                "Hướng dẫn trực quan có thể là một wireframe, bố cục quảng
                                cáo, hoặc kiến ​​trúc thông tin. Một thiết bị cho phép cộng
                                tác sẽ làm giảm nguy cơ công việc phải làm lại hoàn toàn."
                            </p>
                            <div class="d-flex align-items-center pt-4">
                                <img src="/client_asset/image/home/user-2.jpg" class="rounded-circle icon-xl"
                                    alt="" />
                                <div>
                                    <h5 class="card-title fw-bold">Jane Doeji</h5>
                                    <span class="text-success">CEO, Example Company</span>
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
                <div class="contact-us-text col-12 col-md-6 text-white">
                    <h2 class="pb-4 text-white">Liên hệ</h2>
                    <p class="mb-3">
                        Nguyên mẫu cũng có thể được miễn một số yêu cầu sẽ áp dụng cho
                        sản phẩm cuối cùng.
                    </p>
                    <a href="mailto:contact@company.com" class="text-white mb-3">
                        <span><i class="bi bi-envelope me-2"></i></span>
                        contact@company.com</a><br />
                    <a href="tel:+123456789" class="text-white mb-3">
                        <span><i class="bi bi-telephone me-2"></i></span>
                        (123) 456-789</a><br />
                    <p class="mb-3">
                        <i class="bi bi-geo-alt me-2"></i>
                        794 Mcallister St San Francisco, 94102
                    </p>
                </div>
                <div class="contact-us-iframe col-12 col-md-6 p-0">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3833.801789055265!2d108.16736761086088!3d16.075772239198137!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314218e6e72e66f5%3A0x46619a0e2d55370a!2zMTM3IE5ndXnhu4VuIFRo4buLIFRo4bqtcCwgVGhhbmggS2jDqiBUw6J5LCBMacOqbiBDaGnhu4N1LCDEkMOgIE7hurVuZywgVmlldG5hbQ!5e0!3m2!1sen!2s!4v1710949332685!5m2!1sen!2s"
                        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </section>

    </div>
@endsection

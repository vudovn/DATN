@extends('client.layout')

@section('content')
    <section class="cart">
        <!-- <div>
                    <img src="/assets/image/banner/banner_product (1).png" alt="" width="100%"
                        style="filter:brightness(0.8);">
                </div> -->
        <div class="container my-lg-5">
            <div class="row">
                <p class="fs-1 fw-bold cart-title">Giỏ hàng</p>
                <div class="main-left col-xxl-8 col-md-12 col-sm-12">
                    <p class="fs-6 my-3">Bạn đang có <span class="fw-bold">1 sản phẩm</span> trong giỏ hàng</p>
                    <div class="cart-taskbar my-3 d-flex justify-content-between">
                        <div class="checkbox-wrapper-27">
                            <label class="checkbox">
                                <input type="checkbox" checked>
                                <span class="checkbox__icon"></span>
                                <span class="text">Chọn tất cả</span>
                            </label>
                        </div>
                        <div class="cart-taskbar d-grid gap-2 d-flex justify-content-end">
                            <form action="">
                                <button class=" me-md-2" type="button"><i class="bi bi-trash"></i> Xoá</button>
                            </form>
                            <form action="">
                                <button class="" type="button"><i class="bi bi-heart"></i> Yêu thích</button>
                            </form>
                        </div>
                    </div>
                    <div class="cart-container">
                        <div class="cart-item">
                            <div class="cart-item-check">
                                <div class="checkbox-wrapper-27">
                                    <label class="checkbox">
                                        <input type="checkbox">
                                        <span class="checkbox__icon"></span>
                                    </label>
                                </div>
                            </div>
                            <img alt="Black and white striped ceramic plate" height="100"
                                src="https://img.tripi.vn/cdn-cgi/image/width=700,height=700/https://gcs.tripi.vn/public-tripi/tripi-feed/img/474117AbK/anh-meme-hoi-cham-cute-nhat_034728404.jpg"
                                width="100" />
                            <div class="cart-item-details">
                                <div class="cart-item-title">
                                    Đĩa Sứ BLACK-&amp;-WHITE Hoa Văn Đen Trắng
                                </div>
                                <div class="cart-item-subtitle">
                                    Sọc ngang đen trắng / Dia:21cm
                                </div>
                                <div class="d-xxl-flex">
                                    <div class="cart-item-price">
                                        74,500₫
                                    </div>
                                    <div class="cart-item-old-price m-xxl-2 m-md-0">
                                        149,000₫
                                    </div>
                                </div>
                            </div>
                            <div class="pe-xxl-5">
                                <div class="cart-item-total text-center">
                                    74,500₫
                                </div>
                                <div class="input-group input-spinner d-flex">
                                    <input type="button" value="-" class="button-minus btn btn-sm"
                                        data-field="quantity">
                                    <input type="number" step="1" max="3" value="1" name="quantity"
                                        class="quantity-field form-control-sm form-input">
                                    <input type="button" value="+" class="button-plus btn btn-sm"
                                        data-field="quantity">
                                </div>
                            </div>
                            <div class="cart-item-remove">
                                <a href="">x</a>
                            </div>
                        </div>
                        <div class="cart-item">
                            <div class="cart-item-check">
                                <div class="checkbox-wrapper-27">
                                    <label class="checkbox">
                                        <input type="checkbox">
                                        <span class="checkbox__icon"></span>
                                    </label>
                                </div>
                            </div>
                            <img alt="Wooden dining chair" height="100"
                                src="https://cdn2.fptshop.com.vn/unsafe/Uploads/images/tin-tuc/185857/Originals/meme-het-cuu%20(1).jpg"
                                width="100" />
                            <div class="cart-item-details">
                                <div class="cart-item-title">
                                    Ghế Ăn Gỗ Sồi HARRIS
                                </div>
                                <div class="d-xxl-flex">
                                    <div class="cart-item-price">
                                        2,490,000₫
                                    </div>
                                    <div class="cart-item-old-price m-xxl-2 m-md-0">
                                        3,149,000₫
                                    </div>
                                </div>
                            </div>
                            <div class="pe-xxl-5">
                                <div class="cart-item-price text-center">
                                    2,490,000₫
                                </div>
                                <div class="input-group input-spinner d-flex">
                                    <input type="button" value="-" class="button-minus btn btn-sm"
                                        data-field="quantity">
                                    <input type="number" step="1" max="3" value="1" name="quantity"
                                        class="quantity-field form-control-sm form-input">
                                    <input type="button" value="+" class="button-plus btn btn-sm"
                                        data-field="quantity">
                                </div>
                            </div>
                            <div class="cart-item-remove">
                                <a href="">x</a>
                            </div>
                        </div>
                        <div class="cart-item">
                            <div class="cart-item-check">
                                <div class="checkbox-wrapper-27">
                                    <label class="checkbox">
                                        <input type="checkbox">
                                        <span class="checkbox__icon"></span>
                                    </label>
                                </div>
                            </div>
                            <img alt="Wooden dining chair" height="100"
                                src="https://i.pinimg.com/236x/0f/3f/eb/0f3feb96466565cc39d182dc3808085d.jpg"
                                width="100" />
                            <div class="cart-item-details">
                                <div class="cart-item-title">
                                    Ghế Ăn Gỗ Sồi HARRIS
                                </div>
                                <div class="d-xxl-flex">
                                    <div class="cart-item-price">
                                        2,490,000₫
                                    </div>
                                    <div class="cart-item-old-price m-xxl-2 m-md-0">
                                        3,149,000₫
                                    </div>
                                </div>
                            </div>
                            <div class="pe-xxl-5">
                                <div class="cart-item-price text-center">
                                    2,490,000₫
                                </div>
                                <div class="input-group input-spinner d-flex">
                                    <input type="button" value="-" class="button-minus btn btn-sm"
                                        data-field="quantity">
                                    <input type="number" step="1" max="3" value="1" name="quantity"
                                        class="quantity-field form-control-sm form-input">
                                    <input type="button" value="+" class="button-plus btn btn-sm"
                                        data-field="quantity">
                                </div>
                            </div>
                            <div class="cart-item-remove">
                                <a href="">x</a>
                            </div>
                        </div>
                        <div class="cart-item">
                            <div class="cart-item-check">
                                <div class="checkbox-wrapper-27">
                                    <label class="checkbox">
                                        <input type="checkbox">
                                        <span class="checkbox__icon"></span>
                                    </label>
                                </div>
                            </div>
                            <img alt="Black and white striped ceramic plate" height="100"
                                src="https://img.tripi.vn/cdn-cgi/image/width=700,height=700/https://gcs.tripi.vn/public-tripi/tripi-feed/img/474117AbK/anh-meme-hoi-cham-cute-nhat_034728404.jpg"
                                width="100" />
                            <div class="cart-item-details">
                                <div class="cart-item-title">
                                    Đĩa Sứ BLACK-&amp;-WHITE Hoa Văn Đen Trắng
                                </div>
                                <div class="cart-item-subtitle">
                                    Sọc ngang đen trắng / Dia:21cm
                                </div>
                                <div class="d-xxl-flex">
                                    <div class="cart-item-price">
                                        74,500₫
                                    </div>
                                    <div class="cart-item-old-price m-xxl-2 m-md-0">
                                        149,000₫
                                    </div>
                                </div>
                            </div>
                            <div class="pe-xxl-5">
                                <div class="cart-item-total text-center">
                                    74,500₫
                                </div>
                                <div class="input-group input-spinner d-flex">
                                    <input type="button" value="-" class="button-minus btn btn-sm"
                                        data-field="quantity">
                                    <input type="number" step="1" max="3" value="1" name="quantity"
                                        class="quantity-field form-control-sm form-input">
                                    <input type="button" value="+" class="button-plus btn btn-sm"
                                        data-field="quantity">
                                </div>
                            </div>
                            <div class="cart-item-remove">
                                <a href="">x</a>
                            </div>
                        </div>
                        <div class="cart-item">
                            <div class="cart-item-check">
                                <div class="checkbox-wrapper-27">
                                    <label class="checkbox">
                                        <input type="checkbox">
                                        <span class="checkbox__icon"></span>
                                    </label>
                                </div>
                            </div>
                            <img alt="Black and white striped ceramic plate" height="100"
                                src="https://img.tripi.vn/cdn-cgi/image/width=700,height=700/https://gcs.tripi.vn/public-tripi/tripi-feed/img/474117AbK/anh-meme-hoi-cham-cute-nhat_034728404.jpg"
                                width="100" />
                            <div class="cart-item-details">
                                <div class="cart-item-title">
                                    Đĩa Sứ BLACK-&amp;-WHITE Hoa Văn Đen Trắng
                                </div>
                                <div class="cart-item-subtitle">
                                    Sọc ngang đen trắng / Dia:21cm
                                </div>
                                <div class="d-xxl-flex">
                                    <div class="cart-item-price">
                                        74,500₫
                                    </div>
                                    <div class="cart-item-old-price m-xxl-2 m-md-0">
                                        149,000₫
                                    </div>
                                </div>
                            </div>
                            <div class="pe-xxl-5">
                                <div class="cart-item-total text-center">
                                    74,500₫
                                </div>
                                <div class="input-group input-spinner d-flex">
                                    <input type="button" value="-" class="button-minus btn btn-sm"
                                        data-field="quantity">
                                    <input type="number" step="1" max="3" value="1" name="quantity"
                                        class="quantity-field form-control-sm form-input">
                                    <input type="button" value="+" class="button-plus btn btn-sm"
                                        data-field="quantity">
                                </div>
                            </div>
                            <div class="cart-item-remove">
                                <a href="">x</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="main-right col-xxl-4 col-md-12 col-12 border border-2 rounded h-100">
                    <p class="fs-2 text-dark py-4 fw-bold">Tóm tắt đơn hàng</p>
                    <div class="d-flex justify-content-between">
                        <p class="fs-6">Tạm tính (3 sản phẩm):</p>
                        <p class="cart-total">5.054.500₫</p>
                    </div>
                    <p class="cart-delivery-title">Vận chuyển</p>
                    <div class="cart-delivery">
                        <div class="checkbox-wrapper-27">
                            <label class="checkbox">
                                <input type="checkbox" checked>
                                <span class="checkbox__icon"></span>
                                <span class="text">Liên hệ phí vận chuyển sau</span>
                            </label>
                        </div>
                        <div class="checkbox-wrapper-27">
                            <label class="checkbox">
                                <input type="checkbox">
                                <span class="checkbox__icon"></span>
                                <span class="text">Phí vận chuyển</span>
                            </label>
                        </div>
                        <p>Tùy chọn vận chuyển sẽ được cập nhật khi thanh toán</p>
                    </div>
                    <div class="cart-discount d-flex my-5">
                        <input type="text" class="form-control w-75" placeholder="Mã giảm giá">
                        <button type="submit" class="form-control w-25 ms-2">Áp dụng</button>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="fs-6">Phí vận chuyển:</p>
                        <p class="cart-total">Free</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="fs-6">Thành tiền:</p>
                        <p class="cart-total">5.054.500₫</p>
                    </div>
                    <p class="cart-discount-title mt-3">Thông tin giao hàng</p>
                    <p class="my-2 text">Đối với những sản phẩm có sẵn tại khu vực, Thế giới nội thất sẽ giao hàng
                        trong vòng 2-7 ngày. Đối với những sản phẩm không có sẵn, thời gian giao hàng sẽ được nhân
                        viên Thế giới nội thất thông báo đến quý khách.</p>
                    <div class="cart-last-step d-flex my-4">
                        <button type="submit" class="cart-back form-control w-50 ms-2">Tiếp tục mua hàng</button>
                        <button type="submit" class="cart-checkout form-control w-50 ms-2">Đặt hàng</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- slide -->
    <section class="recently_vd container mb-5">
        <div>
            <h3>Đã xem gần đây</h3>
            <button class="carousel-control-next" type="button" data-bs-target="#recentlyViewedCarousel"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"><i
                        class="fa-solid fa-chevron-right"></i></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <div id="recentlyViewedCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
                            <div class="product-card">
                                <a href="">
                                    <div>
                                        <img class="img-fluid" data-img-hover="/assets/image/footer/pic1.png"
                                            src="https://noithatgiakho.com/upload/sanpham/large/giuong-ngu-boc-nem-da-dep-hien-dai-gia-re-368-38b3ef.jpg" class="product-image img-fluid" />
                                    </div>
                                </a>
                                <a href="" class="title_product">
                                    <h6 class="mt-2">Gather Couch</h6>
                                </a>
                                <p>12,300,000 đ</p>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
                            <div class="product-card">
                                <a href="">
                                    <div>
                                        <img class="img-fluid" src="https://noithatgiakho.com/upload/sanpham/large/giuong-ngu-boc-nem-da-dep-hien-dai-gia-re-368-38b3ef.jpg"
                                            class="product-image img-fluid" />
                                    </div>
                                </a>
                                <a href="" class="title_product">
                                    <h6 class="mt-2">Gather Couch</h6>
                                </a>
                                <p>12,300,000 đ</p>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
                            <div class="product-card">
                                <a href="">
                                    <div>
                                        <img class="img-fluid" src="https://noithatgiakho.com/upload/sanpham/large/giuong-ngu-boc-nem-da-dep-hien-dai-gia-re-368-38b3ef.jpg"
                                            class="product-image img-fluid" />
                                    </div>
                                </a>
                                <a href="" class="title_product">
                                    <h6 class="mt-2">Gather Couch</h6>
                                </a>
                                <p>12,300,000 đ</p>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
                            <div class="product-card">
                                <a href="">
                                    <div>
                                        <img class="img-fluid" src="https://noithatgiakho.com/upload/sanpham/large/giuong-ngu-boc-nem-da-dep-hien-dai-gia-re-368-38b3ef.jpg"
                                            class="product-image img-fluid" />
                                    </div>
                                </a>
                                <a href="" class="title_product">
                                    <h6 class="mt-2">Gather Couch</h6>
                                </a>
                                <p>12,300,000 đ</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
                            <div class="product-card">
                                <a href="">
                                    <div>
                                        <img src="https://noithatgiakho.com/upload/sanpham/large/giuong-ngu-boc-nem-da-dep-hien-dai-gia-re-368-38b3ef.jpg" class="product-image img-fluid" />
                                    </div>
                                </a>
                                <a href="" class="title_product">
                                    <h6 class="mt-2">Gather Couch</h6>
                                </a>
                                <p>12,300,000 đ</p>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
                            <div class="product-card">
                                <a href="">
                                    <div>
                                        <img src="https://noithatgiakho.com/upload/sanpham/large/giuong-ngu-boc-nem-da-dep-hien-dai-gia-re-368-38b3ef.jpg" class="product-image img-fluid" />
                                    </div>
                                </a>
                                <a href="" class="title_product">
                                    <h6 class="mt-2">Gather Couch</h6>
                                </a>
                                <p>12,300,000 đ</p>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
                            <div class="product-card">
                                <a href="">
                                    <div>
                                        <img src="https://noithatgiakho.com/upload/sanpham/large/giuong-ngu-boc-nem-da-dep-hien-dai-gia-re-368-38b3ef.jpg" class="product-image img-fluid" />
                                    </div>
                                </a>
                                <a href="" class="title_product">
                                    <h6 class="mt-2">Gather Couch</h6>
                                </a>
                                <p>12,300,000 đ</p>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-3">
                            <div class="product-card">
                                <a href="">
                                    <div>
                                        <img src="https://noithatgiakho.com/upload/sanpham/large/giuong-ngu-boc-nem-da-dep-hien-dai-gia-re-368-38b3ef.jpg" class="product-image img-fluid" />
                                    </div>
                                </a>
                                <a href="" class="title_product">
                                    <h6 class="mt-2">Gather Couch</h6>
                                </a>
                                <p>12,300,000 đ</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev d-none" type="button" data-bs-target="#recentlyViewedCarousel"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"><i
                        class="fa-solid fa-chevron-left"></i></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next d-none" type="button" data-bs-target="#recentlyViewedCarousel"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"><i
                        class="fa-solid fa-chevron-right"></i></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>
@endsection

@extends('client.layout')

@section('content')
    <section class="container account mb-5">
        <!-- đường dẫn -->
        <div class="d-none d-xxl-block mp-5 mb-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="trangchu.html" class="text-stnt">Trang chủ</a>
                    </li>
                    <!-- <li class="breadcrumb-item"><a href="product.html" class="text-stnt">Sản phẩm</a></li> -->
                    <li class="breadcrumb-item active" aria-current="page">
                        Thông tin tài khoảng
                    </li>
                </ol>
            </nav>
        </div>
        <!-- end đường dẫn -->

        <div class="row justify-content-center">
            <div class="col-xll-9 col-md-9 col-12">
                <div class="row mb-3">
                    <div class="col-xxl-8 mb-4">
                        <div class="info-card p-5 p-xxl-7">
                            <div class="d-flex justify-content-between align-items-center mx-4">
                                <h4 class="section-title m-0"><i class="bi bi-person-circle lead me-2"></i>Hồ sơ của tôi
                                </h4>
                                <button class="btn float-end border-0" data-bs-toggle="modal" data-bs-target="#updateModal">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                            </div>
                            <div class="info-text">
                                <p><strong>Tên của bạn</strong>: Vudo Admin</p>
                                <p><strong>Email của bạn</strong>: vudevweb@gmail.com</p>
                                <p><strong>Số điện thoại:</strong> 0779440918</p>
                                <p><strong>Giới tính</strong>: Nam</p>
                                <p><strong>Ngày sinh</strong>: 4-4-2004 </p>
                            </div>
                            <a href="#" class="change-password float-end btn">Đổi mật khẩu</a>
                        </div>
                    </div>

                    <div class="col-xxl-4 mb-4 ps-xxl-0">
                        <div class="info-card p-5 p-xxl-7">
                            <div class="d-flex justify-content-between align-items-center mx-4">
                                <h4 class="section-title m-0"><i class="bi bi-credit-card-2-back-fill lead me-2"></i>Thẻ tín
                                    dụng</h4>
                                <button class="btn float-end border-0" data-bs-toggle="modal" data-bs-target="#cardModal">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                            </div>
                            <div class="info-text">
                                <p>Không có thẻ nào được đặt làm mặc định.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-12 mb-4">
                        <div class="info-card p-5 p-xxl-7">
                            <div class="d-flex justify-content-between align-items-center mx-4">
                                <h4 class="section-title m-0"><i class="bi bi-geo-alt-fill lead me-2"></i>Địa chỉ</h4>
                                <button class="btn float-end border-0" data-bs-toggle="modal"
                                    data-bs-target="#addressModal">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                            </div>

                            <div class="info-text">
                                <p>Your location</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-12 mb-4">
                        <div class="info-card p-5 p-xxl-7">
                            <div class="d-flex justify-content-between align-items-center mx-4">
                                <h4 class="section-title"><i class="bi bi-archive-fill lead me-2"></i> Đơn hàng của tôi</h4>
                            </div>
                            <p class="info-text mx-4">Bạn không có giao dịch nào gần đây.</p>
                        </div>
                    </div>

                    <div class="col-xxl-12 mb-4">
                        <div class="info-card p-5 p-xxl-7">
                            <div class="d-flex justify-content-between align-items-center mx-4">
                                <h4 class="section-title"><i class="bi bi-clock-fill lead me-2"></i>Lịch sử đơn hàng</h4>
                            </div>
                            <p class="info-text mx-4">Bạn không có lịch sử giao dịch nào gần đây.</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </section>
@endsection

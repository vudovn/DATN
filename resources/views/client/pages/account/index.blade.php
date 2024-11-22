@extends('client.layout')

@section('content')
    <section class="container account mb-5">
        <!-- Breadcrumb -->
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

        <!-- Account Info -->
        <div class="row justify-content-center">
            <div class="col-lg-9 col-md-10">
                <div class="row">
                    <!-- Hồ sơ -->
                    <div class="col-lg-12 mb-4">
                        <div class="info-card p-4 shadow-sm rounded bg-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <h7 class="fw-bold m-0 text-tgnt">
                                    <i class="bi bi-person-circle me-2"></i> Thông tin tài khoản
                                </h7>
                                <button class="btn btn-tgnt btn-sm" data-bs-toggle="modal" data-bs-target="#editAccount">
                                    <i class="bi bi-pencil-square"></i> Sửa
                                </button>
                            </div>
                            <hr>
                            <ul class="list-unstyled mb-1">
                                <li><strong>Tên:</strong> <span class="account_name">{{ $user->name }}</span></li>
                                <li><strong>Số điện thoại:</strong> <span class="account_phone">{{ $user->phone }}</span>
                                </li>
                                <li><strong>Email:</strong> <span class="account_email">{{ $user->email }}</span></li>
                                <li><strong>Địa chỉ: </strong> {{ $user->ward->name }}, {{ $user->district->name }},
                                    {{ $user->province->name }} </li>
                            </ul>
                            <div class="text-end">
                                <button href="#" class="btn btn-outline-tgnt btn-sm">Đổi mật khẩu</button>
                            </div>
                        </div>
                    </div>

                    <!-- Đơn hàng -->
                    <div class="col-12 mb-4">
                        <div class="info-card p-4 shadow-sm rounded bg-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <h7 class="fw-bold text-tgnt m-0">
                                    <i class="bi bi-archive-fill me-2"></i> Đơn hàng của tôi
                                </h7>
                            </div>
                            <hr>
                            <div class="text-center">
                                <p class="text-muted">Bạn không có giao dịch nào gần đây.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Lịch sử đơn hàng -->
                    <div class="col-12">
                        <div class="info-card p-4 shadow-sm rounded bg-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <h7 class="fw-bold text-tgnt m-0">
                                    <i class="bi bi-clock-fill me-2"></i> Lịch sử đơn hàng
                                </h7>
                            </div>
                            <hr>
                            <div class="text-center">
                                <p class="text-muted">Bạn không có lịch sử giao dịch nào gần đây.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

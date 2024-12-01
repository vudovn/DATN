@extends('client.layout')

@section('content')
    <section class="container account mb-5">
        <!-- Breadcrumb -->
        <div class="d-none d-xxl-block mp-5 mb-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('client.home') }}" class="text-stnt">Trang chủ</a>
                    </li>
                    <!-- <li class="breadcrumb-item"><a href="product.html" class="text-stnt">Sản phẩm</a></li> -->
                    <li class="breadcrumb-item active" aria-current="page">
                        Thông tin tài khoản
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Account Info -->
        <div class="row">
            <div class="col-lg-4 col-12">
                <div class="row">
                    <!-- Hồ sơ -->
                    @include('client.pages.account.components.info')
                </div>
            </div>
            <div class="col-lg-8 col-12">
                <!-- Đơn hàng -->
                @include('client.pages.account.components.order')
            </div>
        </div>
    </section>
@endsection

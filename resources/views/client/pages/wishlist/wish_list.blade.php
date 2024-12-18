@extends('client.layout')

@section('content')
    <section class="container mt-3">
        <div class="d-none d-xxl-block mp-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('client.home') }}" class="text-stnt">Trang chủ</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Sản phẩm yêu thích</li>
                </ol>
            </nav>
        </div>
        <div data-url-home="{{ route('client.home') }}" class="row animate__animated animate__fadeIn listProduct mb-4">
            @if (Auth()->check())
                @if ($user->wishlists->count() > 0)
                    @foreach ($user->wishlists as $wishlist)
                        <x-product_card :data="$wishlist->product" :dataType="'remove'" />
                    @endforeach
                @else
                    <div class="col-12 py-15 animate__animated animate__fadeIn">
                        <div class="text-center">
                            <img class="mb-3 mb-3" width="100"
                                src="https://deo.shopeemobile.com/shopee/shopee-pcmall-live-sg/orderlist/5fafbb923393b712b964.png"
                                alt="">
                            <p>Chưa có sản phẩm yêu thích nào!</p>
                            <a class="btn btn-tgnt" href="{{ route('client.home') }}">Thêm ngay</a>
                        </div>
                    </div>
                @endif
            @else
                <div class="col-12 py-15 animate__animated animate__fadeIn">
                    <div class="text-center">
                        <img class="mb-3 mb-3" width="100"
                            src="https://deo.shopeemobile.com/shopee/shopee-pcmall-live-sg/orderlist/5fafbb923393b712b964.png"
                            alt="">
                        <p class="text-tgnt">Bạn cần phải đăng nhập, để xem được sản phẩm yêu thích của mình !</p>
                        <a class="btn btn-tgnt" href="{{ route('client.auth.login') }}">Đăng nhập ngay</a>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection

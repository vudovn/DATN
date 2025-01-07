@extends('client.layout')

@section('content')
    <script>
        let homeUrl = @json(route('client.home'));
    </script>
    <section class="cart">
        <div class="container my-lg-5">
            <p class="fs-1 fw-bold cart-title">Giỏ hàng</p>
            <div class="cart-client row">
                @if (isset($carts) && $carts->count() > 0)
                    <div class="main-left col-xxl-8 col-md-12 col-sm-12">
                        <hr class="border-4 w-25 fw-bold mt-0">
                        <div class="cart-container">
                            <p class="fs-6 my-3">Bạn đang có <span class="fw-bold cart_count">{{ $carts->count() }}</span> sản
                                phẩm
                                trong giỏ hàng</p>
                            {{-- <div class="cart-taskbar my-3 d-flex justify-content-between">
                                <div class="checkbox-wrapper-27">
                                    <label class="checkbox">
                                        <input type="checkbox" checked disabled>
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
                            </div> --}}
                            <div class="list-cart line-y" id="list-cart">
                                {{-- Render product in cart --}}
                                {!! $listCart !!}
                            </div>
                        </div>
                    </div>
                    <div class="main-right col-xxl-4 col-md-12 col-12 border  rounded h-100">
                        <p class="fs-2 text-dark py-4 fw-bold">Tổng quan đơn hàng</p>
                        <div class="d-flex justify-content-between">
                            <p class="fs-6">Giỏ hàng (<span class="cart_count">{{ $carts->count() }}</span> sản phẩm):</p>
                            <p class="cart-total"><span id="cart-total"></span>₫</p>
                            <input type="hidden" id="cart-total-input" value=""></input>
                        </div>
                        @if (count($discountCollection) > 0)
                            {{-- <p class="cart-discount-collection-title">Giảm giá bộ sưu tập</p>
                        <p class="text">Chính sách giảm giá theo phần trăm của bộ sưu tập được áp dụng cho các sản phẩm cụ
                            thể trong thời gian khuyến mãi. Mức giảm giá có thể dao động từ 1% đến 50% tùy từng bộ sưu tập
                            và chương trình ưu đãi. Khách hàng sẽ có cơ hội sở hữu những sản phẩm chất lượng với mức giá hấp
                            dẫn, tiết kiệm chi phí khi mua sắm.</p> --}}
                            <button class="cart-discount-collection-title btn btn-link p-0" type="button"
                                data-bs-toggle="collapse" data-bs-target="#discount-collection" aria-expanded="false"
                                aria-controls="discount-collection">
                                Giảm giá bộ sưu tập <i class="fa-solid fa-caret-down"></i>
                            </button>
                            <div class="collapse" id="discount-collection">
                                <div class="card card-body">
                                    Chính sách giảm giá theo bộ sưu tập được áp dụng cho các sản phẩm cụ
                                    thể trong thời gian khuyến mãi. Mức giảm giá có thể dao động từ 1% đến 50% tùy từng bộ
                                    sưu
                                    tập
                                    và chương trình ưu đãi. Khách hàng sẽ có cơ hội sở hữu những sản phẩm chất lượng với mức
                                    giá
                                    hấp
                                    dẫn, tiết kiệm chi phí khi mua sắm.
                                </div>
                            </div>
                            <div class="cart-discount-collection border-bottom pb-3">
                                {{-- RENDE JS --}}
                            </div>
                            <div class="d-flex justify-content-between mt-3">
                                <p class="fs-6">Tiết kiệm: </p>
                                <p class="cart-total"><span class="save-price"
                                        id="save-price">{{ formatMoney($discountCollection['totalDiscountAmount']) }}</span>₫
                                </p>
                            </div>
                        @endif
                        <div class="d-flex justify-content-between">
                            <p class="fs-6">Thành tiền:</p>
                            <p class="cart-total"><span id="cart-total-discount-collection"></span>₫</p>
                            <input type="hidden" id="cart-total-discount-collection-input" value=""></input>
                        </div>
                        <p class="cart-discount-title mt-3">Thông tin giao hàng</p>
                        <p class="my-2 text">Đối với những sản phẩm có sẵn tại khu vực, "Thế giới nội thất" sẽ giao hàng
                            trong vòng 2-7 ngày. Đối với những sản phẩm không có sẵn, thời gian giao hàng sẽ được nhân
                            viên "Thế giới nội thất" thông báo đến quý khách.</p>
                        <div class="cart-last-step d-flex my-4">
                            <a href="{{ route('client.home') }}" class="cart-back btn btn-outline-tgnt w-50 ms-2">Tiếp tục
                                mua hàng</a>
                            <div class="value-cart">
                                <input type="hidden" class="total-cart-input" value="">
                            </div>
                            <a href="{{ $carts->count() > 0 ? route('client.checkout.index') : 'javascript:void(0);' }}"
                                class="checkout-cart btn btn-tgnt w-50 ms-2">
                                Đặt hàng
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- slide -->
    <section class="container mb-5">
        <h3 class="fw-bold pb-4">Sản phẩm đã xem gần đây</h3>
        <div class="row animate__animated animate__fadeIn listProduct mb-4" id="slide-featured">
            @foreach ($product_featureds->take(8) as $product_featured)
                    <x-product_card :data="$product_featured" />
                @endforeach
        </div>
    </section>
@endsection

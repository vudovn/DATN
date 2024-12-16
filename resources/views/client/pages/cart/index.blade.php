@extends('client.layout')

@section('content')
<script>
    let homeUrl = @json(route('client.home'));
</script>
    <section class="cart">
        <div class="container my-lg-5">
            <div class="row">
                <p class="fs-1 fw-bold cart-title">Giỏ hàng</p>
                <div class="main-left col-xxl-8 col-md-12 col-sm-12">
                    <hr class="border-4 w-25 fw-bold mt-0">
                    <div class="cart-container">
                        @if (isset($carts) && $carts->count() > 0)
                            <p class="fs-6 my-3">Bạn đang có <span class="fw-bold cart_count">{{ $carts->count() }}</span> sản phẩm
                                trong giỏ hàng</p>
                            <div class="cart-taskbar my-3 d-flex justify-content-between">
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
                            </div>
                            <div class="list-cart line-y" id="list-cart">
                                {{-- Render product in cart --}}
                                {!! $listCart !!}
                            </div>
                        @else
                            <div class="container cart-no-item text-center mb-4 pt-15">
                                <img src="{{ asset('uploads/image/system/no_product.webp') }}"
                                    alt="" width="100">
                                <p class="text-muted fw-bold mb-3 mt-3">Giỏ hàng của bạn còn trống</p>
                                <a class="btn btn-tgnt w-25" href="{{ route('client.home') }}">Mua ngay</a>
                            </div>
                            
                        @endif
                    </div>
                </div>
                <div class="main-right col-xxl-4 col-md-12 col-12 border  rounded h-100">
                    <p class="fs-2 text-dark py-4 fw-bold">Tổng quan đơn hàng</p>
                    <div class="d-flex justify-content-between">
                        <p class="fs-6">Giỏ hàng (<span class="cart_count"></span> sản phẩm):</p>
                        <p class="cart-total"><span id="cart-total"></span>₫</p>
                        <input type="hidden" id="cart-total-input" value=""></input>
                    </div>
                    <p class="cart-delivery-title">Vận chuyển</p>
                    <div class="cart-delivery">
                        <div class="checkbox-wrapper-27">
                            <label class="checkbox">
                                <input type="checkbox" checked disabled>
                                <span class="checkbox__icon"></span>
                                <span class="text">Liên hệ phí vận chuyển sau</span>
                            </label>
                        </div>
                        <div class="checkbox-wrapper-27">
                            <label class="checkbox">
                                <input type="checkbox" disabled>
                                <span class="checkbox__icon"></span>
                                <span class="text">Phí vận chuyển</span>
                            </label>
                        </div>
                        <p>Tùy chọn vận chuyển sẽ được cập nhật khi thanh toán</p>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <p class="fs-6">Tiết kiệm:</p>
                        <p class="cart-total"><span class="save-price" id="save-price"></span>0₫</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="fs-6">Thành tiền:</p>
                        <p class="cart-total"><span id="cart-total-discount"></span>₫</p>
                        <input type="hidden" id="cart-total-discount-input" value=""></input>
                    </div>
                    <p class="cart-discount-title mt-3">Thông tin giao hàng</p>
                    <p class="my-2 text">Đối với những sản phẩm có sẵn tại khu vực, "Thế giới nội thất" sẽ giao hàng
                        trong vòng 2-7 ngày. Đối với những sản phẩm không có sẵn, thời gian giao hàng sẽ được nhân
                        viên "Thế giới nội thất" thông báo đến quý khách.</p>
                    <div class="cart-last-step d-flex my-4">
                            <a href="{{ route('client.home') }}" class="cart-back btn btn-outline-tgnt w-50 ms-2">Tiếp tục
                                mua hàng</a>
                            <div class="value-cart">
                                <input type="hidden" class="total-cart-input" value="" >
                            </div>
                            <a href="{{ $carts->count() > 0 ? route('client.checkout.index') : 'javascript:void(0);' }}" 
                                class="checkout-cart btn btn-tgnt w-50 ms-2">
                                 Đặt hàng
                             </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- slide -->
    <section class="container mb-5">
        <h3 class="fw-bold pb-4">Sản phẩm đã xem gần đây</h3>
        <div class="row animate__animated animate__fadeIn listProduct mb-4" id="slide-featured">
            @foreach (getHistoryProduct() as $product_featured)
                <x-product_card :data="$product_featured"/>
            @endforeach
        </div>
    </section>
@endsection

@extends('client.layout')

@section('content')
    <section class="checkout">
        <div class="container my-lg-5">
            <div class="row">
                <div class="main-left col-xxl-8 col-md-12 col-sm-12">
                    <div class="alert alert-primary" role="alert">
                        <strong>Lưu ý:</strong> <span class="text-danger">(*)</span> là trường bắt buộc nhập
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label for="customer_name">Tên khách hàng: <span class="text-danger">*</span></label>
                                    <input type="text" id="customer_name" name="name" class="form-control"
                                        value="{{ $user->name }}" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label for="customer_email">Email: <span class="text-danger">*</span></label>
                                    <input type="text" id="customer_email" name="email" class="form-control"
                                        value="{{ $user->email }}" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label for="customer_phone">Phone: <span class="text-danger">*</span></label>
                                    <input type="text" id="customer_phone" name="phone" class="form-control"
                                        value="{{ $user->phone }}" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <!-- Phương Thức Thanh Toán -->
                                <div class="form-group mb-3">
                                    <label for="payment_method">Phương Thức Thanh Toán: <span class="text-danger">*</span></label>
                                    <input type="text" id="payment_method" name="payment_method" class="form-control"
                                        value="{{ $user->payment_method ?? 'Đợi có dữ liệu bảng phương thức thanh toán' }}">
                                </div>
                            </div>
                        </div>

                        <!-- Địa chỉ giao hàng -->
                        @include('client.pages.cart.components.location')
                        <div class="form-group mb-3">
                            <x-input :label="'Địa chỉ chi tiết'" name="address" :value="$address" :required="true" />
                        </div>

                        <!-- Note -->
                        <div class="form-group mb-3">
                            <label for="customer_note">Ghi chú:</label>
                            <textarea type="text" id="customer_note" name="note" class="form-control" value="{{ $user->note }}"
                                placeholder="Ghi chú cho cửa hàng" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="main-right col-xxl-4 col-md-12 col-12 border  rounded h-100">
                    @include('client.pages.cart.components.add_product', $products)
                    @auth
                        <div class="cart-discount d-flex my-5">
                            <input type="text" class="code-discount form-control w-75 rounded-pill" placeholder="Mã giảm giá"
                                value="">
                            <button type="button" class="apply-discount btn btn-tgnt w-25 ms-2">Áp dụng</button>
                        </div>
                        <div class="list-discount">
                        </div>
                    @endauth
                    @guest
                        <div class="cart-login d-flex my-5">
                            <a href="{{ route('client.auth.login') }}" class="btn btn-tgnt w-100">Đăng nhập để áp dụng mã giảm
                                giá</a>
                        </div>
                    @endguest
                    <div class="d-flex justify-content-between">
                        <p class="fs-6">Tiết kiệm:</p>
                        <p class="cart-total"><span class="save-price" id="save-price"></span>₫</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="fs-6">Thành tiền:</p>
                        <p class="cart-total"><span id="cart-total-discount">{{ formatNumber($total) }}</span>₫</p>
                        <input type="hidden" id="cart-total-discount-input" value="{{ $total }}"></input>
                    </div>
                    <div class="cart-last-step d-flex my-4">
                        <a href="{{ route('client.cart.index') }}" class="cart-back btn btn-outline-tgnt w-50 ms-2">Trở lại
                            đơn hàng</a>
                        <div class="value-cart">
                            <input type="hidden" class="total-cart-input" value="">
                        </div>
                        <a href="{{ route('client.checkout.index') }}" type="button"
                            class="checkout-cart btn btn-tgnt w-50 ms-2">Thanh toán </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
<style>
    .cart-total {
    color: var(--base-color);
    font-weight: bold;
   font-size: clamp(13px, 1.2vw, 20px);
} 
</style>
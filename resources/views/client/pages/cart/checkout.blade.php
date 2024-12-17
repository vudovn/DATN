@extends('client.layout')

@section('content')
    {{-- <div style="height: 1000px; width:100px"></div> --}}
    <section class="checkout">
        <form class="form_payment" action="" method="post">
            @csrf
            <div class="container my-lg-5">
                <div class="row">
                    <div class="main-left col-xxl-8 col-md-12 col-sm-12">
                        <div class="card-body">
                            <div class="alert alert-primary" role="alert">
                                <strong>Lưu ý:</strong> <span class="text-danger">(*)</span> là trường bắt buộc nhập
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group mb-3">
                                        <label for="customer_name">Tên khách hàng: <span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="customer_name" name="name" class="form-control"
                                            value="{{ $user->name }}" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group mb-3">
                                        <label for="customer_phone">Phone: <span class="text-danger">*</span></label>
                                        <input type="text" id="customer_phone" name="phone" class="form-control"
                                            value="{{ $user->phone }}" required>
                                    </div>
                                </div>
                                {{-- <div class="col-12">
                                    <!-- Phương Thức Thanh Toán -->
                                    <div class="form-group mb-3">
                                        <label for="payment_method">Phương Thức Thanh Toán: <span
                                                class="text-danger">*</span></label>
                                        <input type="text" id="payment_method" name="payment_method" class="form-control"
                                            value="{{ $user->payment_method ?? 'Tiền mặt' }}" disabled>
                                    </div>
                                </div> --}}
                                <div class="tab_location">
                                    @include('client.pages.cart.components.checkout.location')
                                    <div class="form-group mb-3">
                                        <label for="">Địa chỉ chi tiết</label>
                                        <input type="text" placeholder="Số nhà, ngõ, ..." name="address"
                                            class="form-control" required>
                                    </div>
                                </div>
                                <!-- Note -->
                                <div class="form-group mb-3">
                                    <label for="customer_note">Ghi chú:</label>
                                    <textarea type="text" id="customer_note" name="note" class="form-control" value="{{ $user->note }}"
                                        placeholder="Ghi chú cho đơn hàng"></textarea>
                                </div>
                            </div>
                            {{-- list thanh toán --}}
                            <div class="row mt-3">
                                <h4>Phương thức thanh toán</h4>
                                <div class="col-12">
                                    <div class="form-check ps-0 mb-3">
                                        <label for="payment_method_id1"
                                            class="label_input_tgnt d-flex justify-content-between align-items-center w-100 p-3 rounded border bg-light cursor-pointer transition-all position-relative payment-option-label">
                                            <div class="d-flex align-items-center gap-2">
                                                <img src="https://cdn-icons-png.flaticon.com/512/3692/3692056.png"
                                                    alt="Thanh toán khi nhận hàng" class="payment-icon">
                                                <span class="w-100 text-center">Thanh toán khi nhận hàng</span>
                                            </div>
                                            <input id="payment_method_id1" data-url="{{ route('client.checkout.store') }}"
                                                required type="radio" name="payment_method_id" value="1"
                                                class="form-check-input radio_input_tgnt" />
                                        </label>
                                    </div>
                                    <div class="form-check ps-0">
                                        <label for="payment_method_id2"
                                            class="label_input_tgnt d-flex justify-content-between align-items-center w-100 p-3 rounded border bg-light cursor-pointer transition-all position-relative payment-option-label">
                                            <div class="d-flex align-items-center gap-2">
                                                <img src="{{ asset('uploads/image/system/logo_vnpay.png') }}"
                                                    alt="Thanh toán bằng VN Pay" class="payment-icon">
                                                <span class="w-100 text-center">Thanh toán bằng VN Pay</span>
                                            </div>
                                            <input id="payment_method_id2"
                                                data-url="{{ route('client.checkout.vnpay.pay') }}" type="radio"
                                                name="payment_method_id" value="2"
                                                class="form-check-input radio_input_tgnt" />
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <style>
                                .payment-option-label {
                                    background-color: #f9f9f9;
                                    transition: background-color 0.3s ease, box-shadow 0.3s ease;
                                }

                                .payment-option-label:hover,
                                .payment-option-label:focus-within {
                                    background-color: #e0e0e0;
                                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                                }

                                .payment-option-label input[type="radio"]:checked+span {
                                    color: #007bff;
                                }

                                .payment-icon {
                                    width: 24px;
                                    height: 24px;
                                    object-fit: contain;
                                }

                                .form-check-input {
                                    width: 20px;
                                    height: 20px;
                                }

                                .radio_input_tgnt[tyle="radio"]:checked+.label_input_tgnt {
                                    background-color: #007bff;
                                    color: #fff;
                                }
                            </style>
                        </div>
                    </div>
                    <div class="main-right col-xxl-4 col-md-12 col-12 border rounded h-100">
                        @include('client.pages.cart.components.checkout.cartProduct', $products)
                        @auth
                            <div class="cart-discount d-flex my-5">
                                <input type="text" class="code-discount form-control w-75 rounded-pill"
                                    placeholder="Mã giảm giá" value="">
                                <button type="button" class="apply-discount btn btn-tgnt w-25 ms-2">Áp dụng</button>
                            </div>
                            <div class="list-discount">
                            </div>
                        @endauth
                        @guest
                            <div class="cart-login d-flex my-5">
                                <a href="{{ route('client.auth.login') }}" class="btn btn-tgnt w-100">Đăng nhập để áp dụng mã
                                    giảm
                                    giá</a>
                            </div>
                        @endguest
                        <div class="d-flex justify-content-between">
                            <p class="fs-6">Tiết kiệm:</p>
                            <p class="cart-total" id="cart-total"><span class="save-price-checkout" id="save-price-checkout"></span>₫</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p class="fs-6">Thành tiền:</p>
                            <p class="cart-total"><span id="cart-total-discount">{{ formatNumber($total) }}</span>₫</p>
                            <input type="hidden" id="cart-total-discount-input" name="total_amount"
                                value="{{ $total }}"></input>
                        </div>
                        <div class="cart-last-step d-flex my-4">
                            <a href="{{ route('client.cart.index') }}"
                                class="cart-back btn btn-outline-tgnt w-50 ms-2">Trở
                                lại
                                đơn hàng</a>
                            <div class="value-cart">
                            </div>
                            <button type="submit" class="checkout-cart btn btn-tgnt w-50 ms-2">Đặt hàng</button>
                            <div class="hidden">
                                <input type="hidden" name="discountCode" class="discount-code" value="">
                                <input type="hidden" name="total_amount" class="total-cart-input"
                                    value="{{ $total }}">
                                <input type="hidden" name="email" value="{{ $user->email }}">
                                <input type="hidden" name="status" value="pending">
                                <input type="hidden" name="payment_status" value="pending">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>


    <style>
        .cart-total {
            color: var(--base-color);
            font-weight: bold;
            font-size: clamp(13px, 1.2vw, 20px);
        }
    </style>
@endsection

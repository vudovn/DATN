@extends('admin.layout')

@section('template')
    <x-breadcrumb :breadcrumb="$config['breadcrumb']" />
    <div class="card">
        <div class="card-header">
            <h4>Tạo Đơn Hàng Mới</h4>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <div class="card-body">
            <form action="{{ route('order.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="form-group mb-3">
                            <h5>Tìm khách hàng theo số điện thoại</h5>
                            <div class="input-group">
                                <input type="number" class="form-control search-customer" placeholder="Nhập số điện thoại">
                                <button type="button" class="btn btn-primary btn-search-customer">Tìm</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group mb-3">
                            <x-input :label="'Tên khách hàng'" name="name" :value="old('name')" :required="true" />
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group mb-3">
                            <x-input :label="'Email'" name="email" :value="old('email')" :required="true" />
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group mb-3">
                            <x-input :label="'Số điện thoại'" name="phone" :value="old('phone')" :required="true" />
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group mb-3">
                            <label for="customer_note">Note:</label>
                            <input type="text" id="customer_note" name="note" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <!-- Phương Thức Thanh Toán -->
                        <div class="form-group mb-3">
                            <label for="payment_method" class="form-label">Phương Thức Thanh Toán:</label>
                            <input type="text" id="payment_method" name="payment_method" class="form-control">
                        </div>
                    </div>
                    <div class="col-6">
                        <!-- Trạng Thái -->
                        <div class="form-group">
                            <label for="status" class="form-label">Trạng Thái</label>
                            <select name="status" id="status" class="form-control js-choice-order">
                                @foreach (__('order.status') as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Trạng Thái Thanh Toán -->
                <div class="form-group mb-3">
                    <label for="payment_status" class="form-label required">Trạng Thái Thanh Toán:</label>
                    <select name="payment_status" id="payment_status" class="form-control">
                        @php
                            $paymentStatuses = __('order.payment_status');
                        @endphp

                        @if (is_array($paymentStatuses))
                            @foreach ($paymentStatuses as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        @else
                            <option value="">{{ $paymentStatuses }}</option>
                        @endif
                    </select>
                </div>

                <!-- Địa chỉ giao hàng -->
                @include('admin.pages.order.components.location')
                <div class="form-group mb-3">
                    <x-input :label="'Địa chỉ giao hàng'" name="address" :value="old('address')" :required="false" />
                </div>


                @include('admin.pages.order.components.add_product')

                <div class="card-footer">
                    <div class="text-end">
                        <a href="{{ route('order.index') }}" class="btn btn-danger">Quay lại</a>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- <script>
        $(document).ready(function() {
            new Choices('.js-choice-order');
            new Choices('.js-choice-province');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script> --}}

@endsection

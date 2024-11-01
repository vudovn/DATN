@extends('admin.layout')

@section('template')
<x-breadcrumb :breadcrumb="$config['breadcrumb']" />
    <div class="card">
        <div class="card-header">
            <h4>Chỉnh sửa Đơn Hàng #{{ $order->id }}</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('order.update', ['id' => $order->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-6">
                        <div class="form-group mb-3">
                            <label for="customer_name">Tên khách hàng:</label>
                            <input type="text" id="customer_name" name="name" class="form-control" value="{{ $order->name }}" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group mb-3">
                            <label for="customer_email">Email:</label>
                            <input type="text" id="customer_email" name="email" class="form-control" value="{{ $order->email }}" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group mb-3">
                            <label for="customer_phone">Phone:</label>
                            <input type="text" id="customer_phone" name="phone" class="form-control" value="{{ $order->phone }}" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group mb-3">
                            <label for="customer_note">Note:</label>
                            <input type="text" id="customer_note" name="note" class="form-control" value="{{ $order->note }}" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <!-- Phương Thức Thanh Toán -->
                        <div class="form-group mb-3">
                            <label for="payment_method">Phương Thức Thanh Toán:</label>
                            <input type="text" id="payment_method" name="payment_method" class="form-control" value="{{ $order->payment_method ?? 'Đợi có dữ liệu bảng phương thức thanh toán' }}">
                        </div>
                    </div>
                    <div class="col-6">
                        <!-- Trạng Thái -->
                        <div class="form-group">
                            <label for="status" class="form-label">Trạng Thái</label>
                            <select name="status" id="status" class="form-control js-choice-order">
                                @foreach (__('order.status') as $key => $value)
                                    <option value="{{ $key }}" {{ $order->status == $key ? 'selected' : '' }}>
                                        {{ $value }}
                                    </option>
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
                    <x-input :label="'Địa chỉ chi tiết'" name="address" :value="$user->address ?? ''" :required="false" />
                </div>
        
                {{-- Thêm sản phẩm --}}

                <div class="filterProduct">
                    <div class="card-header">
                        <div class="alert alert-success" role="alert">
                            Bạn phải thêm sản phẩm mới!
                            <span style="cursor: pointer" onclick="toggleProductInput()" class="me-3 link-success add-product">
                                Thêm sản phẩm
                            </span>
                        </div>
                        <input type="hidden" name="idProduct" id="idProduct">

                        <div class="card-body show-product d-none" id="productInputContainer">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" class="form-control mt-3" id="product-search" placeholder="Nhập tên sản phẩm">
                                </div>
                                <div class="col-md-6">
                                    <select class="form-control mt-3" id="product-variant">
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="product-dropdown d-none" id="product-dropdown">
                                <!-- Danh sách sản phẩm sẽ được thêm động ở đây -->
                            </div>
                        </div>
                    </div>
                </div>

<script>
    function toggleProductInput() {
        const productInput = document.getElementById('productInputContainer');
        productInput.classList.toggle('d-none');
    }
</script>

                @php
                    $totalAmount = 0;
                @endphp
                <h5 class="mt-4">Chi tiết Đơn Hàng</h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên Sản Phẩm</th>
                            <th>Số Lượng</th>
                            <th>Giá Tiền</th>
                            <th>Tổng Tiền</th>
                            <th>Ngày Tạo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order_details as $detail)
                            @php
                                $lineTotal = $detail->product->price * $detail->quantity; 
                                $totalAmount += $lineTotal;
                            @endphp
                            <tr>
                                <td>{{ $detail->id }}</td>
                                <td>{{ $detail->product->name }}</td>
                                <td>
                                    <input type="number" name="quantity[{{ $detail->id }}]" class="form-control" value="{{ $detail->quantity }}" min="1">
                                </td>
                                <td>{{ number_format($detail->product->price) }} VND</td>
                                <td>{{ number_format($lineTotal) }} VND</td>
                                <td>{{ changeDateFormat($detail->created_at) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Hiển thị tổng tiền -->
                <div class="form-group mb-3">
                    <label for="total_amount">Tổng tiền:</label>
                    <input type="number" id="total_amount" name="total_amount" class="form-control"  value="{{$totalAmount }}">
                </div>
        
                <div class="text-right">
                    <a href="{{ route('order.index') }}" class="btn btn-danger">Quay lại</a>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </div>
            </form>
        </div>
        
    </div>
    <script>
        $(document).ready(function() {
            new Choices('.js-choice-order');
        });
    </script>

    <script>
        function updateTotal() {
            let totalAmount = 0;
            const rows = document.querySelectorAll('tbody tr'); 

            rows.forEach(row => {
                const quantityInput = row.querySelector('input[type="number"]');
                const priceCell = row.cells[3].innerText.replace(' VND', '').replace('.', '');
                const quantity = parseInt(quantityInput.value);
                const lineTotal = priceCell * quantity;
                totalAmount += lineTotal;

                row.cells[4].innerText = new Intl.NumberFormat().format(lineTotal) + ' VND';
            });

            document.getElementById('total_amount').value = new Intl.NumberFormat().format(totalAmount) + ' VND';
        }
        
        document.querySelectorAll('input[type="number"]').forEach(input => {
            input.addEventListener('input', updateTotal);
        });
    </script>

@endsection

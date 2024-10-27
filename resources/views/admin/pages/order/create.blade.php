@extends('admin.layout')

@section('template')
    <x-breadcrumb :breadcrumb="$config['breadcrumb']" />
    <div class="card">
        <div class="card-header">
            <h4>Tạo Đơn Hàng Mới</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('order.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="form-group mb-3">
                            <label for="customer_name">Tên khách hàng:</label>
                            <input type="text" id="customer_name" name="name" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group mb-3">
                            <label for="customer_email">Email:</label>
                            <input type="text" id="customer_email" name="email" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group mb-3">
                            <label for="customer_phone">Phone:</label>
                            <input type="text" id="customer_phone" name="phone" class="form-control" required>
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
                            <label for="payment_method">Phương Thức Thanh Toán:</label>
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
                    <label for="payment_status">Trạng Thái Thanh Toán:</label>
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
                    <x-input :label="'Địa chỉ giao hàng'" name="address" :value="''" :required="false" />
                </div>

                {{-- Thêm sản phẩm --}}
                <div class="filterProduct">
                    <div class="card-header">
                        <div class="alert alert-success" role="alert">
                            Bạn phải thêm sản phẩm mới!
                            <span style="cursor: pointer" onclick="toggleProductInput()"
                                class="me-3 link-success add-product">
                                Thêm sản phẩm
                            </span>
                        </div>
                        <input type="hidden" name="idProduct" id="idProduct">
                        <div class="card-body show-product d-none" id="productInputContainer">
                            <input type="text" class="form-control mt-3" id="product-search" placeholder="Nhập tên sản phẩm cần thêm">
                            <div class="product-dropdown d-none" id="product-dropdown">
                                <!-- Kết quả tìm kiếm sẽ hiển thị ở đây -->
                            </div>
                        </div>
                        <!-- jQuery -->
                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                        {{-- <script>
                            $(document).ready(function(){
                                let productsData = []; // Lưu trữ sản phẩm được lấy từ API
                                
                                $('#product-search').on('input', function(){
                                    let query = $(this).val();
                                    if(query.length > 0){
                                        $.ajax({
                                            url: "{{ route('order.dataProduct') }}",
                                            method: 'GET',
                                            dataType: 'json',
                                            success: function(data){
                                                productsData = data;
                                                let filteredProducts = data.filter(product => 
                                                    product.name.toLowerCase().includes(query.toLowerCase())
                                                );
                
                                                let dropdown = $('#product-dropdown');
                                                dropdown.empty(); 
                                                if (filteredProducts.length > 0) {
                                                    filteredProducts.forEach(product => {
                                                        dropdown.append(`<div class="product-dropdown-item" data-id="${product.id}" data-name="${product.name}" data-price="${product.price}">${product.name}</div>`);
                                                    });
                                                    dropdown.removeClass('d-none');
                                                } else {
                                                    dropdown.addClass('d-none');
                                                }
                                            },
                                            error: function(){
                                                alert('Không thể tải dữ liệu sản phẩm!');
                                            }
                                        });
                                    } else {
                                        $('#product-dropdown').addClass('d-none');
                                    }
                                });
                
                                // Xử lý khi chọn sản phẩm từ danh sách thả xuống
                                $(document).on('click', '.product-dropdown-item', function(){
                                    let productId = $(this).data('id');
                                    let productName = $(this).data('name');
                                    let productPrice = $(this).data('price');
                                    let quantity = 1; // Mặc định số lượng là 1, có thể điều chỉnh
                
                                    // Tính tổng tiền
                                    let totalPrice = quantity * productPrice;
                
                                    // Thêm sản phẩm vào bảng
                                    $('#product-table-body').append(`
                                        <tr>
                                            <td>${productId}</td>
                                            <td>${productName}</td>
                                            <td class='fix-input'><input type="number" value="${quantity}" class="product-quantity" data-price="${productPrice}" style="width: 60px;"></td>
                                            <td>${productPrice} VNĐ</td>
                                            <td class="total-price">${totalPrice} VNĐ</td>
                                        </tr>
                                    `);
                
                                    // Ẩn dropdown và xóa từ khóa tìm kiếm
                                    $('#product-search').val('');
                                    $('#product-dropdown').addClass('d-none');
                                });
                
                                // Cập nhật tổng tiền khi thay đổi số lượng sản phẩm
                                $(document).on('input', '.product-quantity', function(){
                                    let quantity = $(this).val();
                                    let price = $(this).data('price');
                                    let totalPrice = quantity * price;
                                    $(this).closest('tr').find('.total-price').text(totalPrice + ' VNĐ');
                                });
                            });
                        </script> --}}
                    </div>
                </div>
                <script>
                    function toggleProductInput() {
                        const productInput = document.getElementById('productInputContainer');
                        productInput.classList.toggle('d-none');
                    }
                </script>
                


                <h5 class="mt-4">Chi tiết Đơn Hàng</h5>
                <table class="table table-striped mt-3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên Sản Phẩm</th>
                            <th>Số Lượng</th>
                            <th>Giá Tiền</th>
                            <th>Tổng Tiền</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody id="product-table-body">
                        <!-- Dữ liệu sản phẩm sẽ được thêm vào đây -->
                    </tbody>
                </table>

                <!-- Hiển thị tổng tiền -->
                <div class="form-group mb-3">
                    <label for="total_amount">Tổng tiền:</label>
                    <input type="text" id="total_amount" name="total_amount" class="form-control" value="0 VND">
                </div>

                <div class="text-right">
                    <a href="{{ route('order.index') }}" class="btn btn-danger">Quay lại</a>
                    <button type="submit" class="btn btn-primary">Tạo mới</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            new Choices('.js-choice-order');
            new Choices('.js-choice-province');
        });
    </script>
@endsection

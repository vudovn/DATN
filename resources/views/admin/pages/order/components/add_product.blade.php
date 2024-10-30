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
                    <select class="form-control mt-3" id="product-variant" placeholder="Chọn biến thể">
                    </select>
                </div>
            </div>
            <div class="product-dropdown d-none" id="product-dropdown">
            </div>
        </div>
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </div>
</div>
<script>
    function toggleProductInput() {
        const productInput = document.getElementById('productInputContainer');
        productInput.classList.toggle('d-none');
    }

    $(document).ready(function() {
        let selectedProductName = '';

        $('#product-search').on('input', function() {
            let productName = $(this).val();
            selectedProductName = productName;

            if (productName) {
                $.ajax({
                    url: '',
                    method: 'GET',
                    data: { productName },
                    success: function(data) {
                        $('#product-variant').empty();
                        data.variants.forEach(variant => {
                            $('#product-variant').append(
                                `<option value="${variant.id}">${variant.length} - ${variant.material}</option>`
                            );
                        });
                    }
                });
            }
        });

        // Bắt sự kiện khi chọn biến thể
        $('#product-variant').on('change', function() {
            const selectedVariant = $('#product-variant option:selected').text();
            let _this = $(this);
            console.log(_this.val());
            
            // if (selectedProductName && selectedVariant) {
            //     const row = `
            //         <tr>
            //             <td>1</td>
            //             <td>${selectedProductName} - ${selectedVariant}</td>
            //             <td>1</td>
            //             <td>100,000</td>
            //             <td>100,000</td>
            //             <td><button class="btn btn-danger btn-sm">Xóa</button></td>
            //         </tr>
            //     `;
            //     $('#product-table-body').append(row);
            // }
        });
    });
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
        
    </tbody>
</table>

<!-- Hiển thị tổng tiền -->
<div class="form-group mb-3">
    <label for="total_amount">Tổng tiền:</label>
    <input type="text" id="total_amount" name="total_amount" class="form-control" value="0 VND">
</div>

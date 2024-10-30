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
                        <option value="">Chọn biến thể</option>
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

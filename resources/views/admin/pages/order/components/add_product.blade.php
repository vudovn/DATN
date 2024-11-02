<div class="filterProduct">
    <div class="card-header">
        Thêm sản phẩm
    </div>
    <div class="card-body" id="productInputContainer">
        <div class="form-group show-product" style="position: relative">
            <input type="text" class="form-control" id="product-search" placeholder="Nhập tên sản phẩm..">
            <div class="product-dropdown d-none" id="product-dropdown">
                <!-- Danh sách sản phẩm sẽ được thêm động bằng js ở đây -->
            </div>
        </div>
        <div class="form-group mt-3 select_variant">
            {{-- nếu sản phẩm có biến thể thì nó sẽ render ra select chọn sản phẩm --}}
        </div>


        <h5 class="mt-4">Chi tiết Đơn Hàng</h5>
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>Hình ảnh</th>
                    <th>SKU</th>
                    <th>Tên Sản Phẩm</th>
                    <th>Số Lượng</th>
                    <th>Giá Tiền</th>
                    <th>Tổng Tiền</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody id="product-table-body" class="product-variant">
                <!-- Dữ liệu sản phẩm sẽ được thêm vào đây -->
            </tbody>
        </table>

        <div class="form-group mb-3">
            <label for="total_amount">Tổng tiền: <strong class="total_amount" id="preview_totle">0</strong></label>
            <input type="hidden" id="total_amount" name="total_amount" class="form-control" value="0">
        </div>

    </div>
</div>
</div>

<script>
    let id = {!! json_encode(old('product_id', [])) !!};
    let sku = {!! json_encode(old('sku', [])) !!};
    let name = {!! json_encode(old('name_orderDetail', [])) !!};
    let price = {!! json_encode(old('price', [])) !!};
    let quantity = {!! json_encode(old('quantity', [])) !!};
    let total = {!! json_encode(old('total', [])) !!};
    let thumbnail = {!! json_encode(old('thumbnail', [])) !!};

    let productVariants = [];
    for (let i = 0; i < id.length; i++) {
        productVariants.push({
            id: id[i],
            sku: sku[i],
            name: name[i],
            price: price[i],
            thumbnail: thumbnail[i],
            quantity: 1,
        });
    }
</script>

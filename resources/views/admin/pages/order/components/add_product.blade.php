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
                @if (isset($order_details))
                @foreach ($order_details as $detail)
                {{-- @dd($detail->product) --}}
                <tr data-id="{{ $detail->product->id }}">
                    <td>
                        <a href="{{$detail->product->thumbnail}}" data-fancybox="gallery">
                            <img src="{{$detail->product->thumbnail}}" alt="{{$detail->name}}" class="product-thumbnail">
                        </a>
                    </td>
                    <td>{{ $detail->sku }}</td>
                    <td>{{ $detail->product->name }}</td>
                    <td class='fix-input'>
                        <input type="number" value="{{$detail->quantity}}" class="product-quantity form-control" data-price="{{$detail->price}}" min="1" max="5" style="width: 60px;">
                    </td>
                    <td>{{ formatNumber($detail->price) }}</td>
                    <td class="total-price">{{ formatNumber($detail->price * $detail->quantity) }}</td>
                    <td><button type="button" class="btn btn-danger btn-sm rounded delete-product-btn">Xóa</button></td>
                    <td class="hidden">
                        <input type="text" name="product_id[]" value="{{$detail->product->id}}">
                        <input type="text" class="product_quantity_input" name="quantity[]" value="{{$detail->quantity}}">
                        <input type="text"  name="price[]" value="{{$detail->price}}">
                        <input type="text" name="name_orderDetail[]" value="{{$detail->name}}">
                        <input type="text" name="sku[]" value="{{ $detail->sku }}">
                        <input type="text" name="thumbnail[]" value="{{$detail->product->thumbnail}}">
                        <input type="text" name="total[]" value="{{$detail->price * $detail->quantity}}">
                    </td>
                </tr>
            @endforeach
                @endif
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
            quantity: quantity[i],
        });
    }
</script>

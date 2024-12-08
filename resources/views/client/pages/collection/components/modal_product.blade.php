<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sản phẩm hiện có trong bộ sưu tập</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="cart">
                    <div class="main-left">
                        <div class="cart-container">
                            @foreach ($products as $product)
                                <div class="cart-item">
                                    <img alt="Black and white striped ceramic plate" height="100"
                                        src="{{ $product->thumbnail }}" width="100" />
                                    <div class="cart-item-details">
                                        <div class="cart-item-title">
                                            {{ $product->name }}
                                        </div>
                                        {{-- <div class="cart-item-subtitle">
                                            {{ $product->name }}
                                        </div> --}}
                                        <div class="d-xxl-flex">
                                            <div class="cart-item-price">
                                                {{ formatNumber($product->price) }}
                                            </div>
                                            <div class="cart-item-old-price m-xxl-2 m-md-0">
                                                {{ formatNumber($product->price) }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cart-item-subtitle">
                                        @if (isset($product->title))
                                            <button class="open-box-variant text-muted btn btn-link p-0">
                                                Phân loại hàng: <br>{{ $product->title }}
                                            </button>
                                        @endif
                                    </div>
                                    {{-- <div class="pe-xxl-5">
                                        <div class="cart-item-total text-center">
                                            {{ formatNumber($product->price) }}
                                        </div>
                                        <div class="input-group input-spinner d-flex">
                                            <input type="button" value="-" class="button-minus btn btn-sm"
                                                data-field="quantity">
                                            <input type="number" step="1" max="3" value="1"
                                                name="quantity[]" class="quantity-field form-control-sm form-input">
                                            <input type="button" value="+" class="button-plus btn btn-sm"
                                                data-field="quantity">
                                        </div>
                                    </div> --}}
                                    <div class="cart-item-remove">
                                        <button type="button" data-sku="{{ $product->sku }}"
                                            class="removeItem btn btn-link p-0 text-danger" id="removeItem"
                                            style="text-decoration: none;" href="">x</button>
                                    </div>
                                </div>
                                <div class="hidden">
                                    <input type="text" name="product_id[]" value="{{ $product->id }}">
                                    <input type="text" name="sku[]" value="{{ $product->sku }}">
                                    <input type="text" name="name[]" value="{{ $product->name }}">
                                    <input type="text" name="price[]" value="{{ $product->price }}">
                                    <input type="text" name="inventory[]" value="{{ $product->quantity }}">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-tgnt" data-bs-dismiss="modal">Huỷ</button>
                <button type="button" class="btn btn-tgnt addMultiToCart" data-bs-dismiss="modal">Thêm vào giỏ hàng</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
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
                                        <div class="cart-item-subtitle">
                                            {{ $product->name }}
                                        </div>
                                        <div class="d-xxl-flex">
                                            <div class="cart-item-price">
                                                {{ formatNumber($product->price) }}
                                            </div>
                                            <div class="cart-item-old-price m-xxl-2 m-md-0">
                                                {{ formatNumber($product->price) }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pe-xxl-5">
                                        <div class="cart-item-total text-center">
                                            {{ formatNumber($product->price) }}
                                        </div>
                                        <div class="input-group input-spinner d-flex">
                                            <input type="button" value="-" class="button-minus btn btn-sm"
                                                data-field="quantity">
                                            <input type="number" step="1" max="3" value="1"
                                                name="quantity" class="quantity-field form-control-sm form-input">
                                            <input type="button" value="+" class="button-plus btn btn-sm"
                                                data-field="quantity">
                                        </div>
                                    </div>
                                    <div class="cart-item-remove">
                                        <a href="">x</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
                <button type="button" class="btn btn-primary">Thêm vào giỏ hàng</button>
            </div>
        </div>
    </div>
</div>

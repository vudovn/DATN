    <h5 class="mt-4">Đơn hàng của bạn</h5>
    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>Hình ảnh</th>
                <th>Sản Phẩm</th>
            </tr>
        </thead>
        <tbody id="product-table-body" class="product-variant">
            @if (isset($products))
                @foreach ($products as $product)
                    {{-- @dd($detail->product) --}}
                    <tr data-id="">
                        <td>
                            <a href="{{ $product->thumbnail }}" class="product-thumbnail " data-fancybox="gallery">
                                <img src="{{ $product->thumbnail }}" alt="{{ $product->name }}"width="50">
                            </a>
                        </td>
                        <td class="position-relative">
                            {{ $product->name }}
                            <span class="quantity btn btn-tgnt">{{ formatNumber($product->quantityCart) }}</span>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    <p class="cart-total">Tổng tiền: <span id="cart-total">{{ formatNumber($total) }}</span>đ</p>
    <input type="hidden" id="cart-total-input" value="{{ $total }}"></input>
    
    <style>
        th,
        td {
            text-align: center;
            padding: 10px 0 !important;
            ;
        }

        .quantity {
            position: absolute;
            top: 0%;
            right: 0%;
            transform: translate(-0%, -50%);
        }
    </style>

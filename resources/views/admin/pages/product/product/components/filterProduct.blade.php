@if (isset($products) && count($products))
    <div class="row mt-3 animate__animated animate__fadeIn">
        @foreach ($products as $key => $product)
            <div class="col-md-2 p-1 product-main">
                <label 
                for="{{ $product->has_attribute == 1 ? 'disabled' : 'checkInput' . $product->sku }}" 
                style="cursor: pointer;">
                    <input type="checkbox" id="checkInput{{ $product->sku }}" class="checkInput hidden"
                        data-id="{{ $product->id }}" data-sku="{{ $product->sku }}">
                    <div class="card" id="product-item{{ $product->sku }}" >
                        <img class="img card-img-top p-1" height="100" src="{{ $product->thumbnail }}"
                            alt="Card image cap">
                        <div class="card-body p-2">
                            <span class="card-title text-limit text-primary"
                                style="font-size: 12px">{{ $product->name }}</span>
                            <p class="card-text" style="font-size: 10px">{{ number_format($product->price) }} đ</p>
                            {{-- <p class="card-text" style="font-size: 10px">{{ $product->publish }}</p> --}}
                        </div>
                    </div>
                </label>
                <div class="product-focus row">
                    <div class="d-flex">
                        @foreach ($product->productVariants as $variant)
                            <div class="col-4">
                                <label for="checkInput{{ $variant->sku }}" style="cursor: pointer;">
                                    <input type="checkbox" id="checkInput{{ $variant->sku }}" class="checkInput hidden"
                                        data-variantid="{{ $variant->id }}" data-id="{{ $product->id }}"
                                        data-sku="{{ $variant->sku }}">
                                    <div class="card" id="product-item{{ $variant->sku }}">
                                        <img class="img card-img-top p-1" height="100"
                                            src="{{ $variant->thumbnail }}" alt="Card image cap">
                                        <div class="card-body p-2">
                                            <span class="card-title text-limit text-primary"
                                                style="font-size: 12px">({{ $variant->title }}) /
                                                {{ $product->name }}</span>
                                            <p class="card-text" style="font-size: 10px">
                                                {{ number_format($variant->price) }} đ</p>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
        {!! $products->links('pagination::bootstrap-4') !!}
    </div>
@else
    <tr>
        <td colspan="100" class="text-center">Không có dữ liệu</td>
    </tr>
@endif



<style>
    .text-limit {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .card {
        transition: background-color 0.3s ease;
    }

    .product-main {
        z-index: 1;
        position: relative;
    }

    .product-main:hover .product-focus {
        display: block;
        z-index: 20;
    }

    .product-focus {
        display: flex;
        align-items: center;
        border-radius: 10px;
        text-align: center;
        background-color: #ececec;
        width: 300%;
        top: -90%;
        left: -85%;
        transform: translateX(-50%, -50%);
        position: absolute;
        display: none;
    }
</style>


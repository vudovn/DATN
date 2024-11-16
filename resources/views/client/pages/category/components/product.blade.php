<div class="row animate__animated animate__fadeIn listProduct mb-4">
    @if ($products->count() > 0)
        @foreach ($products as $item)
            <div class="product_item col-md-6 col-lg-4 col-xl-3 text-center position-relative">
                <a href="{{ route('client.product.detail', $item->slug) }}" class="item ">
                    <img src="{{ $item->thumbnail }}" alt="">
                    <h2 style="">{{ $item->name }}</h2>
                    <div class="price text-tgnt">{{ formatMoney($item->price) }}</div>
                </a>
                <label for="like{{ $item->id }}" style="cursor: pointer" title="Thêm sản phẩm vào mục yêu thích"
                    class="animate__animated animate__bounceIn like_action con-like position-absolute top-0 end-0 mt-4 me-8">
                    <input class="like" id="like{{ $item->id }}" data-id="{{ $item->id }}" type="checkbox">
                    <div class="checkmark">
                        <svg xmlns="http://www.w3.org/2000/svg" class="outline" viewBox="0 0 24 24">
                            <path
                                d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Zm-3.585,18.4a2.973,2.973,0,0,1-3.83,0C4.947,16.006,2,11.87,2,8.967a4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,11,8.967a1,1,0,0,0,2,0,4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,22,8.967C22,11.87,19.053,16.006,13.915,20.313Z">
                            </path>
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="filled" viewBox="0 0 24 24">
                            <path
                                d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Z">
                            </path>
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" height="100" width="100" class="celebrate">
                            <polygon class="poly" points="10,10 20,20"></polygon>
                            <polygon class="poly" points="10,50 20,50"></polygon>
                            <polygon class="poly" points="20,80 30,70"></polygon>
                            <polygon class="poly" points="90,10 80,20"></polygon>
                            <polygon class="poly" points="90,50 80,50"></polygon>
                            <polygon class="poly" points="80,80 70,70"></polygon>
                        </svg>
                    </div>
                </label>
            </div>
        @endforeach
    @else
        <div class="col-12">
            <div class="text-center">
                Không có sản phẩm nào!
            </div>
        </div>
    @endif
</div>
<div class="pagination_tgnt d-flex justify-content-center">
    {!! $products->links('pagination::bootstrap-4') !!}
</div>

<style>
    .listProduct .item img {
        width: 100%;
        filter: drop-shadow(0 50px 20px #0009);
    }

    .like_action {
        display: none;
    }

    .product_item:hover .like_action {
        display: block;
    }

    .listProduct .item {
        background-color: #EEEEE6;
        padding: 20px;
        border-radius: 20px;
    }

    .listProduct .item h2 {
        font-weight: 500;
        font-size: large;
    }

    .listProduct .item .price {
        letter-spacing: 4px;
        font-size: small;
    }
</style>

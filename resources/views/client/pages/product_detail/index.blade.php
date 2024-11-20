@extends('client.layout')

@section('content')
    <!-- abc -->
    @php
        $name = $product->name;
        $price = $product->price;
        $discount = $product->discount;
        $priceDiscount = $price - ($price * $discount) / 100;
        $albums = json_decode($product->albums);
        $description = $product->description;
        $category = $product->categories;
        $attributeCategory = $product->attribute_category;
        $shortContent = $product->short_content;
    @endphp

    <section class="product_ct container animate__animated animate__fadeIn">
        <div class="col-xxl-12 d-none d-xxl-block">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('client.home') }}" class="text-stnt">Trang chủ</a>
                    </li>
                    <li class="breadcrumb-item"><a href="product.html" class="text-stnt">Sản phẩm</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $name }}</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-xxl-6 col-sm-12 mb-5 gallery-container">
                <div class="fotorama" data-nav="thumbs" data-width="100%" data-ratio="900/600" data-allowfullscreen="true">
                    @if ($albums)
                        @foreach ($albums as $album)
                            <img class="img-preview-tgnt" src="{{ $album }}" alt="{{ $product->name }}">
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="col-xxl-6 col-sm-12 mb-5">
                <div class="title_spct mb-7">
                    <h2 class="product-title">{{ $name }}
                    </h2>
                    <span class="badge bg-light-warning text-dark-warning"> Giảm {{ $product->discount }} %</span>
                </div>
                <div class="price_spct product-price d-flex">
                    @if ($discount > 0)
                        <span
                            class="price_base_spct text-danger price">{{ formatMoney($price - ($price * $discount) / 100) }}</span>
                        <strike class="price_discount_spct ms-3 price">{{ formatMoney($price) }}</strike>
                    @else
                        <span class="price_base_spct text-danger price">{{ formatMoney($price) }}</span>
                    @endif
                </div>
                {{-- Mô tả ngắn --}}
                <div class="short_content">
                    <p>{{ $shortContent }}</p>
                </div>
                <!-- info sản phẩm -->
                <div class="info_spct mt-5">
                    @include('client.pages.product_detail.components.variant')
                    <div class="mb-xxl-7 mb-2">
                        <strong>Danh mục: </strong>
                        @foreach ($category as $item)
                            <a href="{{ $item->slug }}" class="cate_ctsp">
                                <span class="badge bg-light text-dark product_ct_badge">
                                    {{ $item->name }}
                                </span>
                            </a>
                        @endforeach
                    </div>
                </div>
                <!-- end info sản phẩm -->

                <!-- action sản phẩm -->
                <div class="action_spct d-xxl-flex align-items-center gap-5">
                    <div class="quantity_spct mb-xxl-0 mb-3">
                        <div class="input-group input-spinner">
                            <input type="button" value="-" class="button-minus btn btn-sm" data-field="quantity">
                            <input type="number" step="1" max="3" value="1" name="quantity"
                                id="quantity" class="quantity-field form-control-sm form-input">
                            <input type="button" value="+" class="button-plus btn btn-sm" data-field="quantity">
                        </div>
                    </div>
                    <div class="btn_spct">
                        <button class="btn btn-stnt buyNow" data-id="{{ $product->id }}">Mua ngay</button>
                        <button class="btn btn-outline-stnt ms-4 addToCart">Thêm vào giỏ hàng</button>
                        <button class="btn btn-link p-0 ms-3">
                            <label for="like{{ $product->id }}" style="cursor: pointer"
                                title="Thêm sản phẩm vào mục yêu thích"
                                class="animate__animated animate__bounceIn like_action con-like">
                                <input
                                    {{ auth()->check() &&auth()->user()->wishlists->contains('product_id', $product->id)? 'checked': '' }}
                                    class="like action_wishlist" id="like{{ $product->id }}"
                                    data-id="{{ $product->id }}" type="checkbox" value="{{ $product->id }}">
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
                        </button>
                        <div class="hidden">
                            <input type="hidden" name="price" id="price" value="{{ $priceDiscount }}">
                        </div>

                        {{-- <input
                            {{ auth()->check() &&auth()->user()->wishlists->contains('product_id', $product->id)? 'checked': '' }}
                            type="checkbox" name="add_wishlist" class="add_wishlist" value="{{ $product->id }}"> --}}
                    </div>
                    <!-- end action sản phẩm -->
                </div>

            </div>
            <div class="col-xxl-12 col-sm-12 mb-5">
                <!-- policy sản phẩm -->
                <div class="mb-10 mt-5">
                    <!--  -->
                    <ul class="nav nav-line-bottom mb-3 justify-content-center" id="pills-tab-javascript-behavior-pills"
                        role="tablist">
                        <!-- mô tả sản phẩm -->
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active fs-xxl-5  fw-bold pb-2" id="pills-description-tab"
                                data-bs-toggle="pill" href="#pills-description" role="tab"
                                aria-controls="pills-description" aria-selected="true">
                                Mô tả
                            </a>
                        </li>
                        <!-- bảo hành -->
                        <li class="nav-item" role="presentation">
                            <a class="nav-link fs-xxl-5 fw-bold pb-2" id="pills-policy-tab" data-bs-toggle="pill"
                                href="#pills-policy" role="tab" aria-controls="pills-policy" aria-selected="false">
                                Chính sách
                            </a>
                        </li>
                        <!-- vận chuyển -->
                        <li class="nav-item" role="presentation">
                            <a class="nav-link fs-xxl-5 fw-bold pb-2" id="pills-comment-tab" data-bs-toggle="pill"
                                href="#pills-comment" role="tab" aria-controls="pills-comment"
                                aria-selected="false">
                                Bình luận
                            </a>
                        </li>
                        <!-- đánh giá -->
                        <li class="nav-item" role="presentation">
                            <a class="nav-link fs-xxl-5 fw-bold pb-2" id="pills-rate-tab" data-bs-toggle="pill"
                                href="#pills-rate" role="tab" aria-controls="pills-rate" aria-selected="false">
                                Đánh giá
                            </a>
                        </li>
                    </ul>
                    <!-- Tab content -->
                    <div class="tab-content" id="pills-tabContent-javascript-behavior-pills">
                        @include('client.pages.product_detail.components.tab.tab_description')
                        @include('client.pages.product_detail.components.tab.tab_policy')
                        @include('client.pages.product_detail.components.tab.tab_rate')
                        @include('client.pages.product_detail.components.tab.tab_comment')
                    </div>
                </div>
                <!-- end policy sản phẩm -->
            </div>
        </div>

    </section>
    <!-- end -->
@endsection

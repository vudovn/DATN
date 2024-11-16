@extends('client.layout')

@section('content')
    <!-- abc -->
    @php
        $name = $product->name;
        $price = $product->price;
        $discount = $product->discount;
        $albums = json_decode($product->albums);
        $description = $product->description;
        $category = $product->categories;
        $attributeCategory = $product->attribute_category;
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
            {{-- <div class="col-xxl-6 col-sm-12 mb-5 gallery-container">
                <div class="row ">
                    <div class="col-md-12 text-center overflow-hidden rounded">
                        <div class="bg-secondary overflow-hidden rounded">
                            @if ($albums)
                                <a href="{{ $albums[0] }}" class="img_preview" data-fancybox="gallery">
                                    <img id="mainImage" src="{{ $albums[0] }}" class="product-image img-fluid rounded"
                                        alt="Main Product Image">
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12 text-center thumbnail-images">
                        <!-- Thumbnail images -->
                        @if ($albums)
                            @foreach ($albums as $key => $album)
                                <img src="{{ $album }}" alt="{{ $product->name }}"
                                    class="img-thumbnail {{ $key == 0 ? 'active' : '' }}" data-image="{{ $album }}"
                                    alt="{{ $product->name }}">
                            @endforeach
                        @endif
                    </div>
                </div>
            </div> --}}
            <div class="col-xxl-7 col-sm-12 mb-5 gallery-container">
                <div class="fotorama" data-nav="thumbs" data-width="100%" data-ratio="900/600" data-allowfullscreen="true">
                    @if ($albums)
                        @foreach ($albums as $album)
                            <img class="img-preview-tgnt" src="{{ $album }}" alt="{{ $product->name }}">
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="col-xxl-5 col-sm-12 mb-5">
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

                <!-- info sản phẩm -->
                <div class="info_spct mt-7">
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
                                class="quantity-field form-control-sm form-input">
                            <input type="button" value="+" class="button-plus btn btn-sm" data-field="quantity">
                        </div>
                    </div>
                    <div class="btn_spct ">
                        <button class="btn btn-stnt">Mua ngay</button>
                        <button class="btn btn-outline-stnt ms-4">Thêm vào giỏ hàng</button>
                        <input 
                            {{ auth()->check() && auth()->user()->wishlists->contains('product_id', $product->id) ? 'checked' : '' }} 
                            type="checkbox" 
                            name="product_id" 
                            class="add_wishlist" 
                            data-type="{{ auth()->check() && auth()->user()->wishlists->contains('product_id', $product->id) ? 'remove' : 'add' }}" 
                            value="{{ $product->id }}">
                    </div>
                </div>
                <!-- end action sản phẩm -->
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
                                href="#pills-comment" role="tab" aria-controls="pills-comment" aria-selected="false">
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

@extends('client.layout')
@section('seo')
    @include('client.components.seo')
@endsection
@section('content')
    <main>
        <section class="container collection_tgnt">
            <div class="d-none d-xxl-block mp-5">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('client.home')}}" class="text-stnt">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{route('client.collection.index')}}" class="text-stnt">Bộ sưu tập</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $collection->name }}</li>
                    </ol>
                </nav>
            </div>
            <div class="container detail">
                <div class="banner mb-3">
                    <img class="banner-image" src="{{ $collection->thumbnail }}" alt="">
                    <p class="banner-caption">{{ $collection->name }}</p>
                    <p class="banner-description">{{ $collection->short_description }}</p>
                </div>
                <div class="content">
                    {!! $collection->description_text !!}
                </div>
                <div class="product-of-collection">
                    <p class="title">Sản phẩm thuộc bộ sưu tập</p>
                    {!! $collection->description !!}
                    {{-- <div class="row">
                        @foreach ($products as $product)
                            <div class="col-md-4 col-lg-3 col-xl-3 col-6 d-flex justify-content-center">
                                <div class="card custom-card border-0">
                                    <a href="{{ route('client.product.detail', $product->slug) }}">
                                        <div class="position-relative" style="background-color: #EBEBEB;">
                                            <img src="{{ $product->thumbnail }}" class="card-img-top" alt="...">
                                            <i class="bi bi-heart position-absolute top-0 end-0 mt-2 me-2"
                                                style="cursor: pointer;"></i>
                                        </div>
                                    </a>
                                    <div class="card-body position-relative">
                                        <a href="{{ route('client.product.detail', $product->slug) }}"
                                            class="card-text fw-bold">
                                            {{ $product->name }}
                                        </a>
                                        <p class="card-text">{{ formatNumber($product->price) }} đ</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div> --}}
                    <div class="text-center my-3">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-tgnt" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            Thêm bộ sưu tập vào giỏ hàng
                        </button>
                    </div>
                    @include('client.pages.collection.components.modal_product')
                </div>
            </div>
        </section>
        
    </main>
@endsection

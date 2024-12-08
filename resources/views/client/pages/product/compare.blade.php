@extends('client.layout')

@section('content')
    <section class="container">
        <div class="d-none d-xxl-block mp-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('client.home') }}" class="text-stnt">Trang chủ</a></li>
                    <li class="breadcrumb-item active" aria-current="page">So sánh sản phẩm</li>
                </ol>
            </nav>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-12 border border-1 fs-5">
                    <p class="fw-bold">{{ $product->product->name ?? $product->name }} ({{ $product->title ?? '' }})</p>
                    <p>&</p>
                    <p></p>
                </div>
                <div class="col-md-4 col-6 border border-1">
                    <div class="product_item position-relative text-center mb-3">
                        <img class="Sirv image-main" src="{{ $product->product->thumbnail ?? $product->thumbnail }}"
                            data-src="{{ $product->product->thumbnail ?? $product->thumbnail }}" alt=""
                            width="100%">
                        <div class="p-3">
                            <p class="fs-6" style="">{{ $product->product->name ?? $product->name }}
                                ({{ $product->title ?? '' }})</p>
                            <div class="text-tgnt">
                                <span
                                    class="text-decoration-line-through text-muted">{{ formatMoney($product->price) }}đ</span>
                                @if ($product->product->discount ?? $product->discount > 0)
                                    <span class="badge bg-light-warning text-dark-warning">-
                                        {{ $product->product->discount ?? $product->discount }}%</span>
                                @endif
                                <p class="fs-5">
                                    {{ formatMoney($product->price - ($product->price * ($product->product->discount ?? $product->discount)) / 100) }}đ
                                </p>
                            </div>
                        </div>
                        {{-- discount --}}

                    </div>
                </div>
                <div class="col-md-4 col-6 border border-1">s</div>
            </div>
        </div>
    </section>
@endsection

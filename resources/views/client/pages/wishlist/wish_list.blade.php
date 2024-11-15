@extends('client.layout')

@section('content')
<section class="container">
    <div class="d-none d-xxl-block mp-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="trangchu.html" class="text-stnt">Trang chủ</a></li>
                <!-- <li class="breadcrumb-item"><a href="product.html" class="text-stnt">Sản phẩm</a></li> -->
                <li class="breadcrumb-item active" aria-current="page">Sản phẩm yêu thích</li>
            </ol>
        </nav>
    </div>
    <div class="wishlist-title">
        <h3>Mục yêu thích của bạn !</h3>
        <p>7 sản phẩm</p>
    </div>
    <div class="wishlist-product row animate__animated animate__fadeIn">
        <!-- 1 sản phẩm -->
        <div class="col-md-6 col-lg-4 col-xl-3 col-6 d-flex justify-content-center mb-4">
            <div class="card rounded overflow-hidden custom-card border-0">
                <div class="position-relative" style="background-color: #EBEBEB;">
                    <img src="\client_asset\image\product\wishlist2.png" class="card-img-top" alt="...">
                    <div class="con-like position-absolute top-0 end-0 mt-2 me-3">
                        <input class="like" type="checkbox" checked title="like">
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
                    </div>
                </div>
                <div class="card-body p-0 mt-2">
                    <h5 class="card-text"><a href="">Ghế Sofa Gather</a></h5>
                    <p class="card-text">120,000,000 đ</p>
                </div>
            </div>
        </div>
        <!-- 1 sản phẩm -->
        <div class="col-md-6 col-lg-4 col-xl-3 col-6 d-flex justify-content-center mb-4">
            <div class="card rounded overflow-hidden custom-card border-0">
                <div class="position-relative" style="background-color: #EBEBEB;">
                    <img src="\client_asset\image\product\wishlist1.png" class="card-img-top" alt="...">
                    <div class="con-like position-absolute top-0 end-0 mt-2 me-3">
                        <input class="like" type="checkbox" checked title="like">
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
                    </div>
                </div>
                <div class="card-body p-0 mt-2">
                    <h5 class="card-text"><a href="">Ghế Sofa Gather</a></h5>
                    <p class="card-text">120,000,000 đ</p>
                </div>
            </div>
        </div>
        <!-- 1 sản phẩm -->
        <div class="col-md-6 col-lg-4 col-xl-3 col-6 d-flex justify-content-center mb-4">
            <div class="card rounded overflow-hidden custom-card border-0">
                <div class="position-relative" style="background-color: #EBEBEB;">
                    <img src="\client_asset\image\product\wishlist3.png" class="card-img-top" alt="...">
                    <div class="con-like position-absolute top-0 end-0 mt-2 me-3">
                        <input class="like" type="checkbox" checked title="like">
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
                    </div>
                </div>
                <div class="card-body p-0 mt-2">
                    <h5 class="card-text"><a href="">Ghế Sofa Gather</a></h5>
                    <p class="card-text">120,000,000 đ</p>
                </div>
            </div>
        </div>
        <!-- 1 sản phẩm -->
        <div class="wishlist-product row animate__animated animate__fadeIn">
            @foreach ($products as $product)
                <div class="col-md-6 col-lg-4 col-xl-3 col-6 d-flex justify-content-center mb-4">
                    <div class="card rounded overflow-hidden custom-card border-0">
                        <div class="position-relative" style="background-color: #EBEBEB;">
                            <img src="{{ asset('client_asset/image/product/' . ($product->image ?? 'wishlist3.png')) }}" 
                            class="card-img-top" alt="">
                            <div class="con-like position-absolute top-0 end-0 mt-2 me-3">
                                <input class="like" type="checkbox" checked title="like" 
                                       data-id="{{ $product->id }}" data-type="remove">
                                <div class="checkmark">
                                    <!-- SVG icons -->
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0 mt-2">
                            <h5 class="card-text">
                                <a href="{{ route('product.detail', $product->id) }}">{{ $product->name }}</a>
                            </h5>
                            <p class="card-text">{{ number_format($product->price, 0, ',', '.') }} đ</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
    </div>

</section>

@endsection

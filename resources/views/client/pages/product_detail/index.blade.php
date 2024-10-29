@extends('client.layout')

@section('content')
    <!-- abc -->
    <section class="product_ct container">
        <div class="row">
            <div class="col-xxl-12 d-none d-xxl-block">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="trangchu.html" class="text-stnt">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="product.html" class="text-stnt">Sản phẩm</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Sofa 3 chỗ Orientale da beige R5</li>
                    </ol>
                </nav>
            </div>
            <div class="col-xxl-6 col-sm-12 mb-5">
                <div class="row">
                    <div class="col-md-12 text-center overflow-hidden rounded">
                        <!-- Main product image -->
                        <div class="bg-secondary overflow-hidden rounded">
                            <img id="mainImage"
                                src="https://nhaxinh.com/wp-content/uploads/2024/08/sofa-3-cho-orientale-da-beige-r5-768x511.jpg"
                                class="product-image img-fluid rounded" alt="Main Product Image">
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12 text-center thumbnail-images">
                        <!-- Thumbnail images -->
                        <img src="https://nhaxinh.com/wp-content/uploads/2024/08/sofa-3-cho-orientale-da-beige-r5-768x511.jpg"
                            class="img-thumbnail active"
                            data-image="https://nhaxinh.com/wp-content/uploads/2024/08/sofa-3-cho-orientale-da-beige-r5-768x511.jpg">
                        <img src="https://nhaxinh.com/wp-content/uploads/2024/08/sofa-3-cho-orientale-da-beige-r5-3-768x511.jpg"
                            class="img-thumbnail"
                            data-image="https://nhaxinh.com/wp-content/uploads/2024/08/sofa-3-cho-orientale-da-beige-r5-3-768x511.jpg">
                        <img src="https://nhaxinh.com/wp-content/uploads/2024/08/sofa-3-cho-orientale-da-beige-r5-2-768x511.jpg"
                            class="img-thumbnail"
                            data-image="https://nhaxinh.com/wp-content/uploads/2024/08/sofa-3-cho-orientale-da-beige-r5-2-768x511.jpg">
                        <img src="https://nhaxinh.com/wp-content/uploads/2024/08/BST-Orientale-768x512.jpg"
                            class="img-thumbnail"
                            data-image="https://nhaxinh.com/wp-content/uploads/2024/08/BST-Orientale-768x512.jpg">
                    </div>
                </div>
            </div>
            <div class="col-xxl-6 col-sm-12 mb-5">
                <div class="title_spct mb-7">
                    <h1>Sofa 3 chỗ Orientale da beige R5</h1>
                </div>
                <div class="price_spct d-flex">
                    <!-- <i class="heart_spct bi bi-heart"></i> -->
                    <span class="price_base_spct text-danger">12,300,000 đ</span>
                    <strike class="price_discount_spct ms-3">15,300,000 đ</strike>
                </div>

                <!-- info sản phẩm -->
                <div class="info_spct mt-7">
                    <div class="mb-xxl-7 mb-2">
                        <strong>Vật liệu: </strong>
                        <span class="badge bg-light text-dark product_ct_badge">Khung gỗ Walnut tự nhiên </span>
                        <span class="badge bg-light text-dark product_ct_badge">Nệm bọc da bò tự nhiên cao cấp màu Beige
                            R5</span>
                    </div>
                    <div class="mb-xxl-7 mb-2">
                        <strong>Kích thước: </strong>
                        <span class="badge bg-light text-dark product_ct_badge"> D2300 - R945 - C390/780 mm</span>
                    </div>
                    <div class="mb-xxl-7 mb-2">
                        <strong>Hàng có sẵn: </strong>
                        <span class="badge bg-light text-dark product_ct_badge"> Trong kho </span>
                    </div>
                    <div class="mb-xxl-7 mb-2">
                        <strong>Danh mục: </strong>
                        <a href="" class="cate_ctsp"><span class="badge bg-light text-dark product_ct_badge"> Phòng
                                khách </span></a>
                        <a href="" class="cate_ctsp"><span class="badge bg-light text-dark product_ct_badge"> Sofa
                            </span></a>
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
                                href="#pills-policy" role="tab" aria-controls="pills-policy"
                                aria-selected="false">
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
                            <a class="nav-link fs-xxl-5 fw-bold pb-2" id="pills-feedback-tab" data-bs-toggle="pill"
                                href="#pills-feedback" role="tab" aria-controls="pills-feedback"
                                aria-selected="false">
                                Đánh giá
                            </a>
                        </li>
                    </ul>
                    <!-- Tab content -->
                    <div class="tab-content" id="pills-tabContent-javascript-behavior-pills">
                        @include('client.pages.product_detail.components.tab_description')
                        @include('client.pages.product_detail.components.tab_policy')
                        @include('client.pages.product_detail.components.tab_rate')
                        @include('client.pages.product_detail.components.tab_comment')
                    </div>
                </div>
                <!-- end policy sản phẩm -->
            </div>
        </div>
    </section>
    <!-- end -->

    <script>
        $(document).ready(function() {
            $('.thumbnail-images img').on('click', function() {
                var newImage = $(this).data('image');
                $('#mainImage').fadeOut(300, function() {
                    $('#mainImage').attr('src', newImage);
                    $('#mainImage').fadeIn(300);
                });
                $('.thumbnail-images img').removeClass('active');
                $(this).addClass('active');
            });
        });
    </script>
@endsection

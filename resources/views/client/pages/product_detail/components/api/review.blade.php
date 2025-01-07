@if (isset($reviewForProduct) && count($reviewForProduct) > 0)
    <div class="p-3 px-xxl-15">
        <div class="row">
            <div class="col-12 col-xxl-4">
                <div class="me-lg-12 mb-6 mb-md-0">
                    <div class="mb-5">
                        <!-- title -->
                        <h4 class="mb-3">Người dùng đánh giá</h4>
                        <span>
                            <!-- rating -->
                            <small class="text-warning">
                                @for ($i = 0; $i < floor($rating['average']); $i++)
                                    <i class="bi bi-star-fill"></i>
                                @endfor
                                @if ($rating['average'] - floor($rating['average']) >= 0.5)
                                    <i class="bi bi-star-half"></i>
                                @endif
                                @for ($i = 0; $i < 5 - ceil($rating['average']); $i++)
                                    <i class="bi bi-star"></i>
                                @endfor
                            </small>

                            <span class="ms-3">{{ $rating['average'] }}/5 </span>
                            <small class="ms-3">{{ $rating['totalReviews'] }} đánh giá</small>
                        </span>
                    </div>
                    <div class="mb-8">
                        @foreach ($rating['percentages'] as $star => $percent)
                            <div class="d-flex align-items-center mb-2">
                                <div class="text-nowrap me-3 text-muted">
                                    <span class="d-inline-block align-middle text-muted">{{ $star }}</span>
                                    <i class="bi bi-star-fill ms-1 small text-warning"></i>
                                </div>
                                <div class="w-100">
                                    <div class="progress" style="height: 6px">
                                        <div class="progress-bar bg-warning" role="progressbar"
                                            style="width: {{ $percent }}%" aria-valuenow="{{ $percent }}"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <span class="text-muted ms-3">{{ $percent }}%</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-12 col-xxl-8">
                @foreach ($reviewForProduct as $item)
                    <div class="review-container border-bottom pb-2">
                        <!-- Đánh giá của người dùng -->
                        <div class="user-review d-flex">
                            <img loading="lazy" src="{{ $item->user->avatar }}" alt="User Avatar"
                                class="rounded-circle avatar-lg">
                            <div class="ms-4">
                                <h6 class="fw-bold mb-1">{{ $item->user->name }}</h6>
                                <small class="text-warning">
                                    @for ($i = 0; $i < floor($item->rating); $i++)
                                        <i class="bi bi-star-fill"></i>
                                    @endfor
                                    @if ($item->rating - floor($item->rating) >= 0.5)
                                        <i class="bi bi-star-half"></i>
                                    @endif
                                    @for ($i = 0; $i < 5 - ceil($item->rating); $i++)
                                        <i class="bi bi-star"></i>
                                    @endfor
                                </small>
                                <p class="text-muted small mb-2">{{ $item->created_at }}</p>
                                <p class="review-text mb-0">{{ $item->content }}</p>
                            </div>
                        </div>
                        <!-- Phản hồi của tgnt -->
                        {{-- @dd($item->children) --}}
                        @if ($item->children && count($item->children) > 0)
                            @foreach ($item->children as $reply)
                                <div class="seller-reply ms-13 p-3 rounded">
                                    <div class="">
                                        <h7 class="fw-bold mb-1">Phản hồi của {{ env('CMS_NAME') }}</h7>
                                        <p class="reply-text m-0">{{ $reply->content }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                @endforeach
                <!-- CSS Styles -->
                <style>
                    .user-review {
                        padding: 10px 0;
                    }

                    .avatar-lg {
                        width: 60px;
                        height: 60px;
                    }

                    .review-text {
                        margin-top: 10px;
                        font-size: 14px;
                        color: #333;
                    }

                    .review-images {
                        margin-top: 10px;
                    }

                    .review-img {
                        width: 100px;
                        height: auto;
                        margin-right: 5px;
                        border-radius: 5px;
                    }

                    .seller-reply {
                        /* margin-top: 20px; */
                        background-color: #f5f5f5;
                    }

                    .reply-text {
                        font-size: 14px;
                        color: #666;
                    }

                    .seller-reply .d-flex {
                        align-items: flex-start;
                    }

                    .seller-reply h6 {
                        font-size: 16px;
                        color: #2c3e50;
                    }
                </style>
                {{-- 1 cái đánh giá --}}
            </div>
        </div>
    </div>
@else
    <div class="col-12">
        <div class="text-center pt-10">
            <img class="mb-3 mb-3" width="100" src="{{ asset('uploads/image/system/no_product.webp') }}"
                alt="">
            <p>Chưa có đánh giá nào cho sản phẩm này!</p>
        </div>
    </div>
@endif

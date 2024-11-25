@if ($orders->count() > 0)
    @foreach ($orders as $item)
        <div class="card order-card mb-3 shadow-sm animate__animated animate__fadeIn">
            <div class="card-header order-header d-flex justify-content-between align-items-center"
                style="background-color: #e9ecef; border-bottom: 1px solid #ccc;">
                <div class="order-code">
                    <span class="text-muted">#{{ $item->code }}</span>
                </div>
                <div class="order-status">
                    <span class="fw-semibold">
                        TRẠNG THÁI: &nbsp;
                        <span class="text-tgnt text-uppercase">
                            {{ statusOrder($item->status) }}
                        </span>
                    </span>
                </div>
            </div>
            <div class="card-body order-body d-flex flex-wrap justify-content-between align-items-center">
                <div class="order-total mb-2">
                    <span class="fw-bold text-tgnt">
                        Tổng tiền: {{ formatMoney($item->total) }} ₫
                    </span>
                </div>
                <div class="order-actions d-flex gap-2">
                    <button data-order-id="{{ $item->id }}"
                        data-order-url="{{ route('client.account.get-order-detail') }}" data-bs-toggle="modal"
                        data-bs-target="#orderDetail" class="btn btn-outline-secondary btn-sm"
                        aria-label="View Order Details">
                        Xem Chi Tiết Đơn Hàng
                    </button>
                    @if ($item->status == 'pending')
                        <button data-order-id="{{ $item->id }}" data-order-id="{{ $item->id }}"
                            data-order-url="{{ route('client.account.cancel-order') }}" data-bs-toggle="modal"
                            data-bs-target="#orderCancel" class="btn btn-danger btn-sm"
                            class="btn btn-outline-danger btn-sm" aria-label="Cancel Order">
                            Hủy Đơn Hàng
                        </button>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
    @if ($paginate)
        <div class="d-flex justify-content-center">
            {{ $orders->links('pagination::bootstrap-4') }}
        </div>
    @endif
@else
    <div class="pt-8 d-flex align-items-center" style="flex-direction: column">
        <img width="60"
            src="https://deo.shopeemobile.com/shopee/shopee-pcmall-live-sg/orderlist/5fafbb923393b712b964.png"
            alt="">
        <p class="text-center">Chưa có đơn hàng</p>
    </div>
@endif

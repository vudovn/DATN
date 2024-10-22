@if (isset($orders) && count($orders))
    @foreach ($orders as $order)
        <tr class="animate__animated animate__fadeInDown animate__faster">
            <td>
                <div class="form-check">
                    <input class="form-check-input input-primary input-checkbox checkbox-item" type="checkbox"
                        id="customCheckbox{{ $order->id }}" value="{{ $order->id }}">
                    <label class="form-check-label" for="ustomCheckbox{{ $order->id }}"></label>
                </div>
            </td>
            <td>{{ $order->id }}</td>
            <td>{{ $order->code }}</td>
            <td>{{ number_format($order->total_amount, 0, ',', '.') }} VND</td>
            <td>Thanh toán khi nhận hàng</td>
            <td>Đang xử lý</td>
            <td>{{ statusOrder($order->status) }}</td>
            <td>{{ changeDateFormat($order->created_at) }}</td>
            <td class="text-center table-actions">
                <ul class="list-inline me-auto mb-0">
                    <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" title="Chỉnh sửa">
                        <a href="{{ route('order.edit', ['id' => $order->id, 'page' => request()->get('page', 1)]) }}"
                            class="avtar avtar-xs btn-link-success btn-pc-default">
                            <i class="ti ti-edit-circle f-18"></i>
                        </a>
                    </li>
                    <x-delete :id="$order->id" :model="ucfirst($config['model'])" />
                </ul>
            </td>
        </tr>
    @endforeach
    <tr>
        <td>
            <div class="card-footer">
                {{ $orders->links('pagination::bootstrap-4') }}
            </div>
        </td>
    </tr>
@else
    <tr>
        <td colspan="100" class="text-center">Không có dữ liệu</td>
    </tr>
@endif

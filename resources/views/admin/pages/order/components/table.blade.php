@if (isset($orders) && count($orders))
    @foreach ($orders as $key => $order)
        <tr class="animate__animated animate__fadeIn">
            <td>
                <div class="form-check">
                    <input class="form-check-input input-primary input-checkbox checkbox-item" type="checkbox"
                        id="customCheckbox{{ $order->id }}" value="{{ $order->id }}">
                    <label class="form-check-label" for="ustomCheckbox{{ $order->id }}"></label>
                </div>
            </td>
            <td>{{ $key+1 }}</td>
            <td><a href="{{ route('order.edit',  ['id' => $order->id]) }}">{{ $order->code }}</a></td>
            <td>{{ number_format($order->total, 0, '.', '.') }}</td>
            <td>Thanh toán khi nhận hàng</td>
            <td>
                    <select name="payment_status" id="" data-id="{{ $order->id }}"  class="form-select select_status">
                        @foreach (__('order.payment_status') as $key => $item)
                            <option value="{{ $key }}" {{ $order->payment_status == $key ? 'selected' : '' }}>
                                {{ $item }}
                            </option>
                        @endforeach
                    </select>
            </td>            
            <td>
                <select name="status" id="" data-id="{{ $order->id }}" class="form-select select_status">
                    @php
                        $status = __('order.status');
                    @endphp

                    @if (is_array($status))
                        @foreach ($status as $key => $value)
                            <option value="{{ $key }}" {{ $order->status == $key ? 'selected' : '' }}>
                                {{ $value }}
                            </option>
                        @endforeach
                    @else
                        <option value="">{{ $status }}</option>
                    @endif
                </select>
            </td>
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

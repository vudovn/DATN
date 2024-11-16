@if (isset($discountCodes) && count($discountCodes))
    @foreach ($discountCodes as $discount)
        <tr class="animate__animated animate__fadeIn">
            <td>
                <div class="form-check">
                    <input class="form-check-input input-primary input-checkbox checkbox-item" type="checkbox"
                        id="customCheckbox{{ $discount->id }}" value="{{ $discount->id }}">
                    <label class="form-check-label" for="customCheckbox{{ $discount->id }}"></label>
                </div>
            </td>
            <td>{{ $discount->id }}</td>
            <td>{{ $discount->code }}</td>
            <td>{{ $discount->title }}</td>
            <td>
                @if ($discount->discount_type == 1)
                    Theo %
                @elseif ($discount->discount_type == 2)
                    Theo tiền
                @else
                    Không xác định
                @endif
            </td>
            <td>{{ changeDateFormat($discount->start_date) }}</td>
            <td>{{ changeDateFormat($discount->end_date) }}</td>
            <td class="text-center">
                <x-switchvip :value="$discount" :model="ucfirst($config['model'])" />
            </td>
            <td class="text-center table-actions">
                <ul class="list-inline me-auto mb-0">
                    <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" title="Chỉnh sửa">
                        <a href="{{ route('discountCode.edit', ['id' => $discount->id, 'page' => request()->get('page', 1)]) }}"
                            class="avtar avtar-xs btn-link-success btn-pc-default">
                            <i class="ti ti-edit-circle f-18"></i>
                        </a>
                    </li>
                    <x-delete :id="$discount->id" :model="ucfirst($config['model'])" />
                </ul>
            </td>
        </tr>
    @endforeach
    <tr class="animate__animated animate__fadeIn">
        <td colspan="100">
            {!! $discountCodes->links('pagination::bootstrap-4') !!}
        </td>
    </tr>
@else
    <tr>
        <td colspan="100" class="text-center">Không có dữ liệu</td>
    </tr>
@endif

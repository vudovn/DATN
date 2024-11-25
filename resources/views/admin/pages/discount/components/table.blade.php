@if (isset($discountCodes) && count($discountCodes))
    @foreach ($discountCodes as $key => $discount)
        <tr class="animate__animated animate__fadeIn">
            <td>
                <div class="form-check">
                    <input class="form-check-input input-primary input-checkbox checkbox-item" type="checkbox"
                        id="customCheckbox{{ $discount->id }}" value="{{ $discount->id }}">
                    <label class="form-check-label" for="customCheckbox{{ $discount->id }}"></label>
                </div>
            </td>
            <td>{{ $key+1 }}</td>
            <td>
                <div class="discount mb-0 alert {{ checkExpiredDate($discount->end_date) ? 'alert-secondary' : 'alert-primary' }} d-flex justify-content-between align-items-center"
                    role="alert">
                    <div class="discount-inner">
                        <p class="discount-code mb-1">
                            <span class="text-uppercase">Mã giảm giá</span>:
                            <b id="pc-clipboard{{ $discount->id }}">{{ $discount->code }}</b>
                        </p>
                        <p class="discount-desc text-muted mb-0">
                            {{ $discount->title }}
                        </p>
                        <p class="discount-expired text-danger {{ checkExpiredDate($discount->end_date) ? '' : 'd-none' }} mt-0 mb-0"
                            id="discount-expired">
                            Mã này đã hết hạn!
                        </p>
                    </div>
                    <a href="#!" data-clipboard-target="#pc-clipboard{{ $discount->id }}"
                        class="clipboard copy-icon">
                        <svg class="pc-icon" width="20" height="20">
                            <use xlink:href="#custom-simcard-2"></use>
                        </svg>
                    </a>
                </div>
            </td>
            <td class="text-center">
                {{ $discount->users->count() }}
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
<style>
    /* .discount {
        border-radius: 8px;
        padding: 12px 16px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        border: 1px dashed #004d4d;
    }

    .discount-inner {
        display: flex;
        flex-direction: column;
    }

    .discount-code {
        font-weight: bold;
        font-size: 1.1rem;
        margin-bottom: 5px;
    }

    .discount-desc {
        font-size: 0.9rem;
        color: #6c757d;
    }

    .copy-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background-color: #ffffff;
        padding: 8px;
        border-radius: 50%;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s ease;
    }

    .copy-icon:hover {
        background-color: #f1f9ff;
    }

    .discount-expired {
        font-size: 0.9rem;
        color: #dc3545;
        margin-top: 10px;
        font-style: italic
    } */


    .discount {
        border-radius: 12px;
        padding: 16px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
        border: 1px dashed #4C8672;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .discount:hover {
        transform: scale(1.02);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .discount-inner {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .discount-code {
        font-weight: bold;
        font-size: 1.2rem;
    }

    .discount-desc {
        font-size: 0.95rem;
        font-style: italic;
    }

    .discount-expired {
        font-size: 0.9rem;
        color: #FF6B6B;
        margin-top: 10px;
        font-style: italic;
    }

    .copy-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background-color: #FFFFFF;
        padding: 10px;
        border-radius: 50%;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .copy-icon:hover {
        transform: scale(1.1);
        box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
    }
</style>

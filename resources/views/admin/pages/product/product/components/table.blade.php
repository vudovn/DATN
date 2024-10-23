@if (isset($products) && count($products))
    @foreach ($products as $product)
        <tr class="animate__animated animate__fadeIn">
            <td class="">
                <div class="form-check">
                    <input class="form-check-input input-primary input-checkbox checkbox-item" type="checkbox"
                        id="customCheckbox{{ $product->id }}" value="{{ $product->id }}">
                    <label class="form-check-label" for="ustomCheckbox{{ $product->id }}"></label>
                </div>
            </td>
            <td>{{ $product->id }}</td>
            <td>
                <a data-fancybox="gallery" href="{{ $product->thumbnail }}">
                    <img loading="lazy" width="80" class="rounded" src="{{ $product->thumbnail }}"
                        alt="{{ $product->name }}">
                </a>
            </td>

            <td class="text-primary text-wrap">
                {{ $product->name }} <br>
                {!! $product->discount != 0
                    ? "<span class='badge bg-light-danger'>Có giảm giá - $product->discount%</span>"
                    : '' !!}
                {!! $product->is_featured == 1 ? '<span class="badge bg-light-danger">Nổi bật</span>' : '' !!}
                {!! $product->has_attribute == 1 ? '<span class="badge bg-light-danger">Có biến thể</span>' : '' !!}

            </td>
            <td class="text-center">{{ number_format($product->price) }}</td>
            <td class="text-center">{{ number_format($product->quantity) }}</td>
            <td class="text-center">{{ $product->sku }}</td>
            <td>{{ changeDateFormat($product->created_at) }}</td>
            <td class="text-center">-</td>
            <td class="text-center">
                <x-switchvip :value="$product" :model="ucfirst($config['model'])" />
            </td>
            <td class="text-center table-actions">
                <ul class="list-inline me-auto mb-0">
                    <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" title="Chỉnh sửa">
                        <a href="{{ route('product.edit', ['id' => $product->id, 'page' => request()->get('page', 1)]) }}"
                            class="avtar avtar-xs btn-link-success btn-pc-default">
                            <i class="ti ti-edit-circle f-18"></i>
                        </a>
                    </li>
                    <x-delete :id="$product->id" :model="ucfirst($config['model'])" />
                </ul>
            </td>
        </tr>
    @endforeach
    <tr class="animate__animated animate__fadeIn">
        <td colspan="100">
            {!! $products->links('pagination::bootstrap-4') !!}
        </td>
    </tr>
@else
    <tr>
        <td colspan="100" class="text-center">Không có dữ liệu</td>
    </tr>
@endif

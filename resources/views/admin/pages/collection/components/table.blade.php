@if (isset($collections) && count($collections))
    @foreach ($collections as $collection)
        <tr class="animate__animated animate__fadeIn">
            <td class="">
                <div class="form-check">
                    <input class="form-check-input input-primary input-checkbox checkbox-item" type="checkbox"
                        id="customCheckbox{{ $collection->id }}" value="{{ $collection->id }}">
                    <label class="form-check-label" for="ustomCheckbox{{ $collection->id }}"></label>
                </div>
            </td>
            <td>{{ $collection->id }}</td>
            <td>
                <a data-fancybox="gallery" href="{{ $collection->thumbnail }}">
                    <img decoding="async" width="80" class="rounded" src="{{ $collection->thumbnail }}"
                        alt="{{ $collection->name }}">
                </a>
            </td>

            <td class="text-primary text-wrap">
                {{ $collection->name }} <br>
                {!! $collection->discount != 0
                    ? "<span class='badge bg-light-danger'>Có giảm giá - $collection->discount%</span>"
                    : '' !!}
            </td>
            <td>{{ $collection->short_content }}</td>
            <td>{{ changeDateFormat($collection->created_at) }}</td>
            <td class="text-center">
                <x-switchvip :value="$collection" :model="ucfirst($config['model'])" />
            </td>
            <td class="text-center table-actions">
                <ul class="list-inline me-auto mb-0">
                    <li class="list-inline-item align-bottom" data-bs-toggle="tooltip" title="Chỉnh sửa">
                        <a href="{{ route('collection.edit', ['id' => $collection->id]) }}"
                        {{-- <a href="{{ route('collection.edit', ['id' => $collection->id, 'page' => request()->get('page', 1)]) }}" --}}
                            class="avtar avtar-xs btn-link-success btn-pc-default">
                            <i class="ti ti-edit-circle f-18"></i>
                        </a>
                    </li>
                    <x-delete :id="$collection->id" :model="ucfirst($config['model'])" />
                </ul>
            </td>
        </tr>
    @endforeach
    <tr class="animate__animated animate__fadeIn">
        <td colspan="100">
            {!! $collections->links('pagination::bootstrap-4') !!}
        </td>
    </tr>
@else
    <tr>
        <td colspan="100" class="text-center">Không có dữ liệu</td>
    </tr>
@endif

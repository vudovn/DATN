@extends('admin.layout')

@section('template')

    <x-breadcrumb :breadcrumb="$config['breadcrumb']" />

    <div class="card">
        <div class="card-header">
            <x-filter :createButton="[
                'label' => '',
                'route' => $config['model'] . '.create',
            ]" :options="[
                'actions' => generateSelect('Hành động', __('general.actions')),
                // 'perpage' => generateSelect('Mỗi trang', __('general.perpage')),
                // 'user_catalogue_id' => generateSelect('Vai trò', $userCatalogues),
                'publish' => generateSelect('Trạng thái', __('general.publish')),
                'sort' => generateSelect('Sắp xếp', __('general.sort')),
            ]" />
        </div>
        <div class="card-body">
           <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>
                            <div class="form-check">
                                <input class="form-check-input input-primary" type="checkbox" id="checkAll">
                                <label class="form-check-label" for="checkAll"></label>
                            </div>
                        </th>
                        <th>ID</th>
                        <th>Hình ảnh</th>
                        <th>Tên sản phảm</th>
                        <th>Giá tiền</th>
                        <th class="text-center">Số lượng</th>
                        <th class="text-center">SKU</th>
                        <th class="text-center">Ngày tạo</th>
                        <th class="text-center">Danh mục</th>
                        <th class="text-center">Trạng thái</th>
                        <th class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($products) && count($products))
                        @foreach ($products as $product)
                            <tr class="animate__animated animate__fadeInDown animate__faster">
                                <td class=""> 
                                    <div class="form-check">
                                        <input class="form-check-input input-primary input-checkbox checkbox-item"
                                            type="checkbox" id="customCheckbox{{ $product->id }}"
                                            value="{{ $product->id }}">
                                        <label class="form-check-label"
                                            for="ustomCheckbox{{ $product->id }}"></label>
                                    </div>
                                </td>
                                <td>{{ $product->id }}</td>
                                <td>
                                    <a data-fancybox="gallery" href="{{ $product->thumbnail }}">
                                        <img loading="lazy" width="80" class="rounded" src="{{ $product->thumbnail }}" alt="{{ $product->name }}">
                                    </a>
                                </td>

                                <td class="text-primary text-wrap" >
                                        {{ $product->name }} <br>
                                        {!! $product->discount != 0 ? "<span class='badge bg-light-danger'>Có giảm giá - $product->discount%</span>" : '' !!}
                                        {!! $product->is_featured == 1 ? '<span class="badge bg-light-danger">Nổi bật</span>' : ''    !!}
                                        {!! $product->has_attribute == 1 ? '<span class="badge bg-light-danger">Có biến thể</span>' : ''    !!}

                                </td>
                                <td class="text-center">{{ number_format($product->price) }}</td>
                                <td class="text-center">{{ number_format($product->quantity)   }}</td>
                                <td class="text-center">{{ $product->sku }}</td>
                                <td>{{ changeDateFormat($product->created_at) }}</td>
                                <td class="text-center">-</td>
                                <td class="text-center">
                                    <x-switchvip :value="$product" :model="ucfirst($config['model'])"/>
                                </td>
                                <td class="text-center table-actions">
                                    <ul class="list-inline me-auto mb-0">
                                        <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                            title="Chỉnh sửa">
                                            <a href="{{ route('product.edit', ['id' => $product->id, 'page' => request()->get('page', 1)]) }}"
                                                class="avtar avtar-xs btn-link-success btn-pc-default">
                                                <i class="ti ti-edit-circle f-18"></i>
                                            </a>
                                        </li>
                                    <x-delete :id="$product->id" :model="ucfirst($config['model'])"/>
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="9" class="text-center">Không có dữ liệu</td>
                        </tr>
                    @endif
                </tbody>
            </table>
           </div>

        </div>
        <div class="card-footer">
            {{ $products->links('pagination::bootstrap-4') }}
        </div>
    </div>
    <input type="hidden" name="model" id="model" value="{{ ucfirst($config['model']) }}">

@endsection

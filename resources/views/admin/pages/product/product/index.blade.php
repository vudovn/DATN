@extends('admin.layout')

@section('template')

    <x-breadcrumb :breadcrumb="$config['breadcrumb']" />

    <div class="card">
        <div class="card-header pb-0">
            <x-filter :createButton="[
                'label' => 'Thêm sản phẩm',
                'route' => $config['model'] . '.create',
            ]" :options="[
                'actions' => generateSelect('Hành động', __('general.actions')),
                'perpage' => generateSelect('Mỗi trang', __('general.perpage')),
                // 'user_catalogue_id' => generateSelect('Vai trò', $userCatalogues),
                'publish' => generateSelect('Trạng thái', __('general.publish')),
                'sort' => generateSelect('Sắp xếp', __('general.sort')),
            ]" />
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input input-checkbox" type="checkbox" id="checkAll">
                                <label for="checkAll" class="custom-control-label"></label>
                            </div>
                        </th>
                        <th>ID</th>
                        <th>Hình ảnh</th>
                        <th>Tên sản phảm</th>
                        <th>Giá tiền</th>
                        <th>Ngày tạo</th>
                        <th class="text-center">Danh mục</th>
                        <th class="text-center">Trạng thái</th>
                        <th class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($products) && count($products))
                        @foreach ($products as $product)
                            <tr>
                                <td class=""> 
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input input-checkbox checkbox-item" type="checkbox"
                                            value="{{ $product->id }}" id="customCheckbox{{ $product->id }}">
                                        <label for="customCheckbox{{ $product->id }}" class="custom-control-label"></label>
                                    </div>
                                </td>
                                <td>{{ $product->id }}</td>
                                <td>
                                    <a data-fancybox="gallery" href="{{ $product->thumbnail }}">
                                        <img loading="lazy" width="80" class="rounded" src="{{ $product->thumbnail }}" alt="{{ $product->name }}">
                                    </a>
                                </td>

                                <td>
                                    <span class="row-name">{{ $product->name }}</span>
                                </td>
                                <td>{{ number_format($product->price) }}</td>
                                <td>{{ changeDateFormat($product->created_at) }}</td>
                                <td class="text-center">-</td>
                                <td class="text-center js-switch-{{ $product->id }}">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input js-switch status"
                                            id="customSwitch{{ $product->id }}" data-field="publish" data-value="{{ $product->publish }}"
                                            data-model="{{ ucfirst($config['model']) }}" data-id="{{ $product->id }}"
                                            {{ $product->publish === 2 ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="customSwitch{{ $product->id }}"></label>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('product.edit', ['id' => $product->id]) }}" class="btn btn-sm btn-success">
                                        <i class="bi bi-pen"></i></a>
                                    <x-delete :id="$product->id" />
                                    {{-- <a href="{{ route('product.delete', ['id' => $product->id]) }}" class="btn btn-danger">
                                        <i class="bi bi-trash"></i></a> --}}
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8" class="text-center">Không có dữ liệu</td>
                        </tr>
                    @endif
                </tbody>
            </table>

        </div>
        <div class="card-footer">
            {{ $products->links('pagination::bootstrap-4') }}
        </div>
    </div>
    <input type="hidden" name="model" id="model" value="{{ ucfirst($config['model']) }}">

@endsection

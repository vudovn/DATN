@extends('admin.layout')

@section('template')

    <x-breadcrumb :breadcrumb="$config['breadcrumb']" />

    <div class="card">
        <div class="card-header pb-0">
            <x-filter :createButton="[
                'label' => '',
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
                        <th>Số lượng</th>
                        <th>SKU</th>
                        <th>Ngày tạo</th>
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
                                <td>{{ number_format($product->quantity)   }}</td>
                                <td>{{ $product->sku }}</td>
                                <td>{{ changeDateFormat($product->created_at) }}</td>
                                <td class="text-center">-</td>
                                <td class="text-center">
                                    <x-switchvip :value="$product" :model="ucfirst($config['model'])"/>
                                </td>
                                <td class="text-center table-actions">
                                    <a href="{{ route('product.edit', ['id' => $product->id]) }}" class="btn btn-sm btn-icon btn-primary">
                                        <svg class="icon  svg-icon-ti-ti-edit" data-bs-toggle="tooltip" data-bs-title="Edit" xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                            <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                            <path d="M16 5l3 3"></path>
                                        </svg>
                                    </a>
                                    <x-delete :id="$product->id" :model="ucfirst($config['model'])"/>
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
        <div class="card-footer">
            {{ $products->links('pagination::bootstrap-4') }}
        </div>
    </div>
    <input type="hidden" name="model" id="model" value="{{ ucfirst($config['model']) }}">

@endsection

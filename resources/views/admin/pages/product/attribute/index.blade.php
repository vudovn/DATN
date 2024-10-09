@extends('admin.layout')

@section('template')

    <x-breadcrumb :breadcrumb="$config['breadcrumb']" />

    <div class="card">
        <div class="card-header pb-0">
            <x-filter :createButton="[
                'label' => 'Tạo mới',
                'route' => 'product.' . $config['model'] . '.create',
            ]" :options="[
                'actions' => generateSelect('Hành động', __('general.actions')),
                'perpage' => generateSelect('Mỗi trang', __('general.perpage')),
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
                        <th>Tên</th>
                        <th class="text-center">#</th>
                        <th class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($attributes) && count($attributes))
                        @foreach ($attributes as $attribute)
                            <tr>
                                <td class=""> 
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input input-checkbox checkbox-item" type="checkbox"
                                            value="{{ $attribute->id }}" id="customCheckbox{{ $attribute->id }}">
                                        <label for="customCheckbox{{ $attribute->id }}" class="custom-control-label"></label>
                                    </div>
                                </td>
                                <td>
                                    {{ $attribute->name }}
                                </td>
                                <td class="text-center">
                                    <div>
                                        @foreach ($attribute->attribute_values as $item)
                                            <span class="badge badge-warning">{{ $item->value }}</span>
                                        @endforeach
                                    </div>
                                    <div> <a href="{{ route('product.attributeValue.index',$attribute->id ) }}">Quản lý biến thể</a> </div>
                                </td>
                                <td class="text-center table-actions">
                                    <a href="{{ route('product.attribute.edit', $attribute->id) }}" class="btn btn-sm btn-icon btn-primary">
                                        <svg class="icon  svg-icon-ti-ti-edit" data-bs-toggle="tooltip" data-bs-title="Edit" xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                            <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                            <path d="M16 5l3 3"></path>
                                        </svg>
                                    </a>
                                    <x-delete :id="$attribute->id" :model="ucfirst($config['model'])" />
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
            {{ $attributes->links('pagination::bootstrap-4') }}
        </div>
    </div>
    
    <input type="hidden" name="model" id="model" value="{{ ucfirst($config['model']) }}">
@endsection

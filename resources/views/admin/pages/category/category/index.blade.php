@extends('admin.layout')

@section('template')

    <x-breadcrumb :breadcrumb="$config['breadcrumb']" />

    <div class="card">
        <div class="card-header">
            <x-filter :createButton="[
                'label' => 'Thêm mới',
                'route' => $config['model'] . '.create',
            ]" :options="[
                'actions' => generateSelect('Hành động', __('general.actions')),
                // 'perpage' => generateSelect('Mỗi trang', __('general.perpage')),
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
                            <th>Tên danh mục</th>
                            <th>Phòng</th>
                            <th>Ngày tạo</th>
                            <th class="text-center">Trạng thái</th>
                            <th class="text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($categories) && count($categories))
                            @foreach ($categories as $category)
                                @if ($category->parent_id == null)
                                    <tr>
                                        <td class="">
                                            <div class="form-check">
                                                <input class="form-check-input input-primary input-checkbox checkbox-item"
                                                    type="checkbox" id="customCheckbox{{ $category->id }}"
                                                    value="{{ $category->id }}">
                                                <label class="form-check-label"
                                                    for="ustomCheckbox{{ $category->id }}"></label>
                                            </div>
                                        </td>
                                        <td>{{ $category->id }}</td>
                                        <td>
                                            <a data-fancybox="gallery" href="{{ $category->thumbnail }}">
                                                <img loading="lazy" width="50" class="rounded"
                                                    src="{{ $category->thumbnail }}" alt="{{ $category->name }}">
                                            </a>
                                        </td>
                                        <td>
                                            <span class="row-name">{{ $category->name }}</span>
                                        </td>
                                        @if ($category->is_room == 2)
                                            <td>Phòng</td>
                                        @else
                                            <td>Danh mục khác</td>
                                        @endif
                                        <td>{{ changeDateFormat($category->created_at) }}</td>
                                        <td class="text-center">
                                            <x-switchvip :value="$category" :model="ucfirst($config['model'])" />
                                        </td>

                                        <td class="text-center table-actions">
                                            <ul class="list-inline me-auto mb-0">
                                                <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                                    title="Chỉnh sửa">
                                                    <a href="{{ route('category.edit', ['id' => $category->id, 'page' => request()->get('page', 1)]) }}"
                                                        class="avtar avtar-xs btn-link-success btn-pc-default">
                                                        <i class="ti ti-edit-circle f-18"></i>
                                                    </a>
                                                </li>
                                            <x-delete :id="$category->id" :model="ucfirst($config['model'])" />
                                            </ul>
                                        </td>
                                    </tr>
                                    @foreach ($category->children->whereNotNull('parent_id') as $child)
                                        @include('admin.pages.category.component.child', [
                                            'child' => $child,
                                            'char' => ' |-- ',
                                        ])
                                    @endforeach
                                @endif
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8" class="text-center">Không có dữ liệu</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

        </div>
        <div class="card-footer">
            {{-- {{ $categorys->links('pagination::bootstrap-4') }} --}}
        </div>
    </div>
    <input type="hidden" name="model" id="model" value="{{ ucfirst($config['model']) }}">

@endsection

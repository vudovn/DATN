@extends('admin.layout')

@section('template')

    <x-breadcrumb :breadcrumb="$config['breadcrumb']" />

    <div class="card">
        <div class="card-header">
            <x-filter
            :model="$config['model']"
            :createButton="[
                'label' => '',
                'route' => $config['model'] . '.create',
            ]" :options="[
                'actions' => generateSelect('Hành động', __('general.actions')),
                'perpage' => generateSelect('10 hàng', __('general.perpage')),
                // 'user_catalogue_id' => generateSelect('Vai trò', $userCatalogues),
                'publish' => generateSelect('Trạng thái', __('general.publish')),
                'sort' => generateSelect('Sắp xếp', __('general.sort')),
            ]" />
        </div>
        <div class="card-body p-0">
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
                        <th>STT</th>
                        <th>Ảnh bìa</th>
                        <th>Tên bộ sưu tập</th>
                        <th>Mô tả</th>
                        <th class="text-center">Ngày tạo</th>
                        <th class="text-center">Ngày cập nhật</th>
                        <th class="text-center">Trạng thái</th>
                        <th class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    @include('admin.pages.collection.components.table')
                </tbody>
            </table>
           </div>
        </div>
    </div>
    <input type="hidden" name="model" id="model" value="{{ ucfirst($config['model']) }}">

@endsection

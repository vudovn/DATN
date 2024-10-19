@extends('admin.layout')

@section('template')

    <x-breadcrumb :breadcrumb="$config['breadcrumb']" /> 

    <div class="card">
        <div class="card-header pb-0">
            <x-filter :createButton="[
                'label' => 'Thêm danh mục',
                'route' => $config['model'] . '.create',
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
                            @if($category->parent_id == null)
                                <tr>
                                    <td class=""> 
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input input-checkbox checkbox-item" type="checkbox"
                                                value="{{ $category->id }}" id="customCheckbox{{ $category->id }}">
                                            <label for="customCheckbox{{ $category->id }}" class="custom-control-label"></label>
                                        </div>
                                    </td>
                                    <td>{{ $category->id }}</td>
                                    <td>
                                        <a data-fancybox="gallery" href="{{ $category->thumbnail }}">
                                            <img loading="lazy" width="80" class="rounded" src="{{ $category->thumbnail }}" alt="{{ $category->name }}">
                                        </a>
                                    </td>    
                                    <td>
                                        <span class="row-name">{{ $category->name }}</span>
                                    </td>  
                                    @if($category->is_room == 2)
                                        <td>Phòng</td>
                                    @else
                                        <td>Danh mục khác</td>
                                    @endif
                                    <td>{{ changeDateFormat($category->created_at) }}</td>                    
                                    <td class="text-center js-switch-{{ $category->id }}">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input js-switch status"
                                                id="customSwitch{{ $category->id }}" data-field="publish" data-value="{{ $category->publish }}"
                                                data-model="{{ ucfirst($config['model']) }}" data-id="{{ $category->id }}"
                                                {{ $category->publish === 1 ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="customSwitch{{ $category->id }}"></label>
                                        </div>
                                    </td>
                                    
                                    <td class="text-center table-actions">
                                        <a href="{{ route('category.edit', ['id' => $category->id]) }}" class="btn btn-sm btn-icon btn-primary">
                                            <svg class="icon  svg-icon-ti-ti-edit" data-bs-toggle="tooltip" data-bs-title="Edit" xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                                <path d="M16 5l3 3"></path>
                                            </svg>
                                        </a>
                                        <x-delete :id="$category->id" :model="ucfirst($config['model'])"/>
                                    </td>
                                </tr>
                                @foreach($category->children->whereNotNull('parent_id') as $child)
                                    @include('admin.pages.category.component.child', ['child' => $child, 'char' => ' |-- '])
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
        <div class="card-footer">
            {{-- {{ $categorys->links('pagination::bootstrap-4') }} --}}
        </div>
    </div>
    <input type="hidden" name="model" id="model" value="{{ ucfirst($config['model']) }}">

@endsection

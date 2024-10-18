@extends('admin.layout')

@section('template')

    <x-breadcrumb :breadcrumb="$config['breadcrumb']" />

    <div class="card">
        <div class="card-header pb-0">
            <x-filter :createButton="[
                'label' => 'Cập nhật quyền',
                'method' => 'post',
                'route' => 'user.' . $config['model'] . '.store',
            ]" :options="[
                'perpage' => generateSelect('Mỗi trang', __('general.perpage')),
                'sort' => generateSelect('Sắp xếp', __('general.sort')),
            ]" />
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Mô tả</th>
                        <th>Quyền hạn</th>
                        @foreach ($roles as $role)
                            <th class="text-center position-relative"  data-axis="{{ $role->id }}">
                                <div class="delete-custom" {{-- data-toggle="tooltip" data-placement="bottom" title="Nhấn để chỉnh sửa" --}}>
                                    <a href="{{ route('user.role.edit', $role->id) }}">{{ $role->name }}</i></a>
                                    <div class="delete-button">
                                        <x-delete :id="$role->id" :model="'Role'" :deleteAxis="'column'" />
                                    </div>
                                </div>
                            </th>
                        @endforeach
                        {{-- <th class="text-center">Hành động</th> --}}
                        @if ($roles->count() < 5)
                            <th>
                                <a href="{{ route('user.role.create') }}"><i class="fa fa-plus"></i></a>
                            </th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @if (isset($permissions) && count($permissions))
                        @foreach ($permissions as $permission)
                            <tr class="animate__animated animate__fadeInDown animate__faster">
                                <td>
                                    <x-quickUpdate :id="$permission->id" :value="$permission->description" :model="ucfirst($config['model'])"
                                        :name="'description'" />
                                </td>
                                <td>
                                    <span class="row-name">{{ $permission->name }}</span>
                                </td>
                                @foreach ($roles as $role)
                                    <td class="text-center" data-axis="{{ $role->id }}">
                                        <div class="custom-control custom-checkbox">
                                            <input
                                                class="permission_to_role custom-control-input input-checkbox checkbox-item"
                                                type="checkbox" value="" data-roleId="{{ $role->id }}"
                                                data-permissionName="{{ $permission->name }}"
                                                id="permission_role{{ $permission->id }}{{ $role->id }}"
                                                {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                            <label for="permission_role{{ $permission->id }}{{ $role->id }}"
                                                class="custom-control-label"></label>
                                        </div>
                                        {{-- <input class=" disabled" type="checkbox" value=""
                                            data-roleId="{{ $role->id }}" data-permissionName="{{ $permission->name }}"
                                            id="permission_to_role"
                                            is_checked = "{{ $role->hasPermissionTo($permission->name) ? 'checked' : 'nochecked' }}"
                                            {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }} /> --}}
                                    </td>
                                @endforeach
                                @if ($roles->count() < 5)
                                    <td>
                                    </td>
                                @endif
                                {{-- <td class="text-center table-actions">
                                    <a href="{{ route('permission.edit', ['id' => $permission->id]) }}"
                                        class="btn btn-sm btn-icon btn-primary">
                                        <svg class="icon  svg-icon-ti-ti-edit" data-bs-toggle="tooltip" data-bs-title="Edit"
                                            xmlns="http://www.w3.org/2000/svg" width="19" height="19"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                            <path
                                                d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z">
                                            </path>
                                            <path d="M16 5l3 3"></path>
                                        </svg>
                                    </a>
                                    <x-delete :id="$permission->id" :model="ucfirst($config['model'])" />
                                </td> --}}
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="100" class="text-center">Không có dữ liệu</td>
                        </tr>
                    @endif
                </tbody>
            </table>

        </div>
        <div class="card-footer">
            {{ $permissions->links('pagination::bootstrap-4') }}
        </div>
    </div>
    <input type="hidden" name="model" id="model" value="{{ ucfirst($config['model']) }}">

@endsection

@extends('admin.layout')

@section('template')

    <x-breadcrumb :breadcrumb="$config['breadcrumb']" />

    <div class="card">
        <div class="card-header">
            <x-filter :createButton="[
                'label' => 'Làm mới',
                'method' => 'post',
                'route' => $config['model'] . '.store',
            ]" :options="[
                // 'perpage' => generateSelect('Mỗi trang', __('general.perpage')),
                'sort' => generateSelect('Sắp xếp', __('general.sort')),
            ]" />
        </div>
        <div class="card-body">
            <div class="table-">
                <table class="table ">
                    <thead>
                        <tr>
                            <th>Mô tả</th>
                            <th>Quyền hạn</th>
                            @foreach ($roles as $role)
                                <th class="text-center position-relative" data-axis="{{ $role->id }}">
                                    <div class="delete-custom">
                                        <a class="text-primary" href="#">{{ $role->name }}</i></a>
                                        <div class="delete-button">
                                            <ul class="list-inline me-auto mb-0">
                                                @if ($role->name !== 'Super Admin')
                                                    @can('Permission edit')
                                                        <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                                            title="Chỉnh sửa">
                                                            <a href="{{ route('role.edit', $role->id) }}"
                                                                class="avtar avtar-xs btn-link-success btn-pc-default">
                                                                <i class="ti ti-edit-circle f-18"></i>
                                                            </a>
                                                        </li>
                                                    @endcan
                                                    <x-delete :id="$role->id" :model="'Role'" :deleteAxis="'column'" />
                                            </ul>
                            @endif
            </div>
        </div>
        </th>
        @endforeach
        {{-- <th class="text-center">Hành động</th> --}}
        @if ($roles->count() < 5)
            <th>
                <a href="{{ route('role.create') }}"><i class="fa fa-plus"></i></a>
            </th>
        @endif
        </tr>
        </thead>
        <tbody>
            @if (isset($permissions) && count($permissions))
                @foreach ($permissions as $permission)
                    <tr class="animate__animated animate__fadeInDown animate__faster">
                        <td>
                            <x-quickUpdate :id="$permission->id" :value="$permission->description" :model="ucfirst($config['model'])" :name="'description'" />
                        </td>
                        <td>
                            <span class="row-name">{{ $permission->name }}</span>
                        </td>
                        @foreach ($roles as $role)
                            <td class="text-center " data-axis="{{ $role->id }}">
                                <div class="form-check d-flex justify-content-center">
                                    <input
                                        class="permission_to_role form-check-input input-primary input-checkbox checkbox-item"
                                        type="checkbox" data-roleId="{{ $role->id }}"
                                        data-permissionName="{{ $permission->name }}"
                                        id="permission_role{{ $permission->id }}{{ $role->id }}"
                                        {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}
                                        {{ $role->name == 'Super Admin' ? 'checked disabled' : '' }}>
                                    <label
                                        class="form-check-label"for="permission_role{{ $permission->id }}{{ $role->id }}"></label>
                                </div>
                            </td>
                        @endforeach
                        @if ($roles->count() < 5)
                            <td>
                            </td>
                        @endif
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

    </div>
    <div class="card-footer">
        {{ $permissions->links('pagination::bootstrap-4') }}
    </div>
    </div>
    <input type="hidden" name="model" id="model" value="{{ ucfirst($config['model']) }}">

@endsection

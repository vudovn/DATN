@extends('admin.layout')

@section('template')

    <x-breadcrumb :breadcrumb="$config['breadcrumb']" />

    <div class="card">
        <div class="card-header pb-0">
            <x-filter :createButton="[
                'label' => 'Thêm thành viên',
                'route' => $config['model'] . '.create',
            ]" :options="[
                'actions' => generateSelect('Hành động', __('general.actions')),
                'perpage' => generateSelect('Mỗi trang', __('general.perpage')),
                'user_catalogue_id' => generateSelect('Vai trò', $userCatalogues),
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
                        <th>Tên</th>
                        <th>Email</th>
                        <th>Ngày tạo</th>
                        <th class="text-center">Vai trò</th>
                        <th class="text-center">Trạng thái</th>
                        <th class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($users) && count($users))
                        @foreach ($users as $user)
                            <tr>
                                <td class=""> 
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input input-checkbox checkbox-item" type="checkbox"
                                            value="{{ $user->id }}" id="customCheckbox{{ $user->id }}">
                                        <label for="customCheckbox{{ $user->id }}" class="custom-control-label"></label>
                                    </div>
                                </td>
                                <td>{{ $user->id }}</td>
                                <td>
                                    <span class="row-name">{{ $user->name }}</span>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>{{ changeDateFormat($user->created_at) }}</td>
                                <td class="text-center">-</td>
                                <td class="text-center">
                                    <x-switchvip :value="$user" :model="ucfirst($config['model'])"/>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('user.edit', ['id' => $user->id]) }}" class="btn btn-sm btn-success">
                                        <i class="bi bi-pen"></i></a>
                                    <x-delete :id="$user->id" :model="ucfirst($config['model'])" />
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
            {{ $users->links('pagination::bootstrap-4') }}
        </div>
    </div>
    <input type="hidden" name="model" id="model" value="{{ ucfirst($config['model']) }}">

@endsection

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
                // 'roles' => generateSelect('Vai trò', $roles),
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
                            <th>Hỉnh ảnh</th>
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
                                <tr class="animate__animated animate__fadeInDown animate__faster ">
                                    <td class="">
                                        @if ($user->id != auth()->id())
                                            <div class="form-check">
                                                <input class="form-check-input input-primary input-checkbox checkbox-item"
                                                    type="checkbox" id="customCheckbox{{ $user->id }}"
                                                    value="{{ $user->id }}">
                                                <label class="form-check-label"
                                                    for="ustomCheckbox{{ $user->id }}"></label>
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{ $user->id }}</td>
                                    <td>
                                        <a href="{{ $user->avatar }}" data-fancybox="gallery">
                                            <img loading="lazy" width="50" class="rounded" src="{{ $user->avatar }}"
                                                alt="{{ $user->name }}">
                                        </a>
                                    </td>

                                    <td>
                                        <div class="row-name text-primary">{{ $user->name }}</div>
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ changeDateFormat($user->created_at) }}</td>
                                    <td class="text-center">
                                        <div class="d-flex flex-wrap gap-2 justify-content-center">
                                            @foreach ($user->getRoleNames() as $role)
                                                <span class="badge bg-light-primary">{{ $role }}</span>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        @if ($user->id != auth()->id())
                                            <x-switchvip :value="$user" :model="ucfirst($config['model'])" />
                                        @else
                                            <span class="badge bg-light-primary">-</span>
                                        @endif
                                    </td>
                                    <td class="text-center table-actions">
                                        <ul class="list-inline me-auto mb-0">
                                            <li class="list-inline-item align-bottom" data-bs-toggle="tooltip"
                                                title="Chỉnh sửa">
                                                <a href="{{ route('user.edit', ['id' => $user->id, 'page' => request()->get('page', 1)]) }}"
                                                    class="avtar avtar-xs btn-link-success btn-pc-default">
                                                    <i class="ti ti-edit-circle f-18"></i>
                                                </a>
                                            </li>
                                            @if (auth()->user()->can(['User delete']))
                                                @if ($user->id != auth()->id())
                                                    <x-delete :id="$user->id" :model="ucfirst($config['model'])" />
                                                @endif
                                            @endif
                                        </ul>
                                    </td>
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
            {{ $users->links('pagination::bootstrap-4') }}
        </div>
    </div>
    <input type="hidden" name="model" id="model" value="{{ ucfirst($config['model']) }}">

@endsection

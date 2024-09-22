@extends('backend.layout')

@section('template')
    
    <x-breadcrumb :breadcrumb="$config['breadcrumb']" />

    <div class="ibox float-e-margins mt-20">
        <div class="ibox-title">
            <h5>USER LIST </h5>
        </div>
        <div class="ibox-content">

            <x-filter 
                :createButton="[
                    'label' => 'Add New User',
                    'route' => $config['model'].'.create'
                ]"

                :options="[
                    'actions' => generateSelect('Choose Action', __('general.actions')),
                    'perpage' => generateSelect('Perpage', __('general.perpage')),
                    'user_catalogue_id' => generateSelect('Role', $userCatalogues),
                    'publish' => generateSelect('Status', __('general.publish')),
                    'sort' => generateSelect('Sort By', __('general.sort'))
                ]"


            />

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" value="" id="checkAll" class="input-checkbox"> 
                        </th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th class="text-center">Role</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    </thead>
                <tbody>
                    @if(isset($users) && count($users))
                        @foreach($users as $user)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $user->id }}" class="input-checkbox checkbox-item">
                            </td>
                            <td>{{ $user->id }}</td>
                            <td>
                                <span class="row-name">{{ $user->name }}</span>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->address }}</td>
                            <td class="text-center">-</td>
                            <td class="text-center js-switch-{{ $user->id }}">
                                <input 
                                    type="checkbox"
                                    class="js-switch status"
                                    data-field="publish"
                                    data-value="{{ $user->publish }}"
                                    data-model="{{ ucfirst($config['model']) }}"
                                    data-id="{{ $user->id }}"
                                    {{ ($user->publish === 2) ? 'checked'  : '' }}
                                >
                            </td>
                            <td class="text-center">
                                <a href="{{ route('user.edit', ['id' => $user->id]) }}" class="btn btn-success"><i data-feather="edit" class="feather-icon"></i></a>
                                <a href="{{ route('user.delete', ['id' => $user->id]) }}" class="btn btn-danger"><i data-feather="trash-2" class="feather-icon"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            {{ $users->links('pagination::bootstrap-4') }}
        </div>
    </div>
    <input type="hidden" name="model" id="model" value="{{ ucfirst($config['model']) }}">

@endsection


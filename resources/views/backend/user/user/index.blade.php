@extends('backend.layout')

@section('template')
    
    <x-breadcrumb :breadcrumb="$config['breadcrumb']" />

    <div class="ibox float-e-margins mt-20">
        <div class="ibox-title">
            <h5>USER LIST </h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-wrench"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="#">Config option 1</a>
                    </li>
                    <li><a href="#">Config option 2</a>
                    </li>
                </ul>
                <a class="close-link">
                    <i class="fa fa-times"></i>
                </a>
            </div>
        </div>
        <div class="ibox-content">

            <div class="flex flex-middle flex-between mb-10">
                <div class="fiter">Filter Here</div>
                <div class="actions flex flex-middle">
                    <a href="{{ route('user.create') }}" class="btn-action-item btn btn-danger">
                        <i class="fa fa-plus"></i>
                        Add New User
                    </a>
                </div>
            </div>

            <table class="table table-bordered">
                <thead>
                    <tr>
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
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->address }}</td>
                            <td class="text-center">-</td>
                            <td class="text-center">
                                <input 
                                    type="checkbox"
                                    class="js-switch"
                                >
                            </td>
                            <td class="text-center">
                                <a href="{{ route('user.edit', ['id' => $user->id]) }}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                <a href="" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>


            {{ $users->links('pagination::bootstrap-4') }}

        </div>
    </div>

@endsection


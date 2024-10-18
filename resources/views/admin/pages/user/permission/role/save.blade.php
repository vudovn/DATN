@extends('admin.layout')

@section('template')
    <x-breadcrumb :breadcrumb="$config['breadcrumb']" />
    <x-form :config="$config" :model="$role ?? null">
        <div class="row">
            <div class="col-xl-9">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3 gap-3">
                            <div class="col-lg-6">
                                <x-input :label="'Tên vai trò'" :name="'name'" :value="$role->name ?? ''" :require="true" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        Quyền hạn
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($permissions as $permission)
                                <div class="col-lg-4 custom-control custom-checkbox">
                                    <input class="custom-control-input input-checkbox checkbox-item" type="checkbox" name="permission[]" id="permission{{ $permission->id }}" value="{{ $permission->name }}" @if ($config['method'] === 'edit')
                                    {{$role->hasPermissionTo($permission->name) ? 'checked' : ''}}
                                    @endif>
                                    <label class="custom-control-label" for="permission{{ $permission->id }}">{{ $permission->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3">
                <x-save_back :model="'user.permission'" />
            </div>
        </div>
    </x-form>
@endsection

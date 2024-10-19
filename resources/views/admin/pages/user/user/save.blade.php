@extends('admin.layout')

@section('template')
    <x-breadcrumb :breadcrumb="$config['breadcrumb']" />
    <x-form :config="$config" :model="$user ?? null">
        <div class="row">
            <div class="col-xl-9">
                <div class="card">
                    <div class="card-header">
                        Thông tin chung
                    </div>
                    <div class="card-body">
                        <div class="alert alert-primary" role="alert">
                            <strong>Lưu ý:</strong> <span class="text-danger">(*)</span> là trường bắt buộc nhập
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <x-input :label="'Email'" :name="'email'" :value="$user->email ?? ''" :required="true" />
                            </div>
                            <div class="col-lg-6">
                                <x-input :label="'Tên đầy đủ'" :name="'name'" :value="$user->name ?? ''" :required="true" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <label for="roles[]">Chọn vai trò <span class="text-danger">*</span></label>
                                <select class="form-control select2" name="roles[]" multiple="multiple" data-placeholder="Chọn vai trò">
                                    <option value="">Chọn vai trò</option>
                                    @foreach ($roles as $key => $role)
                                        <option value="{{ $role->name }}"
                                            {{ isset($user) && $user->roles->contains('name', $role->name) ? 'selected' : '' }}
                                            {{ in_array($role->name, old('roles') ?? []) ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('roles')
                                    <small class="error text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <x-input :label="'Số điện thoại'" :name="'phone'" :value="$user->phone ?? ''" :required="true" />
                            </div>
                        </div>
                        @if (isset($config['method']) && $config['method'] !== 'edit')
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <x-input :label="'Mật khẩu'" :name="'password'" :value="''" :required="true"
                                        :type="'password'" />
                                </div>
                                <div class="col-lg-6">
                                    <x-input :label="'Mật khẩu xác nhận'" :name="'re_password'"  :required="true"
                                        :type="'password'" />
                                </div>
                            </div>
                        @endif

                        @include('admin.pages.user.user.components.location')
                        <div class="col-lg-12">
                            <x-input :label="'Địa chỉ cụ thể'" :name="'address'" :value="$user->address ?? ''" :required="false" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3">
                <x-save_back :model="$config['model']" />
                <x-thumbnail :label="'Ảnh đại diện'" :name="'avatar'" :value="$user->avatar ?? '/uploads/system/no_img.jpg'" />
                <x-publish :label="'Trạng thái'" :name="'publish'" :option="__('general.active')" :value="$user->publish ?? ''" />
            </div>
        </div>
        <input type="hidden" name="page" value="{{ request()->get('page', 1) }}" />
    </x-form>
@endsection

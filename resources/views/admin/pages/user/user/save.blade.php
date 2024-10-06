@extends('admin.layout')

@section('template')
    <x-breadcrumb :breadcrumb="$config['breadcrumb']" />
    <x-form :config="$config" :model="$user ?? null">
        <div class="mt-20">
            <div class="row">
                <div class="col-lg-4">
                    <div class="panel-body">
                        <h2>Thông tin chung</h2>
                        <p class="text-14">- Nhập thông tin chung của người dùng</p>
                        <p class="text-14">- Lưu ý: Trường có dấu <span class="text-danger">(*)</span> là bắt buộc </p>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="ibox">
                        <div class="ibox-content">
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <x-input :label="'Email'" :name="'email'" :value="$user->email ?? ''" :require="true" />
                                </div>
                                <div class="col-lg-6">
                                    <x-input :label="'Tên đầy đủ'" :name="'name'" :value="$user->name ?? ''" :require="true" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <x-select :name="'user_catalogue_id'" :options="$userCatalogues" :root="'Chọn vai trò'" :label="'Vai trò'" :value="$user->user_catalogue_id ?? 0" />
                                </div>
                                <div class="col-lg-6">
                                    <x-input :label="'Số điện thoại'" :name="'phone'" :value="$user->phone ?? ''" :require="true" />
                                </div>
                            </div>
                            @if(isset($config['method']) && $config['method'] !== 'edit' )
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <x-input :label="'Mật khẩu'" :name="'password'" :value="''" :require="true" :type="'password'" />
                                </div>
                                <div class="col-lg-6">
                                    <x-input :label="'Mật khẩu xác nhận'" :name="'re_password'" :value="''" :require="true" :type="'password'" />
                                </div>
                            </div>
                            @endif
                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <x-input :label="'Địa chỉ'" :name="'address'" :value="$user->address ?? ''"/>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <x-input :label="'Image'" :name="'image'" :value="$user->image ?? ''" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-left mb-15">
                        <x-button 
                            :label="'Save'" 
                            :class="'btn-success'" 
                        />
                    </div>
                </div>
            </div>
        </div>
    </x-form>
@endsection
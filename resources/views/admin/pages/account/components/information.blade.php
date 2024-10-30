@extends('admin.pages.account.index')
@section('information')
    <form method="post" action="{{ route('user.updateInformation') }}">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-header">
                Thông tin chung
            </div>
            <div class="row">
                <div class="card-body col-xl-4">
                    <x-thumbnail :label="'Ảnh đại diện'" :name="'avatar'" :value="$user->avatar ?? '/uploads/system/no_img.jpg'" />

                </div>
                <div class="card-body col-xl-8">
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
                            <x-input :label="'Số điện thoại'" :name="'phone'" :value="$user->phone ?? ''" :required="true" />
                        </div>
                        <div class="col-lg-6">
                            <label for="">Vai trò</label>
                            @php
                                $roleName = $user->roles->pluck('name')->first();
                            @endphp
                            <input type="text" class="form-control text-start" name="roles[]" value="{{ $roleName }}"
                                disabled>
                            <input type="hidden" name="roles[]" value="{{ $roleName }}">

                        </div>
                    </div>
                    @if (isset($config['method']) && $config['method'] !== 'edit')
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <x-input :label="'Mật khẩu'" :name="'password'" :value="''" :required="true"
                                    :type="'password'" />
                            </div>
                            <div class="col-lg-6">
                                <x-input :label="'Mật khẩu xác nhận'" :name="'re_password'" :required="true" :type="'password'" />
                            </div>
                        </div>
                    @endif
                    @include('admin.pages.user.components.location')
                    <div class="col-lg-12">
                        <x-input :label="'Địa chỉ cụ thể'" :name="'address'" :value="$user->address ?? ''" :required="false" />
                    </div>
                    <div class="text-end" style="gap: 5%">
                        <button type="submit" name="send" value="send"
                            class="btn btn-primary d-inline-flex justify-content-center" style="flex: 1">
                            <i data-feather="check-circle" class="me-1"></i>
                            Lưu
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

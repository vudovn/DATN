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
                                <select class="form-control js-choice-multiple" name="roles[]" multiple="multiple">
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
                                    <x-input :label="'Mật khẩu xác nhận'" :name="'re_password'" :required="true" :type="'password'" />
                                </div>
                            </div>
                        @endif

                        @include('admin.pages.user.components.location')
                        <div class="col-lg-12">
                            <x-input :label="'Địa chỉ cụ thể'" :name="'address'" :value="$user->address ?? ''" :required="false" />
                        </div>
                    </div>
                </div>

                @if (isset($config['method']) && $config['method'] == 'edit')
                    <div class="card">
                        <div class="card-header">
                            Danh sách sản phẩm yêu thích
                        </div>
                        <div class="card-body p-0">
                            <table class="table text-center mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Sản phẩm</th>
                                        <th scope="col">Ngày tạo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($user->wishlists) && count($user->wishlists))
                                        @foreach ($user->wishlists as $wishlist)
                                            <tr>
                                                <th scope="row">{{ $wishlist->id }}</th>
                                                <td>{{ $wishlist->product->name ?? 'Sản phẩm không tồn tại' }}</td>
                                                <td>{{ $wishlist->created_at ? $wishlist->created_at->format('d/m/Y') : 'Không có ngày tạo' }}
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
                    <div class="card">
                        <div class="card-header">
                            Danh sách đơn hàng
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table text-center mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Mã đơn hàng</th>
                                            <th>Tổng tiền</th>
                                            <th>Trạng thái</th>
                                            <th>Phương thức thanh toán</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($users->orders) && count($users->orders))
                                            @foreach ($user->orders as $order)
                                                <tr>
                                                    <th>{{ $order->id }}</th>
                                                    <td><a
                                                            href="{{ route('order.edit', $order->id) }}">{{ $order->code }}</a>
                                                    </td>
                                                    <td>{{ number_format($order->total, 0, ',', '.') }} VND</td>
                                                    <td>{{ statusOrder($order->status) }}</td>
                                                    <td>{{ $order->payment ? $order->payment->method_name : 'Chưa có phương thức thanh toán' }}
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
                    </div>
                @endif


            </div>

            <div class="col-xl-3">
                <x-save_back :model="$config['model']" />
                <x-thumbnail :label="'Ảnh đại diện'" :name="'avatar'" :value="$user->avatar ?? 'https://placehold.co/600x600?text=The%20Gioi%20\nNoi%20That'" />
                <x-publish :label="'Trạng thái'" :name="'publish'" :option="__('general.active')" :value="$user->publish ?? ''" />
            </div>


        </div>
        <input type="hidden" name="page" value="{{ request()->get('page', 1) }}" />
    </x-form>
@endsection

@extends('admin.layout')

@section('template')
    <x-breadcrumb :breadcrumb="$config['breadcrumb']" />
        <div class="row">
            <div class="col-xl-9">
                @yield('information')
            </div>
            <div class="col-xl-3">
                <div class="card">
                    <div class="card-header">
                        <svg class="pc-icon">
                            <use xlink:href="#custom-profile-2user-outline"></use>
                        </svg> Tài khoản
                    </div>
                    <div class="card-body p-1">
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <a class="btn btn-link {{ request()->routeIs('user.information') ? '' : 'text-secondary' }}"
                                    href="{{ route('user.information') }}">
                                    Hồ sơ
                                </a>
                            </div>
                            <div class="col-lg-12">
                                <a class="btn btn-link {{ request()->routeIs('user.changePassword') ? '' : 'text-secondary' }}"
                                    href="{{ route('user.changePassword') }}">
                                    Đổi mật khẩu
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

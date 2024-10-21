@extends('admin.layout')


@section('template')
    <x-breadcrumb :breadcrumb="$config['breadcrumb']" />
    <div class="row">
        <div class="col-12">
            <div class="card welcome-banner bg-blue-800">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="p-4">
                                <h2 class="text-white">Thế Giới Nội Thất </h2>
                                <p class="text-white"> The Brand new User Interface with power of Bootstrap Components.
                                    Explore the Endless possibilities with Able Pro. </p>
                                <a href="#" class="btn btn-outline-light">Demo</a>
                            </div>
                        </div>
                        <div class="col-sm-6 text-center">
                            <div class="img-welcome-banner">
                                <img src="https://ableproadmin.com/assets/images/widget/welcome-banner.png" alt="img"
                                    class="img-fluid" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-3 row">
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <div
                                class="bg-green-200 text-primary rounded d-flex align-items-center p-3 justify-content-center">
                                <i class="ti ti-user" style="font-size: 1.875rem !important;"></i>
                            </div>
                        </div>
                        <div class="col-9 d-flex align-items-center justify-content-end text-end">
                            <div>
                                <h4 class="card-title">750$</h4>
                                <h6 class="card-subtitle mb-0">Hằng tuần</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <div
                                class="bg-danger-subtle text-danger rounded d-flex align-items-center p-3 justify-content-center">
                                <i class="ti ti-chart-pie" style="font-size: 1.875rem !important;"></i>
                            </div>
                        </div>
                        <div class="col-9 d-flex align-items-center justify-content-end text-end">
                            <div>
                                <h4 class="card-title">750$</h4>
                                <h6 class="card-subtitle mb-0">Hằng tuần</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <div
                                class="bg-warning-subtle text-warning rounded d-flex align-items-center p-3 justify-content-center">
                                <i class="ti ti-box" style="font-size: 1.875rem !important;"></i>
                            </div>
                        </div>
                        <div class="col-9 d-flex align-items-center justify-content-end text-end">
                            <div>
                                <h4 class="card-title">750</h4>
                                <h6 class="card-subtitle mb-0">Hằng tuần</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <div
                                class="bg-secondary-subtle text-secondary rounded d-flex align-items-center p-3 justify-content-center">
                                <i class="ti ti-currency-dollar" style="font-size: 1.875rem !important;"></i>
                            </div>
                        </div>
                        <div class="col-9 d-flex align-items-center justify-content-end text-end">
                            <div>
                                <h4 class="card-title">750$</h4>
                                <h6 class="card-subtitle mb-0">Hằng tuần</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

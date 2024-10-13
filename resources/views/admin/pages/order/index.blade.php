@extends('admin.layout')

@section('template')
    <x-breadcrumb :breadcrumb="$config['breadcrumb']" />
    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input input-checkbox" type="checkbox" id="checkAll">
                                <label for="checkAll" class="custom-control-label"></label>
                            </div>
                        </th>
                        <th>ID</th>
                        <th>Tổng Tiền</th>
                        <th>Phương Thức Thanh Toán</th>
                        <th>Trạng Thái</th>
                        <th>Ngày Tạo</th>
                        <th class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($orders) && count($orders))
                        @foreach ($orders as $order)
                            <tr class="animate__animated animate__fadeInDown animate__faster">
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input input-checkbox checkbox-item" type="checkbox"
                                            value="{{ $order->id }}" id="customCheckbox{{ $order->id }}">
                                        <label for="customCheckbox{{ $order->id }}" class="custom-control-label"></label>
                                    </div>
                                </td>
                                <td>{{ $order->id }}</td>
                                <td>{{ number_format($order->total_amount, 0, ',', '.') }} VND</td>
                                <td>{{ $order->payment_method }}</td>
                                <td>{{ statusToVietnamese($order->status) }}</td>
                                <td>{{ changeDateFormat($order->created_at) }}</td>
                                <td class="text-center table-actions">
                                    <a href="{{ route('admin.pages.order.edit', ['id' => $order->id]) }}" class="btn btn-sm btn-icon btn-primary">
                                        <svg class="icon svg-icon-ti-ti-edit" data-bs-toggle="tooltip" data-bs-title="Edit" xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                            <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                            <path d="M16 5l3 3"></path>
                                        </svg>
                                    </a>
                                    <x-delete :id="$order->id" :model="ucfirst($config['model'])" />
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
    <input type="hidden" name="model" id="model" value="{{ ucfirst($config['model']) }}">

@endsection

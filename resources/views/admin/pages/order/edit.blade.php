@extends('admin.layout')

@section('template')
<x-breadcrumb :breadcrumb="$config['breadcrumb']" />
    <div class="card">
        <div class="card-header">
            <h4>Chỉnh sửa Đơn Hàng #{{ $order->id }}</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.pages.order.update', ['id' => $order->id]) }}" method="POST">
                @csrf
                @method('PUT') <!-- Hoặc PUT nếu bạn sử dụng phương thức PUT trong route -->
                <p>Tên khách hàng: {{$order->user->name}}</p>
                <div class="form-group">
                    <label for="total_amount">Tổng Tiền: {{ number_format($order->total_amount, 0, ',', '.') }} VND</label>
                    
                </div>

                <div class="form-group">
                    <label for="payment_method">Phương Thức Thanh Toán: <span class="text-danger"> {{ $order->payment_method ?? 'Đợi có dữ liệu bảng phương thức thanh toán' }} </span></label>
                </div>
                <div class="form-group">
                    <label for="payment_method">Địa chỉ giao hàng: <span class="text-success">{{ $order->shipping->ward->name }}, {{ $order->shipping->district->name }}, {{ $order->shipping->province->name }}</span></label>
                </div>

                <div class="form-group">
                    <label for="status">Trạng Thái</label>
                    <select name="status" id="status" class="form-control select2">
                        @foreach (__('order.status') as $key => $value)
                            <option value="{{ $key }}" {{ $order->status == $key ? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                        {{-- <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Đang chờ duyệt</option>
                        <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Đang xử lý
                        </option>
                        <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Đã giao cho đơn vị vận chuyển</option>
                        <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Đã giao xong
                        </option>
                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Đã hủy</option> --}}

                    </select>
                </div>

                <h5 class="mt-4">Chi tiết Đơn Hàng</h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên Sản Phẩm</th>
                            <th>Số Lượng</th>
                            <th>Tổng Tiền</th>
                            <th>Ngày Tạo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order_details as $detail)
                            <tr>
                                <td>{{ $detail->id }}</td>
                                <td>{{ $detail->product->name }}</td>
                                <td>{{ $detail->quantity }}</td>
                                <td>{{ number_format($detail->product->price * $detail->quantity) }} VND</td>
                                <td>{{ changeDateFormat($detail->created_at) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="text-right">
                    <a href="{{ route('admin.pages.order.index') }}" class="btn btn-danger">Quay lại</a>
                    <button type="submit" class="btn btn-primary">
                        Cập nhật
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

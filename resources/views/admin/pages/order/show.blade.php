@extends('admin.layout')

@section('template')
    <x-breadcrumb :breadcrumb="$config['breadcrumb']" />
    <div class="card border-primary">
        <div class="card-header bg-light-primary text-white text-center p-3">
            <h2>HÓA ĐƠN BÁN HÀNG</h2>
        </div>
        <div class="card-body">
            <div class="text-center mb-4">
                <p class="font-weight-bold text-uppercase mb-0">Công Ty TNHH Thế Giới Nội Thất</p>
                <p class="mb-0 text-secondary">Mã số thuế (Tax code): 0312157574</p>
                <p class="mb-0 text-secondary">Địa chỉ: 72 Nguyễn Thị Thập, Liên Chiểu, Đà Nẽng, Việt Nam</p>
                <p class="mb-0 text-secondary">Điện thoại: +(84) 878 006 779</p>
            </div>
    
            <div class="d-flex justify-content-end text-primary mb-4">
                <div>
                    <p>Ngày: <span class="font-weight-bold">23 tháng 06 năm 2022</span></p>
                </div>
            </div>
    
            <div class="row mb-4">
                <div class="col-6">
                    <h6 class="text-primary">Thông tin người mua hàng (Buyer):</h6>
                    <p class="mb-1"><strong>Họ & Tên:</strong> {{ $order->name }}</p>
                    <p class="mb-1"><strong>Địa chỉ:</strong> {{ $order->address }}, {{$order->ward->name}}, {{$order->district->name}}, {{$order->province->name}}</p>
                    <p class="mb-1"><strong>Hình thức thanh toán:</strong> {{ $order->payment_method }}</p>
                </div>
                <div class="col-6 text-right">
                    <h6 class="text-primary">Thông tin thanh toán</h6>
                    <p class="mb-1"><strong>Tài khoản ngân hàng:</strong> Ngân Hàng TMCP Ngoại Thương Việt Nam</p>
                </div>
            </div>
    
            <h5 class="mt-4 text-primary">Chi tiết Đơn Hàng</h5>
            <table class="table table-bordered text-center">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>STT</th>
                        <th>Tên hàng hóa, dịch vụ</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order_details as $index => $detail)
                        @php
                            $lineTotal = $detail->product->price * $detail->quantity;
                        @endphp
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $detail->name }}</td>
                            <td>{{ $detail->quantity }}</td>
                            <td>{{ formatMoney($detail->product->price) }}</td>
                            <td>{{ formatMoney($lineTotal) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    
            <div class="row">
                <div class="col-6">
                    {{-- <p class="text-primary"><strong>Tỷ giá quy đổi:</strong> 1 USD = 23,080 VND</p> --}}
                </div>
                <div class="col-6 text-right">
                    <p><strong>Tổng tiền hàng:</strong> {{ formatMoney($order->total) }}</p>
                    <p><strong>% thuế GTGT:</strong> 2%</p>
                    <p><strong>Tiền thuế GTGT:</strong> {{ formatMoney($order->total * 2 / 100) }}</p>
                    <p class="font-weight-bold text-primary"><strong>Tổng tiền thanh toán : {{ formatMoney($order->total - ($order->total * 2 / 100)) }}</strong></p>
                    <p class="font-italic text-secondary">Số tiền viết bằng chữ: .....</p>
                </div>
            </div>
    
            <div class="row mt-5">
                <div class="col-6 text-center">
                    <p class="text-primary font-weight-bold">Người mua hàng</p>
                    <p>(Ký, ghi rõ họ, tên)</p>
                </div>
                <div class="col-6 text-center">
                    <p class="text-primary font-weight-bold">Người bán hàng</p>
                    <p>(Ký, ghi rõ họ, tên)</p>
                </div>
            </div>
    
        </div>
        <div class="card-footer">
            <div class="text-end">
                <a href="{{ route('order.index') }}" class="btn btn-outline-danger">Quay lại</a>
                <button type="button" class="btn btn-primary" onclick="window.print()">In hóa đơn</button>
            </div>
        </div>
    </div>
    
    <script src="https://unpkg.com/jspdf-invoice-template@1.4.0/dist/index.js"></script>

    <style>
        @media print {
            body * {
                visibility: hidden;
            }

            .card.border-primary, .card.border-primary * {
                visibility: visible;
            }

            .card.border-primary {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }

            .card-footer {
                display: none;
            }
        }
    </style>
@endsection

@extends('admin.layout')


@section('template')
    @php
        // order
        $totalCompletedOrder = $statistic['completed_orders'];
        $totalCancelOrder = $statistic['cancelled_orders'];
        $orderMonth = $statistic['current_month_completed'];
        $orderGrowthRate = growthRate($statistic['current_month_completed'], $statistic['previous_month_completed']);
        // doanh thu
        $revenueMonth = $statistic['current_month_revenue'];
        $revenueGrowthRate = growthRate($statistic['current_month_revenue'], $statistic['previous_month_revenue']);

    @endphp
    <x-breadcrumb :breadcrumb="$config['breadcrumb']" />
    <div class="row">
        @include('admin.pages.dashboard.components.box')
        {{-- Biểu đồ --}}
        @include('admin.pages.dashboard.components.chart')
    </div>
@endsection

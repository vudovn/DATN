@props(['breadcrumb'])
<div class="row wrapper border-bottom white-bg page-heading mb-3 pt-3">
    <div class="col-lg-12">
        <h3>{{ $breadcrumb['name'] }}</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard.index') }}">Dashboard</a>
            </li>
            @foreach ($breadcrumb['list'] as $key => $val)
                <li class="breadcrumb-item">
                    {{ $val }}
                </li>
            @endforeach
        </ol>
    </div>
</div>

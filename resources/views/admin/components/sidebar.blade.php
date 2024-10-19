@php
    $segment = request()->segment(1); //dd ra là biết ngay
    $segmentUrl = url()->current(); //Như trên :v
@endphp

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('dashboard.index') }}" class="brand-link">
        <img src="https://adminlte.io/themes/v3/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ env('CMS_NAME') }}</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Adu Hacker!</a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">             
                <li class="nav-item">
                    <a href="{{ route('dashboard.index') }}" class="nav-link {{ $segment == cutUrl(route('dashboard.index')) ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-grid-horizontal"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @foreach (__('sidebar.function') as $key => $val)
                    <li class="nav-item {{ (in_array($segment, $val['route'])) ? 'menu-open active' : '' }}">
                        <a href="#" class="nav-link {{ (in_array($segment, $val['route'])) ? 'active' : '' }}">
                            {!! $val['icon'] !!}
                            <p>
                                {{ $val['name'] }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        @can('Dashboard index')
                        @if (count($val['module']))
                            <ul class="nav nav-treeview">
                                @foreach ($val['module'] as $module)
                                    <li class="nav-item">
                                        <a href="{{ $module['path'] }}" class="nav-link {{ $segmentUrl == $module['path'] ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>{{ $module['name'] }}</p>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                        @endcan
                    </li>
                @endforeach

                {{-- <li class="nav-item menu-open"> 
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            User
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('user.index') }}" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="index2.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard v2</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}


                {{-- <li class="nav-item">
                    <a href="pages/widgets.html" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Widgets
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li> --}}
                <li class="nav-header">EXAMPLES</li>

            </ul>
        </nav>

    </div>

</aside>

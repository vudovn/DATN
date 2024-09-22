@php
    $segment = request()->segment(1);
@endphp

<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            @foreach(__('sidebar.function') as $key => $val)
                <li class="{{ (in_array($segment, $val['route'])) ? 'active' : '' }}">
                    <a href="" class="flex flex-middle sidebar-a">
                        {!! $val['icon'] !!}
                        <span class="nav-label">{{ $val['name'] }}</span> 
                        {!! (count($val['module'])) ? '<span class="fa arrow"></span>' : '' !!}
                    </a>
                    @if(count($val['module']))
                        <ul class="nav nav-second-level">
                            @foreach($val['module'] as $module)
                            <li><a href="{{ $module['path'] }}">{{ $module['name'] }}</a></li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>

    </div>
</nav>
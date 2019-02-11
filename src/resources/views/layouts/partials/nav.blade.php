<ul class="nav-main">
    <li>
        <a class="{{ request()->is('dashboard') ? ' active' : '' }}" href="/dashboard">
            <i class="si si-cup"></i><span class="sidebar-mini-hide">Dashboard</span>
        </a>
    </li>
    <li class="nav-main-heading">
        <span class="sidebar-mini-visible">-</span><span class="sidebar-mini-hidden">{{ __('Management') }}</span>
    </li>
    @php
    $dPCruds = array_diff(scandir(base_path('cruds')), ['.', '..']);
    @endphp
    @foreach($dPCruds as $dPCrud)
        @php
        $dPCrud = explode('.', $dPCrud)[0];
        $namespacedDpModel = 'App\\Models\\' . $dPCrud;
        @endphp
        @can('view', $namespacedDpModel)
            <li>
                <a class="{{ request()->is('admin/' . strtolower($dPCrud) . '*') ? ' active' : '' }}" href="{{ route('admin.'  . strtolower($dPCrud) . '.index', [$locale]) }}">
                    <i class="si si-users"></i><span class="sidebar-mini-hide">{{ __($dPCrud . 's') }}</span>
                </a>
            </li>
        @endcan
    @endforeach

    <li class="nav-main-heading">
        <span class="sidebar-mini-visible">VR</span><span class="sidebar-mini-hidden">Various</span>
    </li>
    <li class="{{ request()->is('examples/*') ? ' open' : '' }}">
        <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-bulb"></i><span
                    class="sidebar-mini-hide">Examples</span></a>
        <ul>
            <li>
                <a class="{{ request()->is('examples/plugin') ? ' active' : '' }}" href="/examples/plugin">Plugin</a>
            </li>
            <li>
                <a class="{{ request()->is('examples/blank') ? ' active' : '' }}" href="/examples/blank">Blank</a>
            </li>
        </ul>
    </li>
</ul>

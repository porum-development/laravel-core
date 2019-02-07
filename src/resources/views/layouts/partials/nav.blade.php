<ul class="nav-main">
    <li>
        <a class="{{ request()->is('dashboard') ? ' active' : '' }}" href="/dashboard">
            <i class="si si-cup"></i><span class="sidebar-mini-hide">Dashboard</span>
        </a>
    </li>
    @can('view', \App\Models\User::class)
    <li>
        <a class="{{ request()->is('admin/user*') ? ' active' : '' }}" href="{{ route('admin.user.index') }}">
            <i class="si si-users"></i><span class="sidebar-mini-hide">{{ __('Users') }}</span>
        </a>
    </li>
    @endcan
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
    <li class="nav-main-heading">
        <span class="sidebar-mini-visible">MR</span><span class="sidebar-mini-hidden">More</span>
    </li>
    <li>
        <a href="/">
            <i class="si si-globe"></i><span class="sidebar-mini-hide">Landing</span>
        </a>
    </li>
</ul>
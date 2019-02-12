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
        $tempCrud = explode('.', $dPCrud)[0];
        $namespacedDpModel = 'App\\Models\\' . $tempCrud;
        @endphp
        @can('view', $namespacedDpModel)
            <li>
                <a class="{{ request()->is('admin/' . strtolower($tempCrud) . '*') ? ' active' : '' }}" href="{{ route('admin.'  . strtolower($tempCrud) . '.index', [$locale]) }}">
                    <i class="{{ __(strtolower($tempCrud) . '_icon') }}"></i><span class="sidebar-mini-hide">{{ __($tempCrud . 's') }}</span>
                </a>
            </li>
        @endcan
    @endforeach
</ul>

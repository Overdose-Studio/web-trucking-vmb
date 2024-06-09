<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    {{-- Dashboard --}}
    <li class="nav-item">
        <a href="{{ route('dashboard') }}"
            class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
            <i class="nav-icon fas fa-house"></i>
            <p>Dashboard</p>
        </a>
    </li>

    {{-- Operation --}}
    <li class="nav-item">
        <a href="{{ route('truck.index') }}" class="nav-link {{ request()->is('dashboard/truck*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-truck"></i>
            <p>Truck</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('dtp.index') }}" class="nav-link {{ request()->is('dashboard/dtp*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-p"></i>
            <p>DTP</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('dta.index') }}" class="nav-link {{ request()->is('dashboard/dta*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-a"></i>
            <p>DTA</p>
        </a>
    </li>
</ul>

<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    {{-- Dashboard --}}
    <li class="nav-item">
        <a href="{{ route('dashboard') }}"
            class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
            <i class="nav-icon fas fa-house"></i>
            <p>Dashboard</p>
        </a>
    </li>

    {{-- Trucking --}}
    <li class="nav-item">
        <a href="{{ route('driver.index') }}" class="nav-link {{ request()->is('dashboard/driver*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-screwdriver-wrench"></i>
            <p>CRUD Driver</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('truck.index') }}" class="nav-link {{ request()->is('dashboard/truck*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-truck"></i>
            <p>CRUD Truck</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('dtp.index') }}" class="nav-link {{ request()->is('dashboard/dtp*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-p"></i>
            <p>CRUD DTP</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('dta.index') }}" class="nav-link {{ request()->is('dashboard/dta*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-a"></i>
            <p>CRU DTA</p>
        </a>
    </li>

    {{-- General --}}
    <li class="nav-item">
        <a href="{{ route('log.index') }}" class="nav-link {{ request()->is('dashboard/log*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-cogs"></i>
            <p>Log Order</p>
        </a>
    </li>
</ul>

<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    {{-- Dashboard --}}
    <li class="nav-item">
        <a href="{{ route('dashboard') }}"
            class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
            <i class="nav-icon fas fa-house"></i>
            <p>Dashboard</p>
        </a>
    </li>

    {{-- Admin --}}
    <li class="nav-item">
        <a href="{{ route('dashboard') }}" class="nav-link">
            <i class="nav-icon fas fa-user-shield"></i>
            <p>Admin</p>
            <i class="right fas fa-angle-left"></i>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('user.index') }}" class="nav-link {{ request()->is('dashboard/user*') ? 'active' : '' }}">
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <i class="nav-icon fas fa-edit"></i>
                    <p>User Account</p>
                </a>
            </li>
        </ul>
    </li>

    {{-- Operations --}}
    <li class="nav-item">
        <a href="{{ route('dashboard') }}" class="nav-link">
            <i class="nav-icon fas fa-cogs"></i>
            <p>Operation</p>
            <i class="right fas fa-angle-left"></i>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('client.index') }}"class="nav-link {{ request()->is('dashboard/client*') ? 'active' : '' }}">
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <i class="nav-icon fas fa-person"></i>
                    <p>Client</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <i class="nav-icon fas fa-plus"></i>
                    <p>Shipment</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <i class="nav-icon fas fa-check"></i>
                    <p>Approval DTA</p>
                </a>
            </li>
        </ul>
    </li>

    {{-- Trucking --}}
    <li class="nav-item">
        <a href="{{ route('dashboard') }}" class="nav-link">
            <i class="nav-icon fas fa-truck-loading"></i>
            <p>Trucking</p>
            <i class="right fas fa-angle-left"></i>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('truck.index') }}" class="nav-link {{ request()->is('dashboard/truck*') ? 'active' : '' }}">
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <i class="nav-icon fas fa-truck"></i>
                    <p>Truck</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('dtp.index') }}" class="nav-link {{ request()->is('dashboard/dtp*') ? 'active' : '' }}">
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <i class="nav-icon fas fa-p"></i>
                    <p>DTP</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('dta.index') }}" class="nav-link {{ request()->is('dashboard/dta*') ? 'active' : '' }}">
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <i class="nav-icon fas fa-a"></i>
                    <p>DTA</p>
                </a>
            </li>
        </ul>
    </li>

    {{-- Finance --}}
    <li class="nav-item">
        <a href="{{ route('dashboard') }}" class="nav-link">
            <i class="nav-icon fas fa-money-check-alt"></i>
            <p>Finance</p>
            <i class="right fas fa-angle-left"></i>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <i class="nav-icon fas fa-check"></i>
                    <p>Approval DTP</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('bill.index') }}" class="nav-link {{ request()->is('dashboard/bill*') ? 'active' : '' }}">
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <i class="nav-icon fas fa-coins"></i>
                    <p>Bill</p>
                </a>
            </li>
        </ul>
    </li>
</ul>

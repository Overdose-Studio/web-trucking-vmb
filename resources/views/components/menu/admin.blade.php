<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    {{-- Dashboard --}}
    <li class="nav-item">
        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
            <i class="nav-icon fas fa-house"></i>
            <p>Dashboard</p>
        </a>
    </li>

    {{-- Admin --}}
    <li class="nav-item {{ request()->is('dashboard/user*') ? 'menu-is-opening menu-open' : '' }}">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user-shield"></i>
            <p>Admin</p>
            <i class="right fas fa-angle-left"></i>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('user.index') }}" class="nav-link {{ request()->is('dashboard/user*') ? 'active' : '' }}">
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <i class="nav-icon fas fa-users"></i>
                    <p>CRUD User</p>
                </a>
            </li>
        </ul>
    </li>

    {{-- Operations --}}
    <li
        class="nav-item {{ request()->is('dashboard/client*') || request()->is('dashboard/shipment*') || request()->is('dashboard/approval-dta*') ? 'menu-is-opening menu-open' : '' }}">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-cogs"></i>
            <p>Operation</p>
            <i class="right fas fa-angle-left"></i>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('client.index') }}" class="nav-link {{ request()->is('dashboard/client*') ? 'active' : '' }}">
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <i class="nav-icon fas fa-person"></i>
                    <p>CRUD Client</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('shipment.index') }}" class="nav-link {{ request()->is('dashboard/shipment*') ? 'active' : '' }}">
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <i class="nav-icon fas fa-boxes"></i>
                    <p>CRUD Order</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('dta.approval.index') }}" class="nav-link d-flex align-items-center {{ request()->is('dashboard/approval-dta*') ? 'active' : '' }}">
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <i class="nav-icon fas fa-check mr-2 ml-1"></i>
                    <p>Approve and Update DTA</p>
                </a>
            </li>
        </ul>
    </li>

    {{-- Trucking --}}
    <li class="nav-item {{ request()->is('dashboard/truck*') || request()->is('dashboard/dtp*') || request()->is('dashboard/dta*') || request()->is('dashboard/driver*') ? 'menu-is-opening menu-open' : '' }}">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa-truck-loading"></i>
            <p>Trucking</p>
            <i class="right fas fa-angle-left"></i>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('driver.index') }}" class="nav-link {{ request()->is('dashboard/driver*') ? 'active' : '' }}">
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <i class="nav-icon fas fa-screwdriver-wrench"></i>
                    <p>CRUD Driver</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('truck.index') }}" class="nav-link {{ request()->is('dashboard/truck*') ? 'active' : '' }}">
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <i class="nav-icon fas fa-truck"></i>
                    <p>CRUD Truck</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('dtp.index') }}" class="nav-link {{ request()->is('dashboard/dtp*') ? 'active' : '' }}">
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <i class="nav-icon fas fa-p"></i>
                    <p>CRUD DTP</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('dta.index') }}" class="nav-link {{ request()->is('dashboard/dta*') ? 'active' : '' }}">
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <i class="nav-icon fas fa-a"></i>
                    <p>CRU DTA</p>
                </a>
            </li>
        </ul>
    </li>

    {{-- Finance --}}
    <li class="nav-item {{ request()->is('dashboard/approval-dtp*') || request()->is('dashboard/bill*') ? 'menu-is-opening menu-open' : '' }}">
        <a href="{{ route('dashboard') }}" class="nav-link">
            <i class="nav-icon fas fa-money-check-alt"></i>
            <p>Finance</p>
            <i class="right fas fa-angle-left"></i>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{ route('dtp.approval.index') }}" class="nav-link d-flex align-items-center {{ request()->is('dashboard/approval-dtp*') ? 'active' : '' }}">
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <i class="nav-icon fas fa-check mr-2 ml-1"></i>
                    <p>Approve and Update DTP</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('bill.index') }}" class="nav-link d-flex align-items-center {{ request()->is('dashboard/bill*') ? 'active' : '' }}">
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <i class="nav-icon fas fa-coins mr-2 ml-1"></i>
                    <p>Read Selisih Uang Jalan</p>
                </a>
            </li>
        </ul>
    </li>

    {{-- General --}}
    <li class="nav-item">
        <a href="{{ route('log.index') }}" class="nav-link {{ request()->is('dashboard/log*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-cogs"></i>
            <p>Log Order</p>
        </a>
    </li>
</ul>

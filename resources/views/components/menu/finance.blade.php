<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    {{-- Dashboard --}}
    <li class="nav-item">
        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
            <i class="nav-icon fas fa-house"></i>
            <p>Dashboard</p>
        </a>
    </li>

    {{-- Finance --}}
    <li class="nav-item">
        <a href="{{ route('dtp.approval.index') }}" class="nav-link d-flex align-items-center {{ request()->is('dashboard/approval-dtp*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-check mr-2 ml-1"></i>
            <p>Approve and Update DTP</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('bill.index') }}" class="nav-link d-flex align-items-center {{ request()->is('dashboard/bill*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-coins mr-2 ml-1"></i>
            <p>Read Selisih Uang Jalan</p>
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

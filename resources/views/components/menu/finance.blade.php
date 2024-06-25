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
        <a href="{{ route('dtp.approval.index') }}" class="nav-link {{ request()->is('dashboard/approval-dtp*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-check"></i>
            <p>Approval DTP</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('bill.index') }}" class="nav-link {{ request()->is('dashboard/bill*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-coins"></i>
            <p>Bill</p>
        </a>
    </li>
</ul>

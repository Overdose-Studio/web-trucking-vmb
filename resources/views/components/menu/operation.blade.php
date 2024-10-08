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
        <a href="{{ route('client.index') }}" class="nav-link {{ request()->is('dashboard/client*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-person"></i>
            <p>CRUD Client</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('shipment.index') }}" class="nav-link {{ request()->is('dashboard/shipment*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-boxes"></i>
            <p>CRUD Order</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('dta.approval.index') }}" class="nav-link d-flex align-items-center {{ request()->is('dashboard/approval-dta*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-check mr-2 ml-1"></i>
            <p>Approve and Update DTA</p>
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

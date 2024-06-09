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
        <a href="{{ route('client.index') }}"class="nav-link {{ request()->is('dashboard/client*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-person"></i>
            <p>Client</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('dashboard') }}" class="nav-link">
            <i class="nav-icon fas fa-boxes"></i>
            <p>Shipment</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('dashboard') }}" class="nav-link">
            <i class="nav-icon fas fa-check"></i>
            <p>Approval DTA</p>
        </a>
    </li>
</ul>

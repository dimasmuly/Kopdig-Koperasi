<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin') }}">
        <div class="sidebar-brand-icon">
            <i class="fas fa-building"></i>
            <div class="sidebar-brand-text mx-3">KOPDIG</div>
        </div>
    </a>

    {{-- ADMIN --}}
    @if ($user['role_id'] == 2)
        <!-- Heading -->
        <div class="sidebar-heading mt-4">
            Admin
        </div>

        <!-- Nav Item - Tables -->
        <li class="nav-item my-0  {{ request()->routeIs('admin') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin') }}">
                <i class="fas fa-fw fa-home"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item my-0 {{ request()->routeIs('admin.administrator') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.administrator') }}">
                <i class="fas fa-fw fa-users"></i>
                <span>Administrator</span>
            </a>
        </li>
        <li class="nav-item {{ request()->routeIs('admin.market') || request()->routeIs('admin.stash') || request()->routeIs('admin.loan')  ? 'active' : '' }}">
            <a class="nav-link {{ request()->routeIs('admin.market') || request()->routeIs('admin.stash') || request()->routeIs('admin.loan')  ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Cooperatives</span>
            </a>
            <div id="collapseUtilities" class="collapse {{ request()->routeIs('admin.market') || request()->routeIs('admin.stash') || request()->routeIs('admin.loan')  ? 'show' : '' }}" aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar" style="">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Management:</h6>
                    <a class="collapse-item {{ request()->routeIs('admin.market') ? 'active' : '' }}" href="{{ route('admin.market') }}">Market</a>
                    <a class="collapse-item {{ request()->routeIs('admin.stash') ? 'active' : '' }}" href="{{ route('admin.stash') }}">Stash</a>
                    <a class="collapse-item {{ request()->routeIs('admin.loan') ? 'active' : '' }}" href="{{ route('admin.loan') }}">Loans</a>
                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <li class="nav-item">
            <a class="nav-link" data-toggle="modal" data-target="#logoutModal" href="#">
                <i class="fas fa-fw fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </li>
    @endif

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>

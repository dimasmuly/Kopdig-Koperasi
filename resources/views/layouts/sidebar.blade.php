<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('assets/images/logo-dark.png') }}" alt="" height="17">
            </span>
        </a>

        {{-- <i class="ri-record-circle-line"></i> --}}
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span>Menu</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('dashboard') ? 'text-success' : '' }}"
                        href="{{ route('dashboard') }}">
                        <i class="ri-home-line"></i> <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>

                <li class="menu-title"><i class="ri-more-fill"></i> <span>Chairman</span></li>
                @if (Auth::user()->role_id == 2 || Auth::user()->role_id == 6 || Auth::user()->role_id == 7)
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ request()->routeIs('dashboard.market*') ? 'text-success' : '' }}"
                            href="{{ route('dashboard.market') }}">
                            <i class="ri-store-line"></i> <span data-key="t-market">Market</span>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->role_id == 2 || Auth::user()->role_id == 7)
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ request()->routeIs('dashboard.order') ? 'text-success' : '' }}"
                            href="{{ route('dashboard.order') }}">
                            <i class="ri-money-dollar-circle-line"></i> <span data-key="t-order">Order</span>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->role_id == 2 || Auth::user()->role_id == 6 || Auth::user()->role_id == 7 || Auth::user()->role_id == 5)
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ request()->routeIs('dashboard.administrator') ? 'text-success' : '' }}"
                            href="{{ route('dashboard.administrator') }}">
                            <i class="ri-user-line"></i> <span data-key="t-Administrator">Administrator</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ request()->routeIs('dashboard.mails') ? 'text-success' : '' }}"
                            href="{{ route('dashboard.mails') }}">
                            <i class="ri-mail-line"></i> <span data-key="t-Administrator">Mails</span>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->role_id == 2 || Auth::user()->role_id == 6 || Auth::user()->role_id == 7)
                    <li class="nav-item">
                        <a href="#sidebarAccount"
                            class="nav-link {{ request()->routeIs('dashboard.management*') ? 'text-success collapse' : 'collapsed' }}"
                            data-bs-toggle="collapse" role="button"
                            aria-expanded="{{ request()->routeIs('dashboard.management*') ? 'true' : 'false' }}"
                            aria-controls="sidebarAccount" data-key="t-level-1.2"><i class="ri-bar-chart-box-line"></i>
                            <span data-key="t-Management">Management</span>
                        </a>
                        <div class="collapse menu-dropdown {{ request()->routeIs('dashboard.management*') ? 'show' : '' }}"
                            id="sidebarAccount">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('dashboard.management.stash') }}" class="nav-link"
                                        data-key="t-level-2.1">Stashes</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('dashboard.management.loans') }}" class="nav-link"
                                        data-key="t-level-2.1">Loans</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('dashboard.management.installment') }}" class="nav-link"
                                        data-key="t-level-2.1">Installement</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('dashboard.management.dues') }}" class="nav-link"
                                        data-key="t-level-2.1">Dues</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link menu-link" href="/logout" onclick="return(confirm('Are you sure?'))">
                        <i class="ri-logout-box-line"></i> <span data-key="t-Logout">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>

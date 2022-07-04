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

        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span>Menu</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('dashboard') }}">
                        <i class="ri-home-line"></i> <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>

                <li class="menu-title"><i class="ri-more-fill"></i> <span>Chairman</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('dashboard.market') }}">
                        <i class="ri-store-line"></i> <span data-key="t-market">Market</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('dashboard.order') }}">
                        <i class="ri-money-dollar-circle-line"></i> <span data-key="t-order">Order</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('dashboard.administrator') }}">
                        <i class="ri-user-line"></i> <span data-key="t-Administrator">Administrator</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="Setting">
                        <i class=" ri-settings-line"></i> <span data-key="t-Setting">Setting</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="/logout">
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

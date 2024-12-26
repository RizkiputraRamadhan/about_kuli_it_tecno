<aside class="left-sidebar">
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="#" class="text-nowrap logo-img">
                <img src="{{ asset('assets/logo.png') }}" width="100" alt="" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="fas fa-home nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>

                @if (auth()->user()->roles == 'ADMIN')
                    <li class="sidebar-item {{ request()->is('dashboard*') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('dashboard.index') }}" aria-expanded="false">
                            <i class="fa-solid fa-house-fire"></i>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>


                    <li class="nav-small-cap">
                        <i class="fas fa-database nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">MASTER DATA</span>
                    </li>

                    <li class="sidebar-item {{ request()->is('users*') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('users.index') }}" aria-expanded="false">
                            <i class="fa-solid fa-users-gear"></i>
                            <span class="hide-menu">Users</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ request()->is('categories*') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('categories.index') }}" aria-expanded="false">
                            <i class="fa-solid fa-list"></i>
                            <span class="hide-menu">Categories</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ request()->is('technology*') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('technology.index') }}" aria-expanded="false">
                            <i class="fa-solid fa-microchip"></i>
                            <span class="hide-menu">Technology</span>
                        </a>
                    </li>


                    <li class="nav-small-cap">
                        <i class="fas fa-database nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">TRANSACTION DATA</span>
                    </li>

                    <li class="sidebar-item {{ request()->is('source_codes_admin*') ? 'active' : '' }}">
                        <a class="sidebar-link" href="{{ route('source_codes_admin.index') }}" aria-expanded="false">
                            <i class="fa-solid fa-users-gear"></i>
                            <span class="hide-menu">Source Codes</span>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</aside>

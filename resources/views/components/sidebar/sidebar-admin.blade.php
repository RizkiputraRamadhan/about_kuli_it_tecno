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

                @if (auth()->user()->roles == 'USER')
                    <li class="sidebar-item {{ $page == 'dashboard' ? 'active' : '' }}">
                        <a class="sidebar-link {{ $page == 'dashboard' ? 'active' : '' }}"
                            href="{{ route('home.index') }}" aria-expanded="false">
                            <i class="fa-solid fa-house-fire"></i>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ $page == 'transaction' ? 'active' : '' }}">
                        <a class="sidebar-link {{ $page == 'transaction' ? 'active' : '' }}"
                            href="{{ route('transaction_client.index') }}" aria-expanded="false">
                            <i class="fa-solid fa-money-bill-transfer"></i>
                            <span class="hide-menu">Transaction</span>
                        </a>
                    </li>
                @endif

                @if (auth()->user()->roles == 'ADMIN')
                    <li class="sidebar-item {{ $page == 'dashboard' ? 'active' : '' }}">
                        <a class="sidebar-link {{ $page == 'dashboard' ? 'active' : '' }}"
                            href="{{ route('dashboard.index') }}" aria-expanded="false">
                            <i class="fa-solid fa-house-fire"></i>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>


                    <li class="nav-small-cap">
                        <i class="fas fa-database nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">MASTER DATA</span>
                    </li>

                    <li class="sidebar-item {{ $page == 'users' ? 'active' : '' }}">
                        <a class="sidebar-link {{ $page == 'users' ? 'active' : '' }}" href="{{ route('users.index') }}"
                            aria-expanded="false">
                            <i class="fa-solid fa-users-gear"></i>
                            <span class="hide-menu">Users</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ $page == 'categories' ? 'active' : '' }}">
                        <a class="sidebar-link {{ $page == 'categories' ? 'active' : '' }}"
                            href="{{ route('categories.index') }}" aria-expanded="false">
                            <i class="fa-solid fa-list"></i>
                            <span class="hide-menu">Categories</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ $page == 'technology' ? 'active' : '' }}">
                        <a class="sidebar-link {{ $page == 'technology' ? 'active' : '' }}"
                            href="{{ route('technology.index') }}" aria-expanded="false">
                            <i class="fa-solid fa-microchip"></i>
                            <span class="hide-menu">Technology</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ $page == 'voucher' ? 'active' : '' }}">
                        <a class="sidebar-link {{ $page == 'voucher' ? 'active' : '' }}"
                            href="{{ route('voucher.index') }}" aria-expanded="false">
                            <i class="fa-solid fa-ticket"></i>
                            <span class="hide-menu">Voucher</span>
                        </a>
                    </li>


                    <li class="nav-small-cap">
                        <i class="fas fa-database nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">TRANSACTION DATA</span>
                    </li>

                    <li class="sidebar-item {{ $page == 'project' ? 'active' : '' }}">
                        <a class="sidebar-link {{ $page == 'project' ? 'active' : '' }}"
                            href="{{ route('source_codes_admin.index') }}" aria-expanded="false">
                            <i class="fa-solid fa-users-gear"></i>
                            <span class="hide-menu">Source Codes</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ $page == 'transaction' ? 'active' : '' }}">
                        <a class="sidebar-link {{ $page == 'transaction' ? 'active' : '' }}"
                            href="{{ route('transaction.index') }}" aria-expanded="false">
                            <i class="fa-solid fa-money-bill-transfer"></i>
                            <span class="hide-menu">Transaction</span>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</aside>

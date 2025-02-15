<header class="app-header" style="background-color: white !important; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.05);">
    <nav class="navbar navbar-expand-lg navbar-light">

        <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
                <a class="nav-link sidebartoggler " id="headerCollapse" href="javascript:void(0)">
                    <i class="ti ti-menu-2"></i>
                </a>
            </li>
        </ul>
        <div class="input-group search-group" style="width: 300px;">
            <div class="input-group  d-flex">
                <input type="text" id="search-input" class="form-control search-input"
                    placeholder="Search global...">
                <span class="input-group-text toggle-search "><i class="fas fa-search"></i></span>
            </div>
        </div>
        <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                <li class="nav-item dropdown">
                    <a class="nav-link d-flex align-items-center" href="javascript:void(0)" id="drop2"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        @if (auth()->user()->roles == 'ADMIN')
                            <img src="{{ asset('assets/admin.jpg') }}" alt="" width="35" height="35"
                                class="rounded-circle">
                            @php
                                $name = auth()->user()->name;
                                $nameParts = explode(' ', strtolower($name));
                                $formattedName =
                                    ucwords($nameParts[0]) . (isset($nameParts[1]) ? ' ' . ucwords($nameParts[1]) : '');
                            @endphp
                            <small class="p-1 mt-1 d-none d-md-inline"
                                style="font-size: 15px">{{ $formattedName }}</small>
                        @else
                            @php
                                $name = auth()->user()->name;
                                $nameParts = explode(' ', strtolower($name));
                                $formattedName =
                                    ucwords($nameParts[0]) . (isset($nameParts[1]) ? ' ' . ucwords($nameParts[1]) : '');
                            @endphp
                            <img src="{{ asset('assets/user.png') }}" alt="" width="35" height="35"
                                class="rounded-circle">
                            <small class="p-1 mt-1 d-none d-md-inline"
                                style="font-size: 15px">{{ $formattedName }}</small>
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                        <div class="message-body">
                            <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item"
                                id="myAccountLink">
                                <i class="ti ti-user fs-6"></i>
                                <p class="mb-0 fs-3">Akun Saya</p>
                            </a>
                            <a href="{{ route('client.sources') }}" class="d-flex align-items-center gap-2 dropdown-item">
                                <i class="ti ti-apps fs-6"></i>
                                <p class="mb-0 fs-3">Aplikasi lainnya</p>
                            </a>
                            <a href="{{ route('logout') }}" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>

<!-- Modal for Akun Saya -->
<div class="modal fade" id="myAccountModal" tabindex="-1" aria-labelledby="myAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myAccountModalLabel">Update Informasi Akun</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('users.updateAccount') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ auth()->user()->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Enter new password">
                        <div id="password" class="form-text text-danger">*Kosongkan untuk memakai password
                            sebelumnya.</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="breadcrumb">
    <ul class="breadcrumb-links">
        <li>
            <a href="{{ auth()->user()->roles == 'ADMIN' ? '/dashboard' : '/home' }}" class="breadcrumb-box">
                <svg class="breadcrumb-icon-home" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M9.293 2.293a1 1 0 011.414 0l7 7A1 1 0 0117 11h-1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-3a1 1 0 00-1-1H9a1 1 0 00-1 1v3a1 1 0 01-1 1H5a1 1 0 01-1-1v-6H3a1 1 0 01-.707-1.707l7-7z"
                        clip-rule="evenodd" />
                </svg>
                <span class="breadcrumb-text">Dashboard</span>
            </a>
        </li>
        <li>
            <div class="breadcrumb-box">
                <svg class="breadcrumb-icon" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                        clip-rule="evenodd" />
                </svg>
                <a href="#" class="breadcrumb-text">{{ Str::ucfirst(request()->segment(1)) }}</a>
            </div>
        </li>
    </ul>
</div>

<nav class="bg-white border-gray-200 dark:bg-gray-900">
    <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl p-4">
        <a href="" class="flex items-center space-x-3 rtl:space-x-reverse">
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Kuli IT <span
                    class="text-indigo-600"> Tecno</span></span>
        </a>
        <div class="flex items-center space-x-6 rtl:space-x-reverse">
            @if (auth()->check())
                <div class="dropdown dropdown-end">
                    <div tabindex="0" role="button" class="">
                        <div class="w-10 rounded-full">
                            <img alt="Tailwind CSS Navbar component" class=" rounded-full"
                                src="{{ asset('assets/avatar.png') }}" />
                        </div>
                    </div>
                    <ul tabindex="0"
                        class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
                        <li>
                            <a href="{{ auth()->user()->roles  == 'USER' ? '/home' : '/dashboard' }}" class="justify-between">
                                Dashboard
                            </a>
                        </li>
                        <li><a href="/logout">Logout</a></li>
                    </ul>
                </div>
            @else
                @if ($pages == 'register')
                @else
                    <a class="rounded-md border border-transparent py-2 px-4 flex items-center text-center text-sm transition-all text-slate-600 hover:bg-slate-100 focus:bg-slate-100 active:bg-slate-100 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                        href="/register">
                        <span class="underline">Daftar Sekarang</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="w-4 h-4 ml-1.5">
                            <path fill-rule="evenodd"
                                d="M16.72 7.72a.75.75 0 0 1 1.06 0l3.75 3.75a.75.75 0 0 1 0 1.06l-3.75 3.75a.75.75 0 1 1-1.06-1.06l2.47-2.47H3a.75.75 0 0 1 0-1.5h16.19l-2.47-2.47a.75.75 0 0 1 0-1.06Z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                @endif
            @endif
        </div>
    </div>
</nav>

<nav class="bg-white shadow-inner">
    <div class="max-w-screen-xl px-4 py-3 mx-auto relative">
        <div class="flex items-center">
            <div class="sticky left-0 bg-white z-10">
                @if ($pages != 'home')
                    <a href="#" class=" md:hidden px-2" id="sidebarToggle">
                        <i class="fa-solid fa-angles-right text-blue-500"></i>
                    </a>
                @endif
                <a href="/" class="px-2">
                    <i class="fa-solid fa-house text-blue-500"></i>
                </a>
            </div>

            <div class="overflow-x-auto scrollbar-gradient ml-2 flex-1">
                <ul class="flex flex-row font-medium mt-0 space-x-8 rtl:space-x-reverse text-sm w-max">

                    <li>
                        <a href="{{ env('APP_URL') }}/#working-system" class=" hover:underline">Kinerja</a>
                    </li>
                    <li>
                        <a href="{{ env('APP_URL') }}/#benefit" class=" hover:underline">Benefit</a>
                    </li>
                    <li>
                        <a href="/source-code" class=" hover:underline">Project Premium Murah</a>
                    </li>
                   
                    <li>
                        <a href="{{ env('APP_URL') }}/#about-us" class=" hover:underline">Tentang Kami</a>
                    </li>
                    <li>
                        <a href="/contact" class=" hover:underline">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

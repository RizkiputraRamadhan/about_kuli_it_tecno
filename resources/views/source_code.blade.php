@extends('layouts.frontend')
@section('title', $pages)
@section('content')
    <div class="flex h-screen">
        <!-- Sidebar -->
        @include('components.sidebar.sidebar_frontend')

        <!-- Main Content -->
        <div class="flex-1 overflow-y-auto lg:p-1 ">
            <div class="bg-neutral text-gray-800 rounded py-10 px-4 sm:px-8">
                <div id="fitures" class="space-y-2 text-center">
                    <h2 class="text-2xl sm:text-3xl font-bold text-white">CARI <span class="text-indigo-600">APLIKASI</span>
                        SEPERTI APA?</h2>
                    <p class="text-sm sm:text-base text-gray-200">
                        Aplikasi ini resmi <span class="text-indigo-600">kuli it tecno</span>, dibuat tanpa mengambil
                        aplikasi dari luar.
                    </p>
                </div>

                {{-- Search Bar --}}
                <div class="mt-5 flex justify-center">
                    <form action="" method="GET" class="w-full max-w-2xl">
                        <div class="relative ">
                            <input type="text" name="query"
                                class="w-full h-12 sm:h-14 px-4 sm:px-6 pr-16 text-sm sm:text-lg border border-gray-300 rounded-full shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                placeholder="Cari aplikasi, teknologi, atau lainnya..." value="{{ request('query') }}"
                                autofocus autocomplete="off">
                            <button type="submit"
                                class="absolute top-1/2 right-4 transform -translate-y-1/2 bg-indigo-600 text-white px-4 sm:px-6 py-2 rounded-full hover:bg-indigo-700">
                                Cari
                            </button>
                        </div>
                    </form>
                </div>

                <div class="max-w-screen-xl  justify-center text-center flex px-4 py-3 ml-auto relative">
                    <div class="flex items-center">

                        @php
                            $rekomendasi = [
                                'Laravel',
                                'TailwindCSS',
                                'Vue.js',
                                'React',
                                'React',
                                'React',
                                'React',
                                'React',
                            ];
                        @endphp
                        <div class="overflow-x-auto"
                            style="overflow-x: auto; scrollbar-width: none; -ms-overflow-style: none;">
                            <ul class="flex flex-row font-medium mt-0 space-x-1 rtl:space-x-reverse text-sm w-max"
                                style="scrollbar-width: none; -webkit-overflow-scrolling: touch;">
                                @foreach ($rekomendasi as $item)
                                    <a href="?query={{ $item }}"
                                        class="btn btn-xs flex items-center {{ request('query') == $item ? ' badge-success' : '' }}">
                                        <span>{{ $item }}</span>
                                        <div class="badge badge-sm ml-1">+99</div>
                                    </a>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>



            <div class="flex items-center mt-6 ms-1 space-x-4">
                <!-- Icon -->
                <div class="bg-blue-200 text-blue-500 w-7 h-7 flex items-center justify-center rounded-full">
                    <i class="fa-solid fa-hashtag text-lg"></i>
                </div>
                <!-- Text -->
                <h1 class="text-lg font-bold">Alls Categories</h1>
            </div>


            <div class="container mx-auto p-4 " id="project-premium">
                <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6 mt-6">
                    <!-- Loop Start -->
                    @for ($i = 0; $i < 8; $i++)
                        <div class="relative flex flex-col bg-white shadow-sm border border-slate-200 rounded-lg">
                            <div class="relative h-56 m-2.5 overflow-hidden text-white rounded-md">
                                <img src="https://images.unsplash.com/photo-1499696010180-025ef6e1a8f9?ixlib=rb-4.0.3&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=1470&amp;q=80"
                                    alt="card-image" />
                            </div>
                            <div class="p-4">
                                <div class="flex items-center mb-2">
                                    <h6 class="text-slate-800 text-xl font-semibold">
                                        Wooden House, Florida
                                    </h6>
                                    <div class="flex items-center gap-0.5 ml-auto">
                                        <i class="fa-solid fa-cart-shopping"></i>
                                        <span class="text-slate-600 ml-1.5">5.0</span>
                                    </div>
                                </div>
                            </div>
                            <div class="group my-2 mx-5 inline-flex flex-wrap gap-2">
                                Teknologi:
                                <span
                                    class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">Laravel</span>
                                <span
                                    class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">Tailwind</span>
                                <span
                                    class="bg-purple-100 text-purple-800 text-xs font-medium px-2.5 py-0.5 rounded">VueJS</span>
                            </div>
                            <div class="px-4 pb-4 pt-0 mt-2">
                                <button
                                    class="w-full rounded-md bg-slate-800 py-2 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                    type="button">
                                    Lihat Selengkapnya <i class="fa-solid fa-arrow-right fa-fade"></i>
                                </button>
                            </div>
                        </div>
                    @endfor
                    <!-- Loop End -->
                </div>
            </div>

        </div>
    </div>
@endsection

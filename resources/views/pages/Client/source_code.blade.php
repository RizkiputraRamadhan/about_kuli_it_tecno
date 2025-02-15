@extends('layouts.client')
@section('title', $pages)
@section('content')
    <div class="flex h-screen">
        <!-- Sidebar -->
        @include('components.sidebar.sidebar_client', [
            'categories' => $categories,
            'technologies' => $technologies,
        ])

        <!-- Main Content -->
        <div class="flex-1 overflow-y-auto lg:p-1 ">
            <div class="bg-neutral text-gray-800 rounded py-10 px-4 sm:px-8">
                <div id="fitures" class="space-y-2 text-center">
                    <h2 class="text-2xl sm:text-3xl font-bold text-white">
                        <span> CARI <span class="text-indigo-600">APLIKASI</span> SEPERTI APA ? </span>
                    </h2>
                    <p class="text-sm sm:text-base text-gray-200">
                        Aplikasi ini resmi dari product buatan <span class="text-indigo-600">kuli it tecno</span>, dibuat tanpa mengambil
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
                        <div class="overflow-x-auto"
                            style="overflow-x: auto; scrollbar-width: none; -ms-overflow-style: none;">
                            @if (request('query'))
                                <small class="text-white">Temukan aplikasi dengan kata kunci <span class="text-indigo-600"> {{ request('query') }}</span> kemungkinan
                                    kami punya.</small>
                            @else
                                <small class="text-white">Temukan aplikasi yang anda mau dengan keyword keyword yang
                                    spesifik.</small>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center mt-6 ms-1 space-x-4">
                <div class="bg-blue-200 text-blue-500 w-7 h-7 flex items-center justify-center rounded-full">
                    <i class="fa-solid fa-hashtag text-lg"></i>
                </div>
                <h1 class="text-lg font-bold">
                    @if (request('query'))
                        Berdasarkan {{ request('query') }} <a class="text-red-600" href="?query="><i
                                class="fa-solid fa-arrows-rotate"></i></a>
                    @else
                        Semua Kategori
                    @endif
                </h1>
            </div>


            @include('widget.client.list-project', [
                'data' => $sources,
                'header' => false,
                'animate' => false,
                'column' => 2,
            ])

        </div>
    </div>
@endsection


@push('style')
    <style>
        
    </style>
@endpush
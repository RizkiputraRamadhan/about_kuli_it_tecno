@extends('layouts.frontend')
@section('title', $pages)
@section('content')
    <div class="flex h-screen">
        <!-- Sidebar -->
        @include('components.sidebar.sidebar_frontend')

        <!-- Main Content -->
        <div class="flex-1 overflow-y-auto lg:p-1 ">
            <div class="container p-2 mx-auto " id="project-premium">
                <div
                    class="relative flex flex-col md:flex-row w-full mb-2 bg-white shadow-sm border border-slate-200 rounded-lg">
                    <div class="relative p-2.5 md:w-2/5 shrink-0 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=1471&amp;q=80"
                            alt="card-image" class="h-full w-full rounded-md md:rounded-lg object-cover" />
                    </div>
                    <div class="p-6">
                        <div class="grid gap-4 mb-4">
                            <div class="flex gap-4 overflow-x-auto"
                                style="scrollbar-width: none; -ms-overflow-style: none; /* IE and Edge */">
                                @for ($i = 0; $i < 6; $i++)
                                    <div class="flex-shrink-0">
                                        <img src="https://images.unsplash.com/photo-1499696010180-025ef6e1a8f9?ixlib=rb-4.0.3&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=1470&amp;q=80"
                                            class="object-cover object-center h-20 max-w-full rounded-lg cursor-pointer"
                                            alt="gallery-image" />
                                    </div>
                                @endfor
                            </div>
                        </div>

                        <div class="group my-2 inline-flex flex-wrap gap-2">
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">Laravel</span>
                            <span
                                class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">Tailwind</span>
                            <span
                                class="bg-purple-100 text-purple-800 text-xs font-medium px-2.5 py-0.5 rounded">VueJS</span>
                        </div>
                        <h4 class="mb-2 text-slate-800 text-xl font-semibold">
                            Lyft launching cross-platform service this week
                        </h4>
                        <div
                            class="lg:max-h-40 overflow-y-auto [&::-webkit-scrollbar-thumb]:rounded-xl [&::-webkit-scrollbar-thumb]:bg-slate-300 [&::-webkit-scrollbar]:w-1.5 [&::-webkit-scrollbar-track]:rounded-xl [&::-webkit-scrollbar-track]:bg-slate-100">
                            Like so many organizations these days, Autodesk is a company in
                            transition. It was until recently a traditional boxed software company
                            selling licenses. Yet its own business model disruption is only part
                            of the story
                            Like so many organizations these days, Autodesk is a company in
                            transition. It was until recently a traditional boxed software company
                            selling licenses. Yet its own business model disruption is only part
                            of the story
                            Like so many organizations these days, Autodesk is a company in
                            transition. It was until recently a traditional boxed software company
                            selling licenses. Yet its own business model disruption is only part
                            of the story
                            Like so many organizations these days, Autodesk is a company in
                            transition. It was until recently a traditional boxed software company
                            selling licenses. Yet its own business model disruption is only part
                            of the story
                            Like so many organizations these days, Autodesk is a company in
                            transition. It was until recently a traditional boxed software company
                            selling licenses. Yet its own business model disruption is only part
                            of the story
                            Like so many organizations these days, Autodesk is a company in
                            transition. It was until recently a traditional boxed software company
                            selling licenses. Yet its own business model disruption is only part
                            of the story
                        </div>

                        <div class="flex justify-between items-center mt-5">
                            <a class="text-slate-800 font-semibold text-lg hover:underline">
                                Rp. 100.000,00
                            </a>

                            <button
                                class="rounded-md bg-gradient-to-tr from-slate-800 to-slate-700 py-2 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                type="button">
                                Beli Sekarang
                            </button>
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

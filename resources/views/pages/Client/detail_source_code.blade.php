@extends('layouts.client')
@section('title', $pages)
@section('content')
    <div class="flex h-screen">
        <!-- Sidebar -->
        @include('components.sidebar.sidebar_client')

        <!-- Main Content -->
        <div class="flex-1 overflow-y-auto lg:p-1 ">
            <div class="container p-2 mx-auto " id="project-premium">
                <div
                    class="relative flex flex-col md:flex-row w-full mb-2 bg-white shadow-sm border border-slate-200 rounded-lg">
                    <div class="relative p-2.5 md:w-2/5 shrink-0 overflow-hidden">
                        <a href="{{ asset('storage/' . $detail->thumbnail) }}" data-lightbox="gallery">
                            <img src="{{ asset('storage/' . $detail->thumbnail) }}" alt="card-image"
                                class="h-full w-full rounded-md md:rounded-lg object-cover cursor-pointer" />
                        </a>
                    </div>
                    <div class="p-6">
                        <div class="grid gap-4 mb-4">
                            <div class="flex gap-4 overflow-x-auto"
                                style="scrollbar-width: none; -ms-overflow-style: none;">
                                @foreach ($detail->assets as $asset)
                                    <div class="flex-shrink-0">
                                        <a href="{{ asset('storage/' . $asset->image) }}" data-lightbox="gallery">
                                            <img src="{{ asset('storage/' . $asset->image) }}"
                                                class="object-cover object-center h-20 max-w-full rounded-lg cursor-pointer"
                                                alt="gallery-image" />
                                        </a>
                                    </div>
                                @endforeach
                            </div>

                        </div>

                        <div class="group my-2 inline-flex flex-wrap gap-2">
                            @foreach ($detail->tech_details as $tech)
                                <span class="text-white text-xs font-medium px-2.5 py-0.5 rounded-full"
                                    style="background-color: {{ $tech->color }};">
                                    {{ $tech->name }}
                                </span>
                            @endforeach

                        </div>
                        <div class="group my-2 inline-flex flex-wrap gap-1">
                            |
                            @foreach ($detail->cat_details as $tech)
                                <span class="text-gray-600 text-xs font-medium px-1 py-1">
                                    # {{ $tech->name }}
                                </span>
                            @endforeach
                        </div>
                        <h4 class="mb-2 text-slate-800 text-xl font-semibold">
                            {{ $detail->title }}
                        </h4>
                        <div
                            class="lg:max-h-40 overflow-y-auto [&::-webkit-scrollbar-thumb]:rounded-xl [&::-webkit-scrollbar-thumb]:bg-slate-300 [&::-webkit-scrollbar]:w-1.5 [&::-webkit-scrollbar-track]:rounded-xl [&::-webkit-scrollbar-track]:bg-slate-100">
                            {!! $detail->description !!}
                        </div>

                        <div class="flex justify-between items-center mt-5">
                            <a class="text-slate-800 font-semibold text-lg hover:underline">
                                Rp. {{ number_format($detail->price) }}
                            </a>

                            <a class="rounded-md bg-gradient-to-tr from-slate-800 to-slate-700 py-2 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                href="{{ route('client.source.payment', ['crsf' => csrf_token(), 'slug' => $detail->slug]) }}">
                                Beli Sekarang
                            </a>

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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
@endpush
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
@endpush

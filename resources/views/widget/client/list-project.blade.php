@if ($data)
    <div class="container mx-auto p-4 " id="project-premium">
        @if ($header)
            <div id="fitures" class="space-y-2 mt-12 text-center">
                <h2 class="text-2xl font-bold">APLIKASI PREMIUM DALAM SEKALI ORDER</h2>
                <p class="text-sm text-gray-600">
                    Kami menyediakan sistem siap jadi yang bisa Anda terapkan dalam 1 (satu) kali beli.
                </p>
            </div>
        @endif

        {{-- loping --}}
        <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-{{ $column }} gap-6 mt-6">
            @foreach ($data as $row)
                <div data-aos="{{ $animate }}"
                    class="relative flex flex-col bg-white shadow-sm border border-slate-200 rounded-lg">
                    <div class="relative h-56 m-2.5 overflow-hidden text-white rounded-md">
                        <img src="{{ asset('storage/' . $row->thumbnail) }}" alt="card-image" />
                    </div>
                    <div class="p-4">
                        <div class="flex items-center mb-2">
                            <h6 class="text-slate-800 text-xl font-semibold">
                                {{ $row->title }}
                            </h6>
                            <div class="flex items-center gap-0.5 ml-auto">
                                <i class="fa-solid fa-eye"></i>
                                <span class="text-slate-600 ml-1.5">{{ $row->viewer }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="group my-2 mx-5 inline-flex flex-wrap gap-2">
                        Teknologi:
                        @foreach ($row->tech_details as $tech)
                            <span class="text-white text-xs font-medium px-2.5 py-0.5 rounded-full"
                                style="background-color: {{ $tech->color }};">
                                {{ $tech->name }}
                            </span>
                        @endforeach
                    </div>
                    <div class="px-4 pb-4 pt-0 mt-2 w-full">
                        <a class="w-full block rounded-md bg-slate-800 py-2 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                            href="{{ route('client.source_detail', $row->slug) }}">
                            Lihat Selengkapnya <i class="fa-solid fa-arrow-right fa-fade"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- paginate --}}
        <div class="flex justify-center mt-8">
            @if ($data->hasPages())
                <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center space-x-2">
                    @if ($data->onFirstPage())
                        <span class="cursor-not-allowed opacity-50 border rounded-md px-3 py-1 text-gray-500">
                            &larr;
                        </span>
                    @else
                        <a href="{{ $data->previousPageUrl() }}"
                            class="border rounded-md px-3 py-1 hover:bg-gray-200 text-gray-700">
                            &larr;
                        </a>
                    @endif

                    <span class="text-gray-700">
                        Page <strong>{{ $data->currentPage() }}</strong> of <strong>{{ $data->lastPage() }}</strong>
                    </span>

                    @if ($data->hasMorePages())
                        <a href="{{ $data->nextPageUrl() }}"
                            class="border rounded-md px-3 py-1 hover:bg-gray-200 text-gray-700">
                            &rarr;
                        </a>
                    @else
                        <span class="cursor-not-allowed opacity-50 border rounded-md px-3 py-1 text-gray-500">
                            &rarr;
                        </span>
                    @endif
                </nav>
            @endif
        </div>
    </div>
@endif

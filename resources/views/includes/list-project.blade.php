<div class="container mx-auto p-4 m-12" id="project-premium">
    <div id="fitures" class="space-y-2 text-center">
        <h2 class="text-2xl font-bold">APLIKASI PREMIUM DALAM SEKALI ORDER</h2>
        <p class="text-sm text-gray-600">Kami menyediakan sistem siap jadi yang bisa Anda terapkan dalam 1 (satu) kali
            beli.</p>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
        <!-- Loop Start -->
        @for ($i = 0; $i < 8; $i++)
            <div data-aos="zoom-in" class="relative flex flex-col bg-white shadow-sm border border-slate-200 rounded-lg">
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
                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">Laravel</span>
                    <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">Tailwind</span>
                    <span class="bg-purple-100 text-purple-800 text-xs font-medium px-2.5 py-0.5 rounded">VueJS</span>
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

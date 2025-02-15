<div class="relative h-screen w-full flex flex-col sm:flex-row items-center justify-center sm:justify-start text-center sm:text-left bg-cover bg-center"
    style="background-image:url({{ asset('assets/hero.png') }});">
    <div class="absolute top-0 right-0 bottom-0 left-0 bg-gray-900 opacity-75"></div>

    <main class="px-8 sm:px-24 z-10 sm:w-2/3">
        <div class="">
            <h2
                class="text-4xl tracking-tight leading-10 font-extrabold sm:text-5xl text-white sm:leading-none md:text-6xl">
                Kuli IT <span class="text-indigo-600"> Tecno</span>
            </h2>
            <p class="mt-3 text-white sm:mt-5 sm:max-w-xl md:mt-5 text-lg font-light">
                Website <span class="text-indigo-600">Kuli IT Tecno</span> menyediakan berbagai project yang menarik dan
                bermanfaat, sekaligus penyedia jasa pembuatan system dalam berbagai bidang. <br>
            </p>
            <div class="mt-5 sm:mt-8 sm:flex justify-start">
                <div class="rounded-md shadow">
                    <a href="/contact"
                        class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo transition duration-150 ease-in-out md:py-4 md:text-lg md:px-10">
                        Hubungi Kami
                    </a>
                </div>
                <div class="mt-3 sm:mt-0 sm:ml-3">
                    <a href="{{ route('login') }}"
                        class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base leading-6 font-medium rounded-md text-indigo-700 bg-indigo-100 hover:text-indigo-600 hover:bg-indigo-50 focus:outline-none focus:shadow-outline-indigo focus:border-indigo-300 transition duration-150 ease-in-out md:py-4 md:text-lg md:px-10">
                        Masuk
                    </a>
                </div>
            </div>
        </div>
    </main>
</div>

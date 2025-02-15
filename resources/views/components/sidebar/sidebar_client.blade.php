<div class="w-64 flex flex-col overflow-y-auto" id="sidebar">
    <div
        class="relative flex h-screen w-full max-w-[20rem] flex-col bg-white p-2 text-gray-700 shadow-inner border-l rounded">
        <nav class="flex flex-col gap-1 p-2 text-base font-normal text-blue-gray-700">
            <!-- Categories-->
            <div class="relative block w-full">
                <ul class="space-y-1">
                    <li>
                        <a href="#"
                            class="flex items-center p-3 text-lg font-semibold leading-snug text-blue-gray-900 hover:bg-blue-gray-50 hover:text-blue-gray-900">
                            <div class="grid mr-4 place-items-center">
                                <i class="fa-solid fa-layer-group"></i>
                            </div>
                            <span>Kategori</span>
                        </a>
                    </li>
                    @foreach ($categories as $cat)
                        <li class="px-3">
                            <a href="?query={{ str_replace(' ', '+', $cat->name) }}"
                                class="flex items-center p-3 text-sm {{ request('query') == $cat->name ? 'text-indigo-700' : 'text-blue-gray-700' }} hover:bg-blue-gray-50 hover:text-blue-gray-900 ">
                                <div class="grid mr-4 place-items-center">
                                    <i class="fa-solid fa-chevron-right text-xs"></i>
                                </div>
                                {{ $cat->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Teknologi -->
            <div class="relative block w-full mt-4">
                <ul class="space-y-1">
                    <li>
                        <a href="#"
                            class="flex items-center p-3 text-lg font-semibold leading-snug text-blue-gray-900 hover:bg-blue-gray-50 hover:text-blue-gray-900">
                            <div class="grid mr-4 place-items-center">
                                <i class="fa-solid fa-microchip"></i>
                            </div>
                            <span>Teknologi</span>
                        </a>
                    </li>
                    @foreach ($technologies as $tech)
                        <li class="px-3">
                            <a href="?query={{ str_replace(' ', '+', $tech->name) }}"
                                class="flex items-center p-3 text-sm {{ request('query') == $tech->name ? 'text-indigo-700' : 'text-blue-gray-700' }} hover:bg-blue-gray-50 hover:text-blue-gray-900">
                                <div class="grid mr-4 place-items-center">
                                    <i class="fa-solid fa-chevron-right text-xs"></i>
                                </div>
                                {{ $tech->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </nav>
    </div>
</div>

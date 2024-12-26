<div class="w-64 flex flex-col overflow-y-auto" id="sidebar">
    <div
        class="relative flex h-screen w-full max-w-[20rem] flex-col bg-white p-2 text-gray-700 shadow-inner border-l rounded">
        <nav class="flex flex-col gap-1 p-2 text-base font-normal text-blue-gray-700">
            <!-- Categories-->
            <div class="relative block w-full">
                <!-- Dropdown Button -->
                <div role="button" data-parent="categories"
                    class="dropdown-btn flex items-center w-full p-0 leading-tight transition-all rounded-lg outline-none bg-blue-gray-50/50 text-start text-blue-gray-700 hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900">
                    <button type="button"
                        class="flex items-center justify-between w-full p-3 text-xl antialiased font-semibold leading-snug text-left transition-colors border-b-0 select-none border-b-blue-gray-100 text-blue-gray-900 hover:text-blue-gray-900">
                        <div class="grid mr-4 place-items-center">
                            <i class="fa-solid fa-house"></i>
                        </div>
                        <p class="block mr-auto text-base font-normal leading-relaxed">
                            Categories
                        </p>
                        <span class="ml-4">
                            <i class="fa-solid fa-angle-up dropdown-icon" id="dropdown-icon"></i>
                        </span>
                    </button>
                </div>
                <!-- Dropdown Content -->
                <div class="dropdown-content " data-child="categories"
                    class="block w-full py-1 px-10 text-sm transition-all duration-300">
                    <nav class="flex flex-col gap-1 ml-9">
                        <div role="button"
                            class="flex items-center w-full p-3 leading-tight transition-all rounded-lg text-start hover:bg-blue-gray-50 hover:text-blue-gray-900">
                            <div class="grid mr-4 place-items-center">
                                <i class="fa-solid fa-chevron-right text-xs"></i>
                            </div>
                            Analytics
                        </div>
                        <div role="button"
                            class="flex items-center w-full p-3 leading-tight transition-all rounded-lg text-start hover:bg-blue-gray-50 hover:text-blue-gray-900">
                            <div class="grid mr-4 place-items-center">
                                <i class="fa-solid fa-chevron-right text-xs"></i>
                            </div>
                            Reports
                        </div>
                    </nav>
                </div>
            </div>

            <!-- dashboatrd -->
            <div class="relative block w-full">
                <!-- Dropdown Button -->
                <div role="button" data-parent="dropdown2"
                    class="dropdown-btn flex items-center w-full p-0 leading-tight transition-all rounded-lg outline-none bg-blue-gray-50/50 text-start text-blue-gray-700 hover:bg-blue-gray-50 hover:bg-opacity-80 hover:text-blue-gray-900 focus:bg-blue-gray-50 focus:bg-opacity-80 focus:text-blue-gray-900 active:bg-blue-gray-50 active:bg-opacity-80 active:text-blue-gray-900">
                    <button type="button"
                        class="flex items-center justify-between w-full p-3 text-xl antialiased font-semibold leading-snug text-left transition-colors border-b-0 select-none border-b-blue-gray-100 text-blue-gray-900 hover:text-blue-gray-900">
                        <div class="grid mr-4 place-items-center">
                            <i class="fa-solid fa-house"></i>
                        </div>
                        <p class="block mr-auto text-base font-normal leading-relaxed">
                            Dashboard
                        </p>
                        <span class="ml-4">
                            <i class="fa-solid fa-angle-up dropdown-icon" id="dropdown-icon"></i>
                        </span>
                    </button>
                </div>
                <!-- Dropdown Content -->
                <div class="dropdown-content hidden" data-child="dropdown2"
                    class="block w-full py-1 px-10 text-sm transition-all duration-300">
                    <nav class="flex flex-col gap-1 ml-9">
                        <div role="button"
                            class="flex items-center w-full p-3 leading-tight transition-all rounded-lg text-start hover:bg-blue-gray-50 hover:text-blue-gray-900">
                            <div class="grid mr-4 place-items-center">
                                <i class="fa-solid fa-chevron-right text-xs"></i>
                            </div>
                            Analytics
                        </div>
                        <div role="button"
                            class="flex items-center w-full p-3 leading-tight transition-all rounded-lg text-start hover:bg-blue-gray-50 hover:text-blue-gray-900">
                            <div class="grid mr-4 place-items-center">
                                <i class="fa-solid fa-chevron-right text-xs"></i>
                            </div>
                            Reports
                        </div>
                    </nav>
                </div>
            </div>
        </nav>
    </div>
</div>

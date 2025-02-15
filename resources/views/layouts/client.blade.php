<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.2/dist/full.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('custom/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" />
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    @stack('style')
</head>

<body class="bg-white w-full">
    @include('widget.client.navigasi')
    <!-- Main Content -->
    <div class=" mx-auto">
        <div style="display: none"
            class="fixed load inset-0 flex items-center justify-center bg-gray-200 bg-opacity-75 backdrop-filter backdrop-blur-lg">
            <div class="relative max-w-screen-sm w-full mx-auto p-6">
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="">
                        <div class="loader"></div>
                    </div>
                </div>
            </div>
        </div>

        @yield('content')
    </div>

    <!-- Footer -->
    @include('widget.client.footer')
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    AOS.init({
        duration: 800,
        once: true
    });
    $(document).ready(function() {
        $('#sidebarToggle').on('click', function() {
            $('#sidebar').toggle();
        });
    });
</script>
@stack('scripts')

</html>

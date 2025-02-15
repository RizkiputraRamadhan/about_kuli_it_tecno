<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('backend/src/assets/images/logos/logo.png') }}" />
    <link rel="stylesheet" href="{{ asset('backend/src/assets/css/styles.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/src/assets/css/custom.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @stack('css')
</head>


<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        @include('components.sidebar.sidebar-admin')

        <div class="body-wrapper">
            <!--  Header Start -->
            @include('components.header.header-admin')
            <div class="body-wrapper-inner">
                @include('components.breadcrumb')
                @yield('content')

            </div>
        </div>
    </div>
    @include('components.confrm_session_swal')
    <script src="{{ asset('backend/src/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/src/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/src/assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('backend/src/assets/js/app.min.js') }}"></script>
    <script src="{{ asset('backend/src/assets/libs/simplebar/dist/simplebar.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @stack('script')
    <script>
        $('#myAccountLink').on('click', function() {
            var myAccountModal = new bootstrap.Modal($('#myAccountModal')[0]);
            myAccountModal.show();
        });

        $(document).ready(function() {
            $('#search-input').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                $('#table-body tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>

</body>

</html>

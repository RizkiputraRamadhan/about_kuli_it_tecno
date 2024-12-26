<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    {{--  initials Toast  --}}
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });
    $('.show_confirm').click(function(event) {
        event.preventDefault();
        var formId = $(this).closest('form').attr('id');
        Swal.fire({
            title: 'Konfirmasi Hapus Permanent ?',
            html: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, dihapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(formId).submit();
            }
        });
    });
    {{--  handle confirm success  --}}
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
            showConfirmButton: true,
            customClass: {
                popup: 'swal-wide'
            }
        });
    @endif

    {{--  handle confirm error --}}
    @if (session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: '{{ session('error') }}',
            showConfirmButton: true,
            customClass: {
                popup: 'swal-wide'
            }
        });
    @endif

    {{--  handle confirm information --}}
    @if (session('info'))
        Swal.fire({
            icon: 'info',
            title: 'Information',
            text: '{{ session('info') }}',
            showConfirmButton: true,
            customClass: {
                popup: 'swal-wide'
            }
        });
    @endif


    {{--  handle error any  --}}
    @if ($errors->any())
        Swal.fire({
            title: 'Terjadi kesalahan!',
            html: '<div style="text-align: left;">' +
                @foreach ($errors->all() as $error)
                    '- <span>{{ $error }}</span> <br>' +
                @endforeach
            ' </div>',
            confirmButtonText: 'Oke, Mengerti',
        });
    @endif
</script>

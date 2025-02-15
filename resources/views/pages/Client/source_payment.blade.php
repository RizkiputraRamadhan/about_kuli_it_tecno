@extends('layouts.client')
@section('title', $pages)
@section('content')
    <section class="container mx-auto py-10 px-8">
        @include('components.alert')

        <h4 class="block antialiased tracking-normal text-2xl font-semibold leading-snug text-inherit">
            Detail Order
        </h4>
        <p class="block antialiased text-base  leading-relaxed text-inherit text-gray-200 font-normal">
            ID: {{ $transaction->order_id }}
        </p>
        <div class="mt-8 grid lg:gap-x-6 gap-y-6 lg:grid-cols-12 grid-cols-6">
            <div class="col-span-8 space-y-6">
                <div
                    class="relative flex flex-col bg-clip-border  bg-white text-gray-700 shadow-md border border-gray-300 rounded-md">
                    <div class="p-6  flex gap-4 flex-col md:flex-row items-center justify-between">
                        <div class="flex !justify-between w-full">
                            <div>
                                <p class="block antialiased text-base  leading-relaxed text-blue-gray-900 !font-semibold">
                                    Tanggal Order
                                </p>
                                <p
                                    class="block antialiased text-base  leading-relaxed text-inherit text-gray-600 font-normal">
                                    {{ $transaction->updated_at->locale('id')->translatedFormat('d F Y') }}
                                </p>
                            </div>
                            <div>
                                <p class="block antialiased text-base  leading-relaxed text-blue-gray-900 !font-semibold">
                                    Order ID
                                </p>
                                <p
                                    class="block antialiased text-base  leading-relaxed text-inherit text-gray-600 font-normal">
                                    #{{ $transaction->order_id }}
                                </p>
                            </div>
                        </div>
                        <div class="w-full">
                            <a
                                class="align-middle select-none  font-bold text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none text-xs py-3 px-6 rounded-lg border border-gray-900 text-gray-900 hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85] ml-auto border-gray-200 flex items-center justify-center gap-2 w-full md:max-w-fit"
                                href="{{ route('client.invoice', $transaction->order_id) }}" data-ripple-dark="true">
                                Download invoice<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor" aria-hidden="true" data-slot="icon"
                                    class="h-4 w-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div
                    class="relative flex flex-col bg-clip-border bg-white text-gray-700 shadow-md border border-gray-300 rounded-md">
                    <div class="p-6 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                        <div>
                            <p class="block antialiased text-base leading-relaxed text-blue-gray-900 font-semibold">
                                Nama Akun
                            </p>
                            <div class="mt-2">
                                <p class="block antialiased text-base leading-relaxed text-gray-600 font-normal">
                                    {{ Auth::user()->name }}
                                </p>
                                <small>{{ Auth::user()->email }}</small>
                            </div>
                        </div>

                        <div>
                            @php
                                $status = $transaction->transaction_status;
                                $statusColors = [
                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                    'success' => 'bg-green-100 text-green-800',
                                    'failed' => 'bg-red-100 text-red-800',
                                    'expired' => 'bg-gray-100 text-gray-800',
                                    'cancel' => 'bg-orange-100 text-orange-800',
                                ];
                                $statusMessages = [
                                    'pending' => 'Menunggu Pembayaran',
                                    'success' => 'Pembayaran berhasil.',
                                    'failed' => 'Pembayaran gagal.',
                                    'expired' => 'Pembayaran kadaluarsa.',
                                    'cancel' => 'Pembayaran dibatalkan.',
                                ];

                                $colorClass = $statusColors[$status] ?? 'bg-gray-100 text-gray-800';
                                $message = $statusMessages[$status] ?? 'Status tidak diketahui.';
                            @endphp

                            <div class="mt-3 md:mt-0">
                                <p
                                    class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium {{ $colorClass }}">
                                    {{ $message }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="relative flex flex-col bg-clip-border rounded-md bg-white text-gray-700 shadow-md border border-gray-300 ">
                    <div class="p-2 md:px-2 ">
                        <div class="flex-1 overflow-y-auto lg:p-1 ">
                            <div class="container p-2 mx-auto " id="project-premium">
                                <div class="relative flex flex-col flex-row w-full mb-2 bg-white ">
                                    <div class="relative p-2.5 w-full shrink-0 overflow-hidden">
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
                                                        <a href="{{ asset('storage/' . $asset->image) }}"
                                                            data-lightbox="gallery">
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
                                        <div class="">
                                            {!! $detail->description !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="lg:col-span-4 col-span-full space-y-6">
                <div
                    class="relative flex flex-col bg-clip-border bg-white text-gray-700  border border-gray-300 rounded-md shadow-md">
                    <div class="p-6 p-4">
                        <p class="block antialiased  text-base  leading-relaxed text-blue-gray-900 !font-semibold">
                            Detail Pembayaran
                        </p>
                        <div class="my-4 space-y-2">
                            <div class="flex items-center justify-between">
                                <p
                                    class="block antialiased  text-base  leading-relaxed text-inherit text-gray-600 font-normal">
                                    Subtotal
                                </p>
                                <p
                                    class="block antialiased  text-base  leading-relaxed text-inherit text-gray-600 font-normal">
                                    Rp. {{ number_format($transaction->price) }}
                                </p>
                            </div>
                        </div>
                        <div class="my-4 space-y-2">
                            <div class="flex items-center justify-between">
                                <p
                                    class="block antialiased  text-base  leading-relaxed text-inherit text-gray-600 font-normal">
                                    Kode Voucher
                                </p>
                                <p
                                    class="block antialiased  text-base  leading-relaxed text-inherit text-gray-600 font-normal">
                                    {{ $transaction->percent ?? '0' }} %
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center justify-between border-t border-gray-300 pt-4">
                            <p class="block antialiased  text-base  leading-relaxed text-blue-gray-900 !font-semibold">
                                Total Order
                            </p>
                            <p class="block antialiased  text-base  leading-relaxed text-blue-gray-900 !font-semibold">
                                Rp.
                                {{ number_format($transaction->price - ($transaction->price * $transaction->percent) / 100) }}
                            </p>
                        </div>
                        @if ($transaction->transaction_status != 'success')
                            <button id="pay"
                                class="w-full mt-6 rounded-md bg-blue-800 py-2 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-blue-700 focus:shadow-none active:bg-blue-700 hover:bg-blue-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                Klik Disini Untuk Bayar <i class="fa-solid fa-comments-dollar"></i>
                            </button>
                        @else
                            <button id="download" data-url="{{ route('client.download.source', $transaction->order_id) }}"
                                class="w-full mt-6 rounded-md bg-blue-800 py-2 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-blue-700 focus:shadow-none active:bg-blue-700 hover:bg-blue-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                Download Source Code <i class="fa-solid fa-download fa-beat-fade"></i>
                            </button>

                            <div id="progress-bar" class="hidden w-full bg-gray-200 rounded mt-2">
                                <div id="progress" class="bg-blue-500 text-xs leading-none py-1 text-center text-white"
                                    style="width: 0%">0%</div>
                            </div>
                        @endif
                    </div>
                </div>

                @if ($transaction->transaction_status != 'success')
                    <div
                        class="relative flex flex-col bg-clip-border  bg-white text-gray-700 shadow-md border border-gray-300 rounded-md ">
                        <div class="p-6 p-4">
                            <div class="flex items-center justify-between">
                                <p class="block antialiased  text-base  leading-relaxed text-blue-gray-900 !font-semibold">
                                    Kode Voucher
                                </p>
                            </div>
                            <form action="{{ route('client.voucher', ['crsf' => csrf_token(), 'slug' => $detail->slug]) }}"
                                method="POST" class="mt-1 flex flex-col">
                                @csrf
                                <input type="text" name="voucher" autocomplete="off"
                                    value="{{ $transaction?->code?->code }}"
                                    class="w-full mt-2 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md pl-3 pr-20 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
                                    placeholder="Masukkan kode voucher anda" />
                                @if ($transaction?->code)
                                    <div class="group my-2 inline-flex flex-wrap gap-2">
                                        <span
                                            class="text-green-800 bg-green-300 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                            {{ $transaction?->code?->name }}
                                        </span>
                                    </div>
                                @endif

                                <button
                                    class="w-full mt-6 rounded-md bg-slate-800 py-2 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">Cek
                                    Voucher</button>
                                <p class="mt-4 flex items-center justify-center gap-2 text-sm text-slate-500 font-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        aria-hidden="true" class="-mt-0.5 h-4 w-4">
                                        <path fill-rule="evenodd"
                                            d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3c0-2.9-2.35-5.25-5.25-5.25zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    Hanya dapat diisi 1 (satu) voucher.
                                </p>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

@endsection
@push('style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

    @if ($transaction->transaction_status != 'success')
        <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{ $CLIENT_KEY }}"></script>

        <script>
            document.getElementById('pay').addEventListener('click', function() {
                window.snap.pay("{{ $SNAP_TOKEN }}", {
                    onSuccess: function(result) {
                        updateTransaction(result, 'success');
                    },
                    onPending: function(result) {
                        updateTransaction(result, 'pending');
                    },
                    onError: function(result) {
                        updateTransaction(result, 'failed');
                    }
                });
            });

            function updateTransaction(result, status) {
                $.ajax({
                    url: "{{ route('client.payment', ['crsf' => csrf_token(), 'slug' => $detail->slug]) }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        transaction_id: result.transaction_id,
                        order_id: result.order_id,
                        payment_type: result.payment_type,
                        gross_amount: result.gross_amount,
                        transaction_status: status,
                        fraud_status: result.fraud_status ?? null,
                        signature_key: result.signature_key ?? null,
                        approval_code: result.approval_code ?? null
                    },
                    success: function(response) {
                        console.log("Transaksi diperbarui:", response);
                        location.reload();
                    },
                    error: function(xhr) {
                        console.error("Gagal memperbarui transaksi:", xhr.responseText);
                        location.reload();
                    }
                });
            }
        </script>
    @else
        <script>
            $(document).ready(function() {
                $("#download").click(function(e) {
                    e.preventDefault();

                    var url = $(this).data("url");
                    var progressBar = $("#progress-bar");
                    var progress = $("#progress");

                    progressBar.removeClass("hidden");
                    progress.css("width", "0%").text("0%");

                    var xhr = new XMLHttpRequest();
                    xhr.open("GET", url, true);
                    xhr.responseType = "blob";

                    xhr.onprogress = function(event) {
                        if (event.lengthComputable) {
                            var percentComplete = (event.loaded / event.total) * 100;
                            progress.css("width", percentComplete + "%").text(Math.floor(percentComplete) +
                                "%");
                        }
                    };

                    xhr.onload = function() {
                        if (this.status === 200) {
                            var blob = new Blob([this.response], {
                                type: "application/octet-stream"
                            });
                            var link = document.createElement("a");
                            link.href = window.URL.createObjectURL(blob);
                            link.download = "{{ $transaction->source->title }}.zip";
                            document.body.appendChild(link);
                            link.click();
                            document.body.removeChild(link);
                            progress.css("width", "100%").text("Download Selesai!");
                        }
                    };

                    xhr.onerror = function() {
                        alert("Download gagal, silakan coba lagi.");
                    };

                    xhr.send();
                });
            });
        </script>
    @endif
@endpush

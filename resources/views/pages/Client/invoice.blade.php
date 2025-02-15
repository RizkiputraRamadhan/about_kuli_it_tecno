@extends('layouts.client')

@section('content')
    <div class="max-w-3xl mx-auto p-6 border bg-white rounded shadow-sm my-6" id="invoice">
        <div class="grid grid-cols-2 items-center">
            <div>
                <img src="{{ asset('backend/src/assets/images/logos/logo.png') }}" alt="company-logo" height="100"
                    width="100">
            </div>

            <div class="text-right">
                <p>Kuli IT Tecno</p>
                <p class="text-gray-500 text-sm">kuliit@tecno.com</p>
                <p class="text-gray-500 text-sm mt-1">+92 81329995238</p>
            </div>
        </div>

        <!-- Info Klien -->
        <div class="grid grid-cols-2 items-center mt-8">
            <div>
                <p class="font-bold text-gray-800">Ditagihkan Kepada:</p>
                <p class="text-gray-500">{{ $transaction->createdBy->name }}</p>
                <p class="text-gray-500">{{ $transaction->createdBy->email }}</p>
            </div>

            <div class="text-right">
                <p>No. Pesanan: <span class="text-gray-500">{{ $transaction->order_id }}</span></p>
                <p>Tanggal: <span class="text-gray-500">{{ $transaction->updated_at }}</span></p>
            </div>
        </div>

        <!-- Item Transaksi -->
        <div class="-mx-4 mt-8 flow-root sm:mx-0">
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-300 rounded-lg overflow-hidden">
                    <thead class="border-b border-gray-300 bg-gray-100">
                        <tr>
                            <th class="py-3.5 px-4 text-left text-sm font-semibold text-gray-900">Item</th>
                            <th class="py-3.5 px-4 text-right text-sm font-semibold text-gray-900 hidden sm:table-cell">
                                Status</th>
                            <th class="py-3.5 px-4 text-right text-sm font-semibold text-gray-900 hidden sm:table-cell">
                                Diskon</th>
                            <th class="py-3.5 px-4 text-right text-sm font-semibold text-gray-900">Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-gray-200">
                            <td class="py-5 px-4 text-sm">
                                <div class="font-medium text-gray-900">{{ $transaction->source->title }}</div>
                                <div class="mt-1 text-gray-500 text-xs">
                                    @foreach ($technologies as $row)
                                        @foreach (json_decode($transaction->source->technologies) as $tech)
                                            @if ($tech == $row->id)
                                                <span class="text-gray-700 font-medium">#{{ $row->name }}</span>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </div>
                            </td>
                            <td class="py-5 px-4 text-right text-sm text-gray-500 hidden sm:table-cell">
                                {{ $transaction->transaction_status }}
                            </td>
                            <td class="py-5 px-4 text-right text-sm text-gray-500 hidden sm:table-cell">
                                {{ $transaction->percent }} %
                            </td>
                            <td class="py-5 px-4 text-right text-sm text-gray-500">
                                Rp. {{ number_format($transaction->price) }}
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" class="py-4 px-4 text-right text-sm text-gray-500 hidden sm:table-cell">
                                Subtotal</th>
                            <th class="py-4 px-4 text-left text-sm text-gray-500 sm:hidden">Subtotal</th>
                            <td class="py-4 px-4 text-right text-sm text-gray-500">Rp.
                                {{ number_format($transaction->price) }}</td>
                        </tr>

                        <tr>
                            <th colspan="3" class="py-4 px-4 text-right text-sm text-gray-500 hidden sm:table-cell">
                                Diskon</th>
                            <th class="py-4 px-4 text-left text-sm text-gray-500 sm:hidden">Diskon</th>
                            <td class="py-4 px-4 text-right text-sm text-gray-500">- {{ $transaction->percent }} %</td>
                        </tr>

                        <tr>
                            <th colspan="3"
                                class="py-4 px-4 text-right text-sm font-semibold text-gray-900 hidden sm:table-cell">Total
                            </th>
                            <th class="py-4 px-4 text-left text-sm font-semibold text-gray-900 sm:hidden">Total</th>
                            <td class="py-4 px-4 text-right text-sm font-semibold text-gray-900">
                                Rp.
                                {{ number_format($transaction->price - ($transaction->price * $transaction->percent) / 100) }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <!-- Footer -->
        <div class="border-t-2 pt-4 text-xs text-gray-500 text-center mt-16">
            Invoice dari {{ env('APP_URL') }} ini benar adanya dan resmi dari system kami
        </div>
    </div>

    <!-- Tombol Print -->
    <button id="printBtn"
        class="fixed bottom-6 right-6 bg-indigo-600 text-white py-2 px-4 rounded-full shadow-md hover:bg-indigo-700">
        Cetak 🖨️
    </button>
@endsection

@push('scripts')
    <script>
        document.getElementById("printBtn").addEventListener("click", function() {
            var printContents = document.getElementById("invoice").innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = "<html><head><title>Cetak Faktur</title></head><body>" + printContents +
                "</body></html>";
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        });
    </script>
@endpush

@extends('layouts.admin')
@section('title', 'Transaction')
@section('content')
    <div class="container">
        <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="mb-3">Identitas</h5>
                        <table class="table border-0">
                            <tr>
                                <th>Order ID</th>
                                <td>: {{ $transaction->order_id }}</td>
                            </tr>
                            <tr>
                                <th>Nama</th>
                                <td>: {{ $transaction?->createdBy?->name  ?? '...........' }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>: {{ $transaction?->createdBy?->email ?? '...........'  }}</td>
                            </tr>
                            <tr>
                                <th>Aplikasi</th>
                                <td>: {{ $transaction->source->title }}</td>
                            </tr>
                            <tr>
                                <th>Harga Asli</th>
                                <td>: Rp. {{ number_format($transaction->source->price) }}</td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-md-6">
                        <h5 class="mb-3">Detail Transaksi</h5>
                        <table class="table border-0">
                            <tr>
                                <th>Harga Transaksi</th>
                                <td>: Rp. {{number_format($transaction->price - ($transaction->price * $transaction->percent) / 100) }}</td>
                            </tr>
                            <tr>
                                <th>Voucher</th>
                                <td>: {{ $transaction->percent }} %</td>
                            </tr>
                            <tr>
                                <th>ID Transaksi Midtrans</th>
                                <td>: {{ $transaction->transaction_id }}</td>
                            </tr>
                            <tr>
                                <th>Metode Pembayaran</th>
                                <td>: {{ ucfirst($transaction->payment_type) }}</td>
                            </tr>
                            <tr>
                                <th>Status Transaksi</th>
                                <td>:
                                    @php
                                        $status = $transaction->transaction_status;
                                        $badgeClass = match ($status) {
                                            'success' => 'badge bg-success',
                                            'pending' => 'badge bg-warning text-dark',
                                            default => 'badge bg-danger',
                                        };
                                    @endphp
                                    <span class="{{ $badgeClass }}">{{ ucfirst($status) }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>Dibuat Pada</th>
                                <td>: {{ \Carbon\Carbon::parse($transaction->created_at)->translatedFormat('d F Y H:i') }}
                                </td>
                            </tr>
                            <tr>
                                <th>Diperbarui Pada</th>
                                <td>: {{ \Carbon\Carbon::parse($transaction->updated_at)->translatedFormat('d F Y H:i') }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

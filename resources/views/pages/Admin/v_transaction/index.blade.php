@extends('layouts.admin')
@section('title', 'Transaction')
@section('content')
    <div class="accordion accordion-flush bg-white" id="accordionFlushExample">
        <div class="accordion-item bg-white">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed bg-primary text-white py-2 rounded-top" type="button"
                    data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false"
                    aria-controls="flush-collapseOne">
                    <strong>Lihat Detail</strong>
                </button>
            </h2>
            <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <div class="row">
                        <div class="col-md-4 mb-4 text-white">
                            <div class="card bg-success">
                                <div class="card-body">
                                    <h5 class="card-title text-white">Jumlah Transaction</h5>
                                    <p class="card-text text-white">{{ $counts }}</p>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div id="chart-container" class="position-relative">
                                <!-- Spinner -->
                                <div id="chart-loading" class="d-flex justify-content-center align-items-center"
                                    style="height: 300px;">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                                <!-- Canvas -->
                                <canvas id="transactionGrowthChart" class="d-none"
                                    style="height: 400px; max-height: 400px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="multi_col_order" class="table table-striped table-bordered display no-wrap"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>User</th>
                                    <th>Order ID</th>
                                    <th>Status</th>
                                    <th>Updated At</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="table-body">
                                @foreach ($transaction as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row?->createdBy?->name  ?? '...........' }} <br> <small class="badge rounded-pill bg-success-subtle text-success text-end" style="font-size: 10px;">{{ $row?->createdBy?->email ?? '...........'  }}</small> </td>
                                        <td>
                                            <small>{{ $row->order_id }}</small>
                                        </td>
                                        <td>
                                            @php
                                                $status = $row->transaction_status;
                                                $badgeClass = match ($status) {
                                                    'success' => 'badge bg-success',
                                                    'pending' => 'badge bg-warning',
                                                    default => 'badge bg-danger',
                                                };
                                            @endphp
                                            <span class="{{ $badgeClass }}">{{ ucfirst($status) }}</span>
                                        </td>
                                        
                                        <td>{{ \Carbon\Carbon::parse($row->updated_at)->translatedFormat('d F Y H:i') }}</td>
                                        <td>
                                            <a href="{{ route('transaction.show', $row->id) }}" class="btn btn-sm btn-outline-success">
                                                <i class="fa-regular fa-eye"></i>
                                            </a>
                                            <form action="/transaction/delete/{{ $row->id }}"
                                                id="delete_{{ $row->id }}" method="post"
                                                style="display: inline-block;">
                                                @csrf
                                                <button type="button" class="btn btn-sm btn-outline-danger show_confirm">
                                                    <i class="fa-regular fa-trash-can"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{ $transaction->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('transactionGrowthChart').getContext('2d');
            const transactionGrowthData = @json($transactionGrowth);

            const labels = Array.from({
                length: 12
            }, (_, i) => new Date(0, i).toLocaleString('id-ID', {
                month: 'long'
            }));
            const data = Array.from({
                length: 12
            }, (_, i) => transactionGrowthData[i + 1] || 0);

            setTimeout(() => {
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Peningkatan Transaksi Per Bulan',
                            data: data,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderWidth: 2,
                            tension: 0.4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top'
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

                document.getElementById('chart-loading').classList.add('d-none');
                document.getElementById('transactionGrowthChart').classList.remove('d-none');
            }, 1000); 
        });
    </script>
@endpush

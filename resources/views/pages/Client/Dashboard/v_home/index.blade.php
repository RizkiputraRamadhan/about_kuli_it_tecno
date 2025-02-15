@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
    <div class="row">
        <div class="col-md-4 mb-1 text-white">
            <div class="card bg-success">
                <div class="card-body">
                    <h5 class="card-title text-white">Transaksi Success</h5>
                    <p class="card-text text-white">{{ $success }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-1 text-white">
            <div class="card bg-info">
                <div class="card-body">
                    <h5 class="card-title text-white">Transaksi Pending</h5>
                    <p class="card-text text-white">{{ $pending }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-1 text-white">
            <div class="card bg-danger">
                <div class="card-body">
                    <h5 class="card-title text-white">Transaksi Failed</h5>
                    <p class="card-text text-white">{{ $failed }}</p>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-12">
            <div id="chart-container" class="position-relative">
                <!-- Spinner -->
                <div id="chart-loading" class="d-flex justify-content-center align-items-center" style="height: 300px;">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <!-- Canvas -->
                <canvas id="transactionGrowthChart" class="d-none" style="height: 400px; max-height: 400px;"></canvas>
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
                            label: 'Peningkatan Transaksi Anda Per Bulan',
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

@extends('layouts.admin')
@section('title', 'Source Codes')
@section('content')
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
                                    <th>Item</th>
                                    <th>Order ID</th>
                                    <th>Status</th>
                                    <th>Di update</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="table-body">
                                @foreach ($transaction as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}.</td>
                                        <td>{{ $row->source->title }}</td>
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

                                        <td>{{ \Carbon\Carbon::parse($row->updated_at)->translatedFormat('d F Y H:i') }}
                                        </td>

                                        <td>
                                            <a href="{{ route('client.source.payment', ['crsf' => csrf_token(), 'slug' => $row->source->slug]) }}"
                                                class="btn btn-sm btn-outline-success" target="blank">
                                                <i class="fa-regular fa-eye"></i>
                                            </a>
                                            @if ($row->transaction_status == 'success')
                                                <a id="download" data-item="{{ $row->source->title }}"
                                                    data-url="{{ route('client.download.source', $row->order_id) }}"
                                                    class="btn btn-sm btn-outline-danger" target="blank">
                                                    <i class="fa-solid fa-download"></i>
                                                </a>
                                            @endif
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

@push('css')
@endpush
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $("#download").click(function(e) {
                e.preventDefault();

                var url = $(this).data("url");
                var title = $(this).data("item");

                var xhr = new XMLHttpRequest();
                xhr.open("GET", url, true);
                xhr.responseType = "blob";

                Swal.fire({
                    title: "Mengunduh file...",
                    html: '<div id="progress-container" style="width: 100%; background: #ddd; border-radius: 5px; margin-top: 10px;">' +
                        '<div id="progress-bar" style="width: 0%; height: 20px; background: #3498db; border-radius: 5px; text-align: center; color: white; font-weight: bold;">0%</div>' +
                        '</div>',
                    allowOutsideClick: false,
                    showConfirmButton: false
                });

                xhr.onprogress = function(event) {
                    if (event.lengthComputable) {
                        var percentComplete = Math.floor((event.loaded / event.total) * 100);
                        $("#progress-bar").css("width", percentComplete + "%").text(percentComplete +
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
                        link.download = title + ".zip";
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);

                        $("#progress-bar").css("width", "100%").text("Download Selesai!");

                        setTimeout(() => {
                            Swal.close();
                        }, 1000);
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Gagal!",
                            text: "Terjadi kesalahan saat mengunduh file."
                        });
                    }
                };

                xhr.onerror = function() {
                    Swal.fire({
                        icon: "error",
                        title: "Gagal!",
                        text: "Download gagal, silakan coba lagi."
                    });
                };

                xhr.send();
            });
        });
    </script>
@endpush

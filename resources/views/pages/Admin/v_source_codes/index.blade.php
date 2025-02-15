@extends('layouts.admin')
@section('title', 'Source Codes')
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
                        <div class="col-md-3 mb-4 text-white">
                            <div class="card bg-success">
                                <div class="card-body">
                                    <h5 class="card-title text-white">Jumlah Keseluruhan</h5>
                                    <p class="card-text text-white">{{ $counts }} Project</p>
                                </div>
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
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <a href="{{ route('source_codes_admin.create') }}" class="btn btn-primary">
                            <i class="fa-solid fa-circle-plus"></i> Tambah Project
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table id="multi_col_order" class="table table-striped table-bordered display no-wrap"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Viewer</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="table-body">
                                @foreach ($source_codes as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}.</td>
                                        <td>{{ $row->title }}</td>
                                        <td>{{ $row->viewer }}</td>
                                        <td>
                                            <a href="{{ route('source_codes_admin.status', $row->id) }}"
                                                class="badge rounded-pill fw-medium fs-2 text-end {{ $row->status == 1 ? 'bg-success-subtle text-success ' : 'bg-danger-subtle text-danger ' }}">
                                                {{ $row->status == 1 ? 'PUBLISH' : 'DRAFT' }} <i class="fa-solid fa-hand-pointer"></i>
                                            </a>
                                        </td>

                                        <td>
                                            <a href="/source_codes/admin/step/1/{{ $row->slug }}"
                                                class="btn btn-sm btn-outline-success edit-user"
                                                data-id="{{ $row->id }}">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </a>
                                            <form action="{{ route('source_codes_admin.destroy', $row->id) }}"
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
                            {{ $source_codes->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('script')
@endpush

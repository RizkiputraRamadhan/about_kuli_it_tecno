@extends('layouts.admin')
@section('title', 'Technology')
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
                                    <h5 class="card-title text-white">Jumlah Technology</h5>
                                    <p class="card-text text-white">{{ $counts }}</p>
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
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#login-modal">
                            <i class="fa-solid fa-circle-plus"></i> Tambah Technology
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table id="multi_col_order" class="table table-striped table-bordered display no-wrap"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Slug</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="table-body">
                                @foreach ($technology as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->name }}</td>
                                        <td><span class="badge rounded-pill fw-medium fs-2 text-end"
                                                style="background-color: {{ $row->color }};">{{ $row->slug }}</span>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-outline-success edit-tech"
                                                data-id="{{ $row->id }}">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </button>
                                            <form action="/technology/delete/{{ $row->id }}"
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
                            {{ $technology->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div id="login-modal" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header">
                    <h4 class="modal-title" id="primary-header-modalLabel">Tambah Technology</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/technology" class="pl-3 pr-3" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="name">Technology</label>
                            <input class="form-control" name="name" type="text" id="name" required=""
                                placeholder="Technology">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="color">Color : </label>
                            <input class="p-2" value="#00000" name="color" type="color" id="color" required=""
                                placeholder="#00000">
                        </div>

                        <div class="form-group text-right" style="text-align: right;">
                            <button class="btn btn-primary" type="submit"><i class="fa-solid fa-save"></i> Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div id="edit-modal" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-colored-header">
                    <h4 class="modal-title" id="edit-modalLabel">Edit Technology</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="edit-form" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label" for="edit-name">Technology</label>
                            <input class="form-control" name="name" type="text" id="edit-name" required=""
                                placeholder="">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="edit-color">Color</label>
                            <input class="p-2" value="#00000" name="color" type="color" id="edit-color"
                                required="" placeholder="#00000">
                        </div>
                        <div class="form-group" style="text-align: right;">
                            <button class="btn btn-primary" type="submit">
                                <i class="fa-solid fa-save"></i> Simpan
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).on('click', '.edit-tech', function() {
            const techId = $(this).data('id');
            const button = $(this);

            button.html('<i class="fa-solid fa-spinner fa-spin"></i>');
            button.prop('disabled', true);

            $.ajax({
                url: `/technology/edit/${techId}`,
                method: 'GET',
                success: function(response) {
                    button.html('<i class="fa-regular fa-pen-to-square"></i>');
                    button.prop('disabled', false);

                    $('#edit-form').attr('action', `/technology/update/${techId}`);
                    $('#edit-name').val(response.data.name);
                    $('#edit-color').val(response.data.color);

                    $('#edit-modal').modal('show');
                },
                error: function(xhr) {
                    button.html('<i class="fa-regular fa-pen-to-square"></i>');
                    button.prop('disabled', false);

                    console.error(xhr);
                }
            });
        });
    </script>
@endpush

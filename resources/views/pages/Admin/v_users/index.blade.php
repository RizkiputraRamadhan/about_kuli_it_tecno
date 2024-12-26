@extends('layouts.backend')
@section('title', 'User')
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
                                    <h5 class="card-title text-white">Admin</h5>
                                    <p class="card-text text-white">{{ $adminCount }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4 text-white">
                            <div class="card bg-danger">
                                <div class="card-body">
                                    <h5 class="card-title text-white">Users</h5>
                                    <p class="card-text text-white">{{ $userCount }}</p>
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
                                <canvas id="userGrowthChart" class="d-none"
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
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#login-modal">
                            <i class="fa-solid fa-circle-plus"></i> Tambah Users
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table id="multi_col_order" class="table table-striped table-bordered display no-wrap"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Roles</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="table-body">
                                @foreach ($users as $row)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->email }}</td>
                                        <td>
                                            @if ($row->roles == 'ADMIN')
                                                <span
                                                    class="badge rounded-pill fw-medium fs-2 bg-success-subtle text-success text-end">{{ $row->roles }}</span>
                                            @else
                                                <span
                                                    class="badge rounded-pill fw-medium fs-2 bg-danger-subtle text-danger text-end">{{ $row->roles }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-outline-success edit-user"
                                                data-id="{{ $row->id }}">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </button>
                                            <form action="/users/delete/{{ $row->id }}" id="delete_{{ $row->id }}"
                                                method="post" style="display: inline-block;">
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
                            {{ $users->links('pagination::bootstrap-5') }}
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
                    <h4 class="modal-title" id="primary-header-modalLabel">Tambah data users</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/users" class="pl-3 pr-3" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="name">Nama Lengkap</label>
                            <input class="form-control" name="name" type="text" id="name" required=""
                                placeholder="Nama Lengkap">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="email">Email</label>
                            <input class="form-control" name="email" type="text" id="email" required=""
                                placeholder="..@gmail.com">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="exampleFormControlSelect1">Roles</label>
                            <select name="roles" class="form-control" id="exampleFormControlSelect1">
                                <option selected>-- pilih --</option>
                                <option value="ADMIN">ADMIN</option>
                                <option value="USER">USER</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="password">Password</label>
                            <input class="form-control" name="password" type="text" id="password" required="">
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
                    <h4 class="modal-title" id="edit-modalLabel">Edit data users</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="edit-form" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label" for="edit-name">Nama Lengkap</label>
                            <input class="form-control" name="name" type="text" id="edit-name" required=""
                                placeholder="Nama Lengkap">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="edit-email">Email</label>
                            <input class="form-control" name="email" type="text" id="edit-email" required=""
                                placeholder="..@gmail.com">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="edit-roles">Roles</label>
                            <select name="roles" class="form-control" id="edit-roles">
                                <option value="ADMIN">ADMIN</option>
                                <option value="USER">USER</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Enter new password">
                            <div id="password" class="form-text text-danger">*Kosongkan untuk memakai password
                                sebelumnya.</div>
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('userGrowthChart').getContext('2d');
            const userGrowthData = @json($userGrowth);

            const labels = Array.from({
                length: 12
            }, (_, i) => new Date(0, i).toLocaleString('id-ID', {
                month: 'long'
            }));
            const data = Array.from({
                length: 12
            }, (_, i) => userGrowthData[i + 1] || 0);

            setTimeout(() => {
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Peningkatan User Per Bulan',
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
                document.getElementById('userGrowthChart').classList.remove('d-none');
            }, 1000); 
        });
    </script>


    <script>
        $(document).on('click', '.edit-user', function() {
            const userId = $(this).data('id');
            const button = $(this);

            button.html('<i class="fa-solid fa-spinner fa-spin"></i>');
            button.prop('disabled', true);

            $.ajax({
                url: `/users/edit/${userId}`,
                method: 'GET',
                success: function(response) {
                    button.html('<i class="fa-regular fa-pen-to-square"></i>');
                    button.prop('disabled', false);

                    $('#edit-form').attr('action', `/users/update/${userId}`);
                    $('#edit-name').val(response.data.name);
                    $('#edit-email').val(response.data.email);
                    $('#edit-roles').val(response.data.roles);

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

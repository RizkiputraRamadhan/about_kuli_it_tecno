@extends('layouts.admin')
@section('title', 'Project Premium')
@section('content')
    <div class="card">
        <div class="card-body">
            <form class="row" id="form" novalidate method="post"
                action="{{ route('source_codes_admin.update', $sc->slug) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <input type="hidden" name="step" value="{{ request()->segment('4') + 1 }}">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="card-title mb-0">{{ $sc->title }}</h5>

                    <div class="text-start">
                        @if (request()->segment(4) == '1')
                            <a href="/source_codes/admin" class="btn btn-danger">Back
                            </a>
                        @else
                            <a href="/source_codes/admin/step/{{ $step - 1 }}/{{ $sc->slug }}"
                                class="btn btn-danger">Back Step - {{ $step - 1 }}
                            </a>
                        @endif

                        <button class="btn btn-primary" id="submitBtn" type="button">
                            <i class="fa-solid fa-save"></i> {{ $step == 4 ? 'Publish Sekarang' : 'Step Selanjutnya' }}
                        </button>
                    </div>
                </div>

                @include('widget.admin.source-code.step-' . request()->segment(4), [
                    'technologies' => $technologies,
                    'categories' => $categories,
                    'data' => $sc,
                ])
            </form>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('#submitBtn').on('click', function() {
                Swal.fire({
                    title: 'Processing...',
                    text: 'Please wait while we save your progress.',
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                var form = $('#form')[0];
                var formData = new FormData(form);

                $.ajax({
                    url: form.action,
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: response.message || 'Source code has been updated successfully!',
                                showConfirmButton: true
                            }).then(() => {
                                window.location.href = response.redirect;
                            });
                        } else {
                            Swal.fire({
                                icon: 'info',
                                title: 'Progress Saved',
                                text: 'Your progress has been saved. You can proceed with the next step.',
                                showConfirmButton: true
                            });
                        }

                        Swal.close();
                    },
                    error: function(xhr, status, error) {
                        Swal.close();

                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'There was an error saving the source code. Please try again.',
                            showConfirmButton: true
                        });
                    }
                });
            });
        });
    </script>
@endpush

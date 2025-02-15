@extends('layouts.admin')
@section('title', 'Project Premium')
@section('content')
    <div class="card">
        <div class="card-body">
            <form class="row" id="form" novalidate method="post" action="{{ route('source_codes_admin.store') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <!-- Judul di sebelah kanan -->
                    <h5 class="card-title mb-0">Lengkapi Form dibawah ini</h5>

                    <!-- Tombol di sebelah kiri -->
                    <div class="text-start">
                        <button class="btn btn-primary" id="form" type="submit">
                            <i class="fa-solid fa-save"></i> Step Selanjutnya
                        </button>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <label style="cursor: pointer;" for="thumbnail" class="form-label">Thumbnail Preview <span
                                    style="display: none;" id="thumbnail-check"><i class="fa-solid fa-circle-check"
                                        style="color: #63E6BE;"></i></span></label>
                            <img id="thumbnail-preview" src="{{ asset('assets/default-1.png') }}" alt="Preview Image"
                                class="img-fluid" style="max-height: 200px;">
                        </div>
                    </div>


                </div>

                <!-- Form -->
                <div class="col-md-8">
                    <div class="needs-validation">

                        <div class="row">
                            <div class="form-group mb-3 col-12">
                                <label for="title" class="form-label">Title</label>
                                <input class="form-control" name="title" type="text" id="title" value=""
                                    required placeholder="Title Application">
                            </div>
                            <div class="form-group mb-3 col-12">
                                <label for="thumbnail" class="form-label">Thumbnail</label>
                                <input class="form-control" type="file" id="thumbnail" name="thumbnail" accept="image/*"
                                    required>
                            </div>

                            <div class="form-group mb-3 col-12">
                                <label for="categories" class="form-label">Categories</label>
                                <select class="form-control select2" id="categories" name="categories[]" multiple="multiple"
                                    required>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3 col-12">
                                <label for="technologies" class="form-label">Technologies</label>
                                <select class="form-control select2" id="technologies" name="technologies[]"
                                    multiple="multiple" required>
                                    @foreach ($technologies as $technology)
                                        <option value="{{ $technology->id }}">{{ $technology->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3 col-12">
                                <label for="price" class="form-label">Price</label>
                                <input class="form-control" name="price" type="number" id="price" value=""
                                    required placeholder="Price">
                            </div>


                        </div>

                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.css" />
    <style>
        .image-card {
            height: 250px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .image-card .card-body {
            position: relative;
        }

        .preview-image {
            max-height: 150px;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .action-buttons button {
            font-size: 12px;
        }
    </style>
@endpush
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        document.getElementById('foto').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('preview');
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('.select2').select2();

            // Thumbnail Preview
            $('#thumbnail').change(function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#thumbnail-preview').attr('src', e.target.result).show();
                    }
                    reader.readAsDataURL(file);
                    $('#thumbnail-check').show();
                } else {
                    $('#thumbnail-check').hide();

                }
            });

        });
    </script>
@endpush

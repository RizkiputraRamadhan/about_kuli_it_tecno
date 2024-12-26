@extends('layouts.backend')
@section('title', 'Project Premium')
@section('content')
    <div class="card">
        <div class="card-body">
            <form class="row" id="form" novalidate method="post" action="{{ route('source_codes_admin.store') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <!-- Judul di sebelah kanan -->
                    <h5 class="card-title mb-0">Tambah Project</h5>

                    <!-- Tombol di sebelah kiri -->
                    <div class="text-start">
                        <button class="btn btn-primary" id="form" type="submit">
                            <i class="fa-solid fa-save"></i> Simpan
                        </button>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <label for="thumbnail" class="form-label">Thumbnail Preview <span style="display: none;"
                                    id="thumbnail-check"><i class="fa-solid fa-circle-check"
                                        style="color: #63E6BE;"></i></span></label>
                            <img id="thumbnail-preview" src="#" alt="Preview Image" class="img-fluid"
                                style="max-height: 200px; display: none;">
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <label for="file_project" class="form-label">Files Project <span style="display: none;"
                                    id="file_project_check"><i class="fa-solid fa-circle-check"
                                        style="color: #63E6BE;"></i></span></label>
                            <ul id="file-project-details" class="list-unstyled text-start" style="display: none;">
                                <li><strong>Nama File:</strong> <span id="file-name"></span></li>
                                <li><strong>Ukuran:</strong> <span id="file-size"></span></li>
                                <li><strong>Tipe:</strong> <span id="file-type"></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <label for="file_project" class="form-label">Menus Editor Desc </label>
                            <div id="toolbar-container" class="w-full">
                                <span class="ql-formats">
                                    <select class="ql-font"></select>
                                    <select class="ql-size"></select>
                                </span>
                                <hr>
                                <span class="ql-formats">
                                    <button class="ql-bold"></button>
                                    <button class="ql-italic"></button>
                                    <button class="ql-underline"></button>
                                    <button class="ql-strike"></button>
                                    <select class="ql-color"></select>
                                    <select class="ql-background"></select>
                                </span>
                                <hr>

                                <span class="ql-formats">
                                    <button class="ql-header" value="1"></button>
                                    <button class="ql-header" value="2"></button>
                                    <button class="ql-header" value="3"></button>
                                    <button class="ql-header" value="4"></button>
                                    <button class="ql-header" value="5"></button>
                                    <button class="ql-header" value="6"></button>
                                    <button class="ql-blockquote"></button>
                                    <button class="ql-code-block"></button>
                                </span>
                                <hr>
                                <span class="ql-formats">
                                    <button class="ql-link"></button>
                                    <button class="ql-list" value="ordered"></button>
                                    <button class="ql-list" value="bullet"></button>
                                    <button class="ql-indent" value="-1"></button>
                                    <button class="ql-indent" value="+1"></button>
                                    <select class="ql-align"></select>
                                    <button class="ql-clean"></button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <div class="col-md-8">
                    <div class="needs-validation">

                        <div class="row">
                            <div class="form-group mb-3 col-12">
                                <label for="thumbnail" class="form-label">Thumbnail</label>
                                <input class="form-control" type="file" id="thumbnail" name="thumbnail" accept="image/*"
                                    required>
                            </div>
                            <div class="form-group mb-3 col-12">
                                <label for="thumbnail" class="form-label">File Project <small
                                        class="text-danger">.zip</small></label>
                                <input class="form-control" type="file" id="file_project" name="file_project"
                                    accept=".zip" required>
                            </div>
                            <div class="form-group mb-3 col-12">
                                <label for="title" class="form-label">Title</label>
                                <input class="form-control" name="title" type="text" id="title" value=""
                                    required placeholder="Title Application">
                            </div>
                            <div class="form-group mb-3 col-12">
                                <label for="categories" class="form-label">Categories</label>
                                <select class="form-control select2" id="categories" name="categories[]"
                                    multiple="multiple" required>
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

                            <div class="form-group mb-5 col-12">
                                <label for="Desc" class="form-label">Desc</label>
                                <input type="hidden" name="desc" id="desc">
                                <div id="editor"></div>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="mt-5 row" id="image-upload-container">
                    <!-- Card pertama -->
                    <div class="col-4 image-card">
                        <div class="card">
                            <div class="card-body text-center position-relative">
                                <label for="assets_images_demo_0" class="form-label text-center"
                                    style="cursor: pointer;">
                                    <i class="fa-solid fa-images" style="font-size: 50px"></i>
                                </label>
                                <input type="file" name="assets_images_demo[]" id="assets_images_demo_0"
                                    class="d-none file-input">
                                <img src="" alt="Preview" class="img-fluid mt-2 d-none preview-image">
                                <div class="action-buttons position-absolute top-0 end-0 m-2 d-none">
                                    <button type="button" class="btn btn-sm btn-danger remove-image">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control mt-2" placeholder="Desc"
                                    name="assets_images_desc[]" disabled>
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
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.css" />
    <style>
        .ql-container {
            width: 100%;
            font-size: 0.875rem;
            font-weight: 500;
            color: #5a6a85;
            background-color: transparent;
            background-clip: padding-box;
            border: var(--bs-border-width) solid #dfe5ef;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: 7px;
            -webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.075);
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.075);
            -webkit-transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
            transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
        }

        #editor {
            min-height: 200px;
        }

        #toolbar-container {
            border: none !important;
        }

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
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const Block = Quill.import('blots/block');
            Block.tagName = 'DIV';
            Quill.register(Block, true);

            const quill = new Quill('#editor', {
                modules: {
                    syntax: true,
                    toolbar: '#toolbar-container',
                },
                placeholder: 'Buat desc disini....',
                theme: 'snow',
            });

            function updateQuillContent() {
                const delta = quill.getContents();
                const html = quill.root.innerHTML;

                let content = html.replace(/<p>/g, '<p class="text-gray-700 mb-2">')
                    .replace(/<h1>/g, '<h1 class="text-4xl font-bold mb-2">')
                    .replace(/<h2>/g, '<h2 class="text-3xl font-bold mb-2">')
                    .replace(/<h3>/g, '<h3 class="text-2xl font-bold mb-2">')
                    .replace(/<ol>/g, '<ol class="list-decimal list-inside mb-2">')
                    .replace(/<ul>/g, '<ul class="list-disc list-inside mb-2">');

                document.querySelector('#desc').value = content;
            }

            var observer = new MutationObserver(updateQuillContent);

            observer.observe(quill.root, {
                childList: true,
                subtree: true,
                characterData: true
            });

            document.querySelector('#form').onsubmit = function() {
                updateQuillContent();
                return true;
            };
        });

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

            $('#file_project').change(function() {
                const file = this.files[0];
                if (file) {
                    $('#file-project-details').show();
                    $('#file-name').text(file.name);
                    $('#file-size').text((file.size / 1024).toFixed(2) + ' KB');
                    $('#file-type').text(file.type || 'application/zip');
                    $('#file_project_check').show();
                } else {
                    $('#file_project_check').hide();
                    $('#file-project-details').hide();
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            let index = 1;

            // Fungsi untuk menambahkan card baru
            function addNewCard() {
                const newCard = `
                <div class="col-4 image-card">
                    <div class="card">
                        <div class="card-body text-center position-relative">
                            <label for="assets_images_demo_${index}" class="form-label text-center" style="cursor: pointer;">
                                <i class="fa-solid fa-images" style="font-size: 50px"></i>
                            </label>
                            <input type="file" name="assets_images_demo[]" id="assets_images_demo_${index}" class="d-none file-input">
                            <img src="" alt="Preview" class="img-fluid mt-2 d-none preview-image">
                        
                            <div class="action-buttons position-absolute top-0 end-0 m-2 d-none">
                                <button type="button" class="btn btn-sm btn-danger remove-image">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control mt-2" placeholder="Desc" name="assets_images_desc[]" disabled>
                        </div>
                    </div>
                </div>`;
                $('#image-upload-container').append(newCard);
                index++;
            }

            // Event listener untuk input file
            $(document).on('change', '.file-input', function(event) {
                const fileInput = $(this);
                const card = fileInput.closest('.image-card');
                const previewImage = card.find('.preview-image');
                const descInput = card.find('input[type="text"]');
                const actionButtons = card.find('.action-buttons');

                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImage.attr('src', e.target.result).removeClass('d-none');
                        descInput.prop('disabled', false);
                        actionButtons.removeClass('d-none');
                    };
                    reader.readAsDataURL(file);
                    $('.fa-images').hide()
                }

                let allFilled = true;
                $('.file-input').each(function() {
                    if (!$(this).val()) {
                        allFilled = false;
                    }
                });

                if (allFilled) {
                    addNewCard();
                }
            });


            $(document).on('click', '.remove-image', function() {
                const card = $(this).closest('.image-card');
                card.remove();
            });
        });
    </script>
@endpush

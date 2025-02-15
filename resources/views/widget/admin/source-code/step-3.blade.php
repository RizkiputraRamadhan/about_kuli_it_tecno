<label for="file_project">
    <div class="col-12 " id="col-file">
        <div class="card" id="label_file">
            <div class="card-body">
                <span style="display: none;" id="file_project_check">
                    <i class="fa-solid fa-circle-check" style="color: #63E6BE; font-size: 24px;"></i>
                </span>
                <p><strong>Seret & lepaskan file di sini atau klik untuk memilih</strong></p>
                <ul id="file-project-details" class="list-unstyled">
                    <li><strong>Nama File:</strong> <span id="file-name"></span></li>
                    <li><strong>Ukuran:</strong> <span id="file-size"></span></li>
                    <li><strong>Tipe:</strong> <span id="file-type"></span></li>
                </ul>
            </div>
        </div>
    </div>
</label>

<!-- Input File -->
<input class="form-control" type="file" id="file_project" name="file_project" accept=".zip" required hidden>
<div class="col-12 ">
    <div class="card">
        <div class="card-body">
            @if ($data->file_url)
                <a href="{{ asset('storage/' . $data->file_url) }}"><strong><i class="fa-solid fa-file-zipper fa-2xl"
                            style="color: #FFD43B;"></i> &nbsp; File Source Code &nbsp; &nbsp; </strong></a>
                <a href="#" class="show_confirm_file text-danger"
                    data-url="{{ route('source_codes_admin.file_destroy', $data->id) }}">
                    <i class="fa-solid fa-trash-can-arrow-up"></i>
                </a>
            @endif

        </div>
    </div>
</div>

@push('css')
    <style>
        #col-file {
            width: 100%;
        }

        #label_file {
            width: 100%;
            max-width: 100%;
            padding: 30px;
            border: 2px dashed #63E6BE;
            cursor: pointer;
            border-radius: 10px;
            background-color: #f8f9fa;
            transition: background-color 0.3s ease-in-out;
        }

        #label_file.dragover {
            background-color: rgba(99, 230, 190, 0.2);
        }

        .card-body {
            text-align: left;
        }

        #file-project-details {
            margin-top: 15px;
        }
    </style>
@endpush

@push('script')
    <script>
        $(document).ready(function() {
            let fileInput = $("#file_project");
            let dropArea = $("#label_file");

            dropArea.on("dragover", function(e) {
                e.preventDefault();
                dropArea.addClass("dragover");
            });

            dropArea.on("dragleave", function() {
                dropArea.removeClass("dragover");
            });

            dropArea.on("drop", function(e) {
                e.preventDefault();
                dropArea.removeClass("dragover");
                let files = e.originalEvent.dataTransfer.files;
                if (files.length > 0) {
                    fileInput.prop("files", files);
                    updateFileDetails(files[0]);
                }
            });

            fileInput.on("change", function() {
                if (this.files.length > 0) {
                    updateFileDetails(this.files[0]);
                }
            });

            function updateFileDetails(file) {
                $("#file-name").text(file.name);
                $("#file-size").text((file.size / 1024).toFixed(2) + " KB");
                $("#file-type").text(file.type || "Tidak Diketahui");
                $("#file_project_check").show();
            }
        });

        $(document).ready(function() {
            $(".show_confirm_file").on("click", function(e) {
                e.preventDefault();
                let deleteUrl = $(this).data("url");

                Swal.fire({
                    title: "Apakah Anda yakin?",
                    text: "Data yang dihapus tidak bisa dikembalikan!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Ya, Hapus!",
                    cancelButtonText: "Batal"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = deleteUrl;
                    }
                });
            });
        });
    </script>
@endpush

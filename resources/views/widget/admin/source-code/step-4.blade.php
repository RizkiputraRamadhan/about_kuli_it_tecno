<div class="col-md-12">
    <div class="needs-validation">
        <div class="row">



            <div class="mt-2 row" id="image-upload-container">
                @foreach ($data->assets as $asset)
                    <div class="col-4 image-card">
                        <div class="card">
                            <div class="card-body text-center position-relative">
                                <img src="{{ asset('storage/' . $asset->image) }}" alt="Preview" class="img-fluid mt-2 ">
                                <div class="position-absolute top-0 end-0 m-2">
                                    <a href="#"
                                        data-asset="{{ route('source_codes_admin.asset_destroy', $asset->id) }}"
                                        class="btn btn-sm btn-danger show_confirm_asset">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </div>
                                <input type="text" class="form-control mt-2" placeholder="Caption Image"
                                    name="" value="{{ $asset->caption }}" disabled>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-4 image-card">
                    <div class="card">
                        <div class="card-body text-center position-relative">
                            <label for="assets_images_demo_0_file" class="form-label text-center"
                                style="cursor: pointer;">
                                <i class="fa-solid fa-images" style="font-size: 50px"></i>
                            </label>
                            <input type="file" name="assets_images_demo[0][file]" id="assets_images_demo_0_file"
                                class="d-none file-input">
                            <img src="" alt="Preview" class="img-fluid mt-2 d-none preview-image">
                            <div class="action-buttons position-absolute top-0 end-0 m-2 d-none">
                                <button type="button" class="btn btn-sm btn-danger remove-image">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control mt-2" placeholder="Caption Image"
                                name="assets_images_demo[0][caption]" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        $(document).ready(function() {
            let index = 1;

            function addNewCard() {
                const newCard = `
            <div class="col-4 image-card">
                <div class="card">
                    <div class="card-body text-center position-relative">
                        <label for="assets_images_demo_${index}_file" class="form-label text-center" style="cursor: pointer;">
                            <i class="fa-solid fa-images" style="font-size: 50px"></i>
                        </label>
                        <input type="file" name="assets_images_demo[${index}][file]" id="assets_images_demo_${index}_file" class="d-none file-input">
                        <img src="" alt="Preview" class="img-fluid mt-2 d-none preview-image">
                    
                        <div class="action-buttons position-absolute top-0 end-0 m-2 d-none">
                            <button type="button" class="btn btn-sm btn-danger remove-image">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                        <input type="text" class="form-control mt-2" placeholder="Caption Image" name="assets_images_demo[${index}][caption]" disabled>
                    </div>
                </div>
            </div>`;
                $('#image-upload-container').append(newCard);
                index++;
            }

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


            $(document).ready(function() {
                $(".show_confirm_asset").on("click", function(e) {
                    e.preventDefault();
                    let deleteUrl = $(this).data("asset");

                    console.log(deleteUrl);

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
        });
    </script>
@endpush

<div class="col-md-4">
    <div class="card">
        <div class="card-body">
            <label style="cursor: pointer;" for="thumbnail" class="form-label">Thumbnail Preview <span
                    style="display: none;" id="thumbnail-check"><i class="fa-solid fa-circle-check"
                        style="color: #63E6BE;"></i></span></label>
            <img id="thumbnail-preview" src="{{ asset('storage/' . $data->thumbnail) }}" alt="Preview Image"
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
                <input class="form-control" name="title" type="text" id="title" value="{{ $data->title }}"
                    required placeholder="Title Application">
            </div>
            <div class="form-group mb-3 col-12">
                <label for="thumbnail" class="form-label">Thumbnail New</label>
                <input class="form-control" type="file" id="thumbnail" name="thumbnail" accept="image/*" required>
            </div>

            <div class="form-group mb-3 col-12">
                <label for="categories" class="form-label">Categories</label>
                <select class="form-control select2" id="categories" name="categories[]" multiple="multiple" required>
                    @php
                        $selectedCategories = json_decode($data->categories, true);
                    @endphp
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ in_array($category->id, $selectedCategories) ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3 col-12">
                <label for="technologies" class="form-label">Technologies</label>
                <select class="form-control select2" id="technologies" name="technologies[]" multiple="multiple"
                    required>
                    @php
                        $selectedTechnologies = json_decode($data->technologies, true);
                    @endphp
                    @foreach ($technologies as $technology)
                        <option value="{{ $technology->id }}"
                            {{ in_array($technology->id, $selectedTechnologies) ? 'selected' : '' }}>
                            {{ $technology->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3 col-12">
                <label for="price" class="form-label">Price</label>
                <input class="form-control" name="price" type="number" id="price" value="{{ $data->price }}"
                    required placeholder="Price">
            </div>
        </div>
    </div>
</div>


@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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

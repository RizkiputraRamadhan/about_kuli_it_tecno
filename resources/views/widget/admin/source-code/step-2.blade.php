<!-- Form -->
<div class="col-md-12">
    <div class="needs-validation">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <label for="file_project" class="form-label">Description Aplication</label>
                    <div id="toolbar-container" class="w-full">
                        <span class="ql-formats">
                            <select class="ql-font"></select>
                            <select class="ql-size"></select>
                            <button class="ql-bold"></button>
                            <button class="ql-italic"></button>
                            <button class="ql-underline"></button>
                            <button class="ql-strike"></button>
                            <select class="ql-color"></select>
                            <select class="ql-background"></select>
                            <button class="ql-header" value="1"></button>
                            <button class="ql-header" value="2"></button>
                            <button class="ql-header" value="3"></button>
                            <button class="ql-header" value="4"></button>
                            <button class="ql-header" value="5"></button>
                            <button class="ql-header" value="6"></button>
                            <button class="ql-blockquote"></button>
                            <button class="ql-code-block"></button>
                            <button class="ql-link"></button>
                            <button class="ql-list" value="ordered"></button>
                            <button class="ql-list" value="bullet"></button>
                            <button class="ql-indent" value="-1"></button>
                            <button class="ql-indent" value="+1"></button>
                            <select class="ql-align"></select>
                            <button class="ql-clean"></button>
                        </span>
                    </div>
                    <div class="form-group mb-5 col-12">
                        <input type="hidden" name="desc" value="{{ $data->description }}" id="desc">
                        <div id="editor">{!! $data->description !!}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css" />
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
    </script>
@endpush

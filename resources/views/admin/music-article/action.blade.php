@extends('layouts.admin')
@section('title', isset($oldData) ? 'Edit Article' : 'Add Article')
@push('style')
    <link href="{{ asset('assets/libs/quill/quill.snow.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/filepond/filepond.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

    <style>
        @media (min-width: 992px) {
            #card-meta {
                position: sticky;
                top: 90px;
            }
        }
    </style>
@endpush
@push('script')
    <!-- Filepond -->
    <script src="{{ asset('assets/libs/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js') }}">
    </script>
    <script src="{{ asset('assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js') }}"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-crop/dist/filepond-plugin-image-crop.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-transform/dist/filepond-plugin-image-transform.js"></script>
    <script src="{{ asset('assets/libs/filepond/filepond.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            FilePond.registerPlugin(FilePondPluginFileValidateSize);
            FilePond.registerPlugin(FilePondPluginImagePreview);
            FilePond.registerPlugin(FilePondPluginFileValidateType);
            FilePond.registerPlugin(FilePondPluginImageCrop);
            FilePond.registerPlugin(FilePondPluginImageTransform);

            const thumbnail = document.querySelector('#thumbnail');
            const thumbnailInput = FilePond.create(thumbnail, {
                acceptedFileTypes: ['image/jpeg', 'image/png', 'image/jpg'],
                server: {
                    process: `{{ route('upload.filepondProcess') }}`,
                    revert: `{{ route('upload.filepondRevert') }}`,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                },
                allowFileSizeValidation: true,
                maxFileSize: '2MB',
                maxFiles: 1,
            });
        })
    </script>
    {{-- Quill --}}
    <script src="{{ asset('assets/libs/quill/quill.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/quill-image-uploader@1.3.0/dist/quill.imageUploader.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/quill-image-resize-module@3.0.0/image-resize.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Quill.register('modules/imageUploader', ImageUploader);
            // Quill.register('modules/imageResize', ImageResize);
            const content = new Quill('#contentInput', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        [{
                            header: [1, 2, false]
                        }],
                        ['bold', 'italic', 'underline'],
                        ['image', 'code-block'],
                    ],
                    imageResize: {
                        modules: ['Resize', 'DisplaySize', 'Toolbar']
                    },
                    imageUploader: {
                        upload: file => {
                            return new Promise((resolve, reject) => {
                                const formData = new FormData();
                                formData.append('image', file);

                                fetch("{{ route('upload.quillImageUpload') }}", {
                                        method: 'POST',
                                        body: formData,
                                        headers: {
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        }
                                    })
                                    .then(response => response.json())
                                    .then(result => {
                                        resolve(result.url);
                                    })
                                    .catch(error => {
                                        reject("Upload failed");
                                        console.error('Error:', error);
                                    });
                            });
                        }
                    }
                }
            });
            content.clipboard.addMatcher(Node.ELEMENT_NODE, (node, delta) => {
                delta.ops = delta.ops.map(op => {
                    return {
                        insert: op.insert
                    }
                })
                return delta
            })
            content.on('text-change', (delta, oldDelta, source) => {
                // Mendapatkan HTML dari konten yang diketik
                const htmlContent = content.root.innerHTML;
                if (htmlContent.trim() === '<p><br></p>') {
                    $("#content").val('');
                } else {
                    $("#content").val(htmlContent);
                }
                console.log('Current HTML content:', htmlContent);
            });

            const metaDescription = new Quill('#metaDescriptionInput', {
                theme: 'snow',
                modules: {
                    toolbar: false
                }
            });
            metaDescription.clipboard.addMatcher(Node.ELEMENT_NODE, (node, delta) => {
                delta.ops = delta.ops.map(op => {
                    return {
                        insert: op.insert
                    }
                })
                return delta
            })
            metaDescription.on('text-change', (delta, oldDelta, source) => {
                // Mendapatkan HTML dari konten yang diketik
                const htmlContent = metaDescription.root.innerHTML;
                if (htmlContent.trim() === '<p><br></p>') {
                    $("#meta_description").val('');
                } else {
                    $("#meta_description").val(htmlContent);
                }
                console.log('Current HTML content:', htmlContent);
            });
        })
    </script>
    {{-- Select2 --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $("#tag").select2({
            tags: true,
            tokenSeparators: [',', ' '],
            // theme: 'bootstrap-5'
        })
    </script>
@endpush
@section('content')
    <form action="{{ route('admin.music-article.process') }}" method="post">
        @csrf
        @method('put')
        <input type="hidden" id="id" name="id" value="{{ isset($oldData) ? $oldData->id : null }}">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="font-bold">General Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="title"
                                        class="form-control @error('title') is-invalid @enderror" id="title"
                                        placeholder="Enter your title"
                                        value="{{ old('title', isset($oldData) ? $oldData->title : '') }}" required>
                                    @error('title')
                                        <div class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            @if (isset($oldData))
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="slug" class="form-label">Slug <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="slug"
                                            class="form-control @error('slug') is-invalid @enderror" id="slug"
                                            placeholder="Enter your slug"
                                            value="{{ old('slug', isset($oldData) ? $oldData->slug : '') }}" required>
                                        @error('slug')
                                            <div class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                            {{-- <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="author" class="form-label">Author <span class="text-danger">*</span></label>
                                <input type="text" name="author"
                                    class="form-control @error('author') is-invalid @enderror" id="author"
                                    placeholder="Enter your author"
                                    value="{{ old('author', isset($oldData) ? $oldData->author : '') }}" required>
                                @error('author')
                                <div class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div> --}}
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="thumbnail" class="form-label">Thumbnail <span
                                            class="text-danger">*</span></label>
                                    @if (isset($oldData) && $oldData->thumbnail)
                                        <div class="my-2 d-flex justify-content-center">
                                            <img src="{{ Storage::url($oldData->thumbnail) }}" alt="thumbnail"
                                                style="max-width: 30%; height: auto;">
                                        </div>
                                    @endif
                                    <input type="file" name="thumbnail" id="thumbnail" class="filepond" />
                                    <div class="text-muted text-sm">
                                        <ul class="">
                                            <li>Max Filesize is 2 MB</li>
                                            <li>Recommended resolution is 1600x900</li>
                                        </ul>
                                    </div>
                                    @error('thumbnail')
                                        <div class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="content" class="form-label">Content</label>
                                    <input type="hidden" name="content" id="content"
                                        value="{{ old('content', isset($oldData) ? $oldData->content : '') }}" />
                                    <div class="snow-editor" id="contentInput" style="height: 300px;">
                                        {!! old('content', isset($oldData) ? $oldData->content : '') !!}
                                    </div>
                                    <!-- end Snow-editor-->
                                    @error('content')
                                        <div class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="tag" class="form-label">Tag <span class="text-danger">*</span></label>
                                    <select class="js-example-basic-multiple" name="tag[]" id="tag"
                                        multiple="multiple">
                                        @if (!empty($oldData->tag))
                                            @php
                                                $tags = json_decode($oldData->tag, true);
                                            @endphp
                                            @foreach ($tags as $tag)
                                                <option value="{{ $tag }}" selected>{{ $tag }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end mt-2">
                                    <a href="{{ route('admin.music-article.index') }}" class="btn btn-soft-dark">Cancel</a>
                                    <button type="submit" name="status" value="0" class="btn btn-secondary">Save
                                        as Draft</button>
                                    <button type="submit" name="status" value="1"
                                        class="btn btn-primary">{{ isset($oldData) ? 'Update' : 'Create' }}</button>
                                </div>
                                @error('status')
                                    <div class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card" id="card-meta">
                    <div class="card-header">
                        <h5 class="font-bold">Meta Data</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="meta_keyword" class="form-label">Keyword</label>
                                    <input type="text" name="meta_keyword"
                                        class="form-control @error('meta_keyword') is-invalid @enderror" id="meta_keyword"
                                        placeholder="Enter your meta keyword"
                                        value="{{ old('meta_keyword', isset($oldData) ? $oldData->meta_keyword : '') }}">
                                    @error('meta_keyword')
                                        <div class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="meta_description" class="form-label">Description</label>
                                    <input type="hidden" name="meta_description" id="meta_description"
                                        value="{{ old('meta_description', isset($oldData) ? $oldData->meta_description : '') }}" />
                                    <div class="snow-editor" id="metaDescriptionInput" style="height: 150px;">
                                        {!! old('meta_description', isset($oldData) ? $oldData->meta_description : '') !!}
                                    </div>
                                    <!-- end Snow-editor-->
                                    @error('meta_description')
                                        <div class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

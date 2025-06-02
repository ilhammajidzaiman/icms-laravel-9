<x-app-layout>
    <x-slot name="breadcrumb">
        <x-breadcrumb>
            <x-breadcrumb.item href="{{ route('dashboard') }}" value="{{ __('dashboard') }}" />
            <x-breadcrumb.item href="{{ route($page->route . '.index') }}" value="{{ $page->title ?? null }}" />
            <x-breadcrumb.item value="{{ $page->label ?? null }}" />
        </x-breadcrumb>
    </x-slot>

    <x-slot name="header">
        {{ $page->label ?? null }}
        {{ $page->title ?? null }}
        {{ $page->heading ?? null }}
    </x-slot>

    <x-form action="{{ route($page->route . '.' . $page->routeName, ['id' => $record->uuid]) }}" method="post"
        enctype="multipart/form-data">
        @method($page->method ?? null)
        @csrf
        <div class="row">
            <div class="col-md-9">
                <x-form.input>
                    <x-form.input.label for="title" value="{{ __('judul') }}" />
                    <x-form.input.textarea name="title" id="title" value="{{ old('title', $record->title) }}" />
                    <x-form.input.error name="title" />
                </x-form.input>
                <x-form.input>
                    <x-form.input.label for="content" value="{{ __('isi') }}" />
                    <textarea name="content" id="summernote" cols="30" rows="10">{{ old('content', $record->content) }}</textarea>
                    @error('content')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </x-form.input>

            </div>
            <div class="col-md-3">
                <x-form.input class="form-check form-switch">
                    <input type="checkbox" name="is_show" id="is_show" role="switch" class="form-check-input"
                        {{ old('is_show', $record->is_show ?? true) ? 'checked' : '' }} />
                    <x-form.input.label for="is_show" value="{{ __('status') }}" class="form-check-label" />
                    <x-form.input.error name="is_show" />
                    @if ($errors->has('is_show'))
                        <div class="text-danger">
                            {{ $errors->first('is_show') }}
                        </div>
                    @endif
                </x-form.input>

                <x-form.input>
                    <x-form.input.label for="published_at" value="{{ __('terbit') }}" />
                    <x-form.input.text type="date" name="published_at" id="published_at"
                        value="{{ old('published_at', $record->published_at ? $record->published_at->format('Y-m-d') : '') }}" />
                    <x-form.input.error name="published_at" />
                </x-form.input>

                <x-form.input>
                    <x-form.input.label for="category" value="{{ __('kategori') }}" />
                    <select name="category" id="category" class="form-select" data-placeholder="{{ __('pilih...') }}">
                        <option value="">Pilih...</option>
                        @foreach ($category as $item)
                            <option value="{{ $item->id }}"
                                {{ old('category', $record->blog_category_id) == $item->id ? 'selected' : '' }}>
                                {{ $item->title }}
                            </option>
                        @endforeach
                    </select>
                    <x-form.input.error name="category" />
                </x-form.input>

                <x-form.input>
                    <x-form.input.label for="tag" value="{{ __('tag') }}" />
                    <select name="tag[]" id="tag" class="form-select " data-placeholder="{{ __('pilih...') }}"
                        multiple="multiple">
                        @foreach ($tag as $item)
                            <option value="{{ $item->id }}"
                                {{ in_array($item->id, $selectedTags) ? 'selected' : '' }}>
                                {{ $item->title }}
                            </option>
                        @endforeach
                    </select>
                    <x-form.input.error name="tag" />
                </x-form.input>

                <x-form.input>
                    <x-form.input.label for="file" value="{{ __('file') }}" />
                    <input type="file" name="file" id="file" class="filepond"
                        data-file-record="{{ $record->file ? asset('storage/' . $record->file) : null }}" />
                </x-form.input>
                <x-form.input>
                    <x-form.input.label for="attachment" value="{{ __('Lampiran') }}" />
                    <input type="file" name="attachment[]" id="attachment" class="filepond" multiple
                        data-attachment-record="{{ $record->attachment ? json_encode(array_map(fn($attachment) => asset('storage/' . $attachment), $record->attachment)) : '[]' }}" />
                </x-form.input>
            </div>
        </div>

        <div class="row">
            <div class="col mt-3">
                <x-link.button href="{{ route($page->route . '.index') }}" value="{{ __('kembali') }}"
                    icon="bi bi-arrow-left" class="btn-secondary me-2" />
                <x-button type="submit" value="{{ __('kirim') }}" icon="bi bi-send" />
            </div>
        </div>
    </x-form>

    @push('style')
        <link rel="stylesheet" href="{{ asset('/vendor/select2/dist/css/select2.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('/vendor/select2-bootstrap/dist/select2-bootstrap-5-theme.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('/vendor/summernote/summernote-lite.css') }}">
        <style>
            .note-icon-caret {
                display: none
            }
        </style>
    @endpush

    @push('scripts')
        <script src="{{ asset('/js/jquery-3.4.1.slim.min.js') }}"></script>
        <script src="{{ asset('/vendor/select2/dist/js/select2.min.js') }}"></script>
        <script src="{{ asset('/vendor/summernote/summernote-lite.min.js') }}"></script>

        <script>
            $('#summernote').summernote({
                tabsize: 2,
                height: 400,
                toolbar: [
                    ['view', ['undo', 'redo']],
                    ['style', ['style', 'fontname']],
                    ['font', ['bold', 'italic', 'underline', 'color']],
                    ['para', ['ul', 'ol', 'paragraph', 'strikethrough', 'superscript', 'subscript']],
                    ['table', ['table']],
                    ['insert', ['hr', 'link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']],
                    ['clear', ['clear']],
                ]
            })
            $('#category').select2({
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                placeholder: $(this).data('placeholder'),
                closeOnSelect: true,
            });
            $('#tag').select2({
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                placeholder: $(this).data('placeholder'),
                closeOnSelect: false,
                maximumSelectionLength: 5,
            });
        </script>
    @endpush
</x-app-layout>

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
                <x-form.input>
                    <x-form.input.label for="file" value="{{ __('file') }}" />
                    <input type="file" name="file" id="file" class="filepond"
                        data-file-record="{{ $record->file ? asset('storage/' . $record->file) : null }}" />
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
        <link rel="stylesheet" href="{{ asset('/vendor/summernote/summernote-lite.css') }}">
        <style>
            .note-icon-caret {
                display: none
            }
        </style>
    @endpush

    @push('scripts')
        <script src="{{ asset('/js/jquery-3.4.1.slim.min.js') }}"></script>
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
        </script>
    @endpush
</x-app-layout>

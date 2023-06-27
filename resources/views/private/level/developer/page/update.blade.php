@extends('private.templates.layout')

@section('header')
    edit posting
@endsection

@section('container')
    <x-button-link href="{{ route(Request::segment(1) . '.page.index') }}" label="kembali"
        class="rounded-pill btn btn-md btn-outline-primary mb-3" icon="fa-fw fas fa-arrow-left" />

    <form action="{{ route(Request::segment(1) . '.page.update', $page->uuid) }}" method="post">
        @method('put')
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row mb-3">
                                <x-form-input-row type="text" name="title" label="judul"
                                    value="{{ old('title', $page->title) }}" class="col" />
                            </div>
                            <x-form-input-summernote name="content" label="content" value="{!! old('content', $page->content) !!}" />
                            <x-button-submit label="simpan" class="btn btn-primary mt-3" icon="fa-fw fas fa-save" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('/plugins/mazer/assets/css/pages/summernote.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/mazer/assets/extensions/summernote/summernote-lite.css') }}">
@endsection

@section('script')
    <script src="{{ asset('/plugins/mazer/assets/extensions/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/plugins/mazer/assets/extensions/summernote/summernote-lite.min.js') }}"></script>
    <script>
        $('#summernote').summernote({
            tabsize: 2,
            height: 600,
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
@endsection

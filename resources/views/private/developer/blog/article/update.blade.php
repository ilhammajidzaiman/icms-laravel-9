{{-- @extends('private.templates.layout')

@section('header')
    posting baru
@endsection

@section('container')
    <x-button-link href="{{ route('developer.blog.post.index') }}" label="kembali"
        class="rounded-pill btn-sm btn-outline-secondary mb-3" icon="fa-arrow-left" />

    <form action="{{ $segmentUrl . '/' . $article->slug }}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="row">
            <div class="col-md-9">
                <div class="form-row">
                    <x-form-input-textarea rows="2" name="title" label="judul" :value="old('title', $article->title)" class="col-12" />
                </div>
                <x-form-input-summernote name="content" label="content" :value="old('content', $article->content)" />
            </div>
            <div class="col-md-3">
                @php
                    $path = $article->path;
                    $file = $article->file;
                    $file == 'default-user.svg' ? ($url = asset('assets/images/' . $file)) : ($url = asset('storage/' . $path . $file));
                @endphp
                <x-form-file-preview name="file" label="thumbnail" :value="$url" accept=".jpg,.jpeg,.png" />
                <div class="card">
                    <div class="card-body">
                        <label>Kategori</label>
                        @foreach ($categories as $category)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="category[]" id="{{ $category->id }}"
                                    value="{{ $category->id }}"
                                    @foreach ($blogPosts as $blogPost) {{ $category->id == $blogPost->blog_category_id ? 'checked' : '' }} @endforeach>
                                <label class="form-check-label" for="{{ $category->id }}">
                                    {{ $category->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="form-row">
                    <x-form-input-select name="status" label="status" class="col-12">
                        @foreach ($statuses as $status)
                            <option value="{{ $status->id }}" @selected(old('status', $article->blog_status_id) == $status->id)>
                                {{ $status->name }}
                            </option>
                        @endforeach
                    </x-form-input-select>
                </div>
                <x-button-submit label="simpan" class="rounded-pill btn-primary mb-3" icon="fa-save" />
            </div>
        </div>
    </form>
@endsection --}}








@extends('private.templates.layout')

@section('header')
    edit posting
@endsection

@section('container')
    <x-button-link href="{{ route('developer.blog.post.index') }}" label="kembali"
        class="rounded-pill btn btn-md btn-outline-primary mb-3" icon="fa-fw fas fa-arrow-left" />

    <form action="{{ route('developer.blog.post.update', $article->slug) }}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="row">
            <div class="col-12 col-md-9">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row mb-3">
                                <x-form-input-row type="text" name="title" label="judul"
                                    value="{{ old('title', $article->title) }}" class="col" />
                            </div>
                            <x-form-input-summernote name="content" label="content" value="{!! old('content', $article->content) !!}" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-3">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="form-group text-capitalize">
                                @php
                                    $path = $article->path;
                                    $file = $article->file;
                                    $file == 'default-img.svg' ? ($url = asset('assets/images/' . $file)) : ($url = asset('storage/' . $path . $file));
                                @endphp
                                <img src="{{ $url }}" alt="{{ $url }}"
                                    class="img-fluid rounded w-100 mb-3 img-preview">
                                <label for="file" class="form-label">thumbnail</label>
                                <input type="file" name="file" id="file" class="form-control"
                                    accept=".jpg,.jpeg,.png" onchange="previewImg()">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="form-group text-capitalize mb-3">
                                <label class="form-label">kategori</label>
                                @foreach ($categories as $category)
                                    <div class="form-check">
                                        <input type="checkbox" name="category[]" id="category{{ $category->id }}"
                                            value="{{ $category->id }}" class="form-check-input form-check-primary"
                                            @foreach ($blogPosts as $blogPost) {{ $category->id == $blogPost->blog_category_id ? 'checked' : '' }} @endforeach>
                                        <label class="form-check-label fw-normal"
                                            for="category{{ $category->id }}">{{ $category->name }}</label>
                                    </div>
                                @endforeach
                            </div>

                            <div class="row mb-3">
                                <x-form-input-select name="status" label="status" class="col-12">
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status->id }}" @selected(old('status', $article->blog_status_id) == $status->id)>
                                            {{ $status->name }}
                                        </option>
                                    @endforeach
                                </x-form-input-select>
                            </div>
                            <x-button-submit label="simpan" class="btn btn-primary" icon="fa-fw fas fa-save" />
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
    <script>
        function previewImg() {
            const cover = document.querySelector('#file');
            const imgPreview = document.querySelector('.img-preview');
            const fileCover = new FileReader();
            fileCover.readAsDataURL(cover.files[0]);
            fileCover.onload = function(e) {
                imgPreview.src = e.target.result;
            }
        }
    </script>
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

@extends('admin-lte.private.templates.main')

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
@endsection
